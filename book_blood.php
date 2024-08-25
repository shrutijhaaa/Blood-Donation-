<?php
require_once 'db_config.php'; // Include your database connection
require_once 'vendor/autoload.php'; // Include the Twilio library

use Twilio\Rest\Client;

$response = [];
$response['message'] = '';
$response['type'] = ''; // 'success' or 'error'

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['Name'] ?? '';
    $email = $_POST['Email'] ?? '';
    $phone_number = $_POST['Phone_Number'] ?? '';
    $blood_group = $_POST['Blood_Group'] ?? '';
    $state = $_POST['State'] ?? '';
    $date = $_POST['Date'] ?? '';
    $time = $_POST['Time'] ?? '';

    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($phone_number) || empty($blood_group) || empty($state) || empty($date) || empty($time)) {
        $response['message'] = 'All fields are required.';
        $response['type'] = 'error';
    } else {
        // Check if the booking already exists
        $sql_check = "SELECT * FROM book_blood WHERE Email = ? AND Phone_Number = ? AND Time = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("sss", $email, $phone_number, $time);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $response['message'] = 'A booking with this email, phone number, and time already exists.';
            $response['type'] = 'error';
        } else {
            // Prepare and execute the SQL query with correct column names
            $sql = "INSERT INTO book_blood (Name, Email, Phone_Number, Blood_Group, State, Date, Time) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $email, $phone_number, $blood_group, $state, $date, $time);

            if ($stmt->execute()) {
                // Send SMS using Twilio
                $sid = 'AC28a2d9272b30b0869ed9a027eacd7772'; // Replace with your Twilio SID
                $token = '6f96814f7690761b7d96cb57873a8815'; // Replace with your Twilio Auth Token
                $twilio_number = '+19382538803'; // Replace with your Twilio phone number

                $client = new Client($sid, $token);

                $message_body = "Thank you, $name! Your blood booking is confirmed for $date at $time. Further details will be provided when you arrive at the blood bank center.";

                try {
                    $client->messages->create(
                        $phone_number, // Recipient's phone number
                        array(
                            'from' => $twilio_number, // Twilio phone number
                            'body' => $message_body
                        )
                    );
                    $response['message'] = "Thank you, $name! Your blood booking is done for $date at $time. Further details will be provided when you arrive at the blood bank center.";
                    $response['type'] = 'success';
                } catch (Exception $e) {
                    $response['message'] = "Error sending message: " . $e->getMessage();
                    $response['type'] = 'error';
                }
            } else {
                $response['message'] = "Error: " . $stmt->error;
                $response['type'] = 'error';
            }

            $stmt->close();
        }

        $stmt_check->close();
        $conn->close();
    }

    // Output message and type for popup
    echo json_encode($response);
    exit();
}
?>

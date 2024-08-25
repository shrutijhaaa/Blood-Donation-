<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$sid = 'AC28a2d9272b30b0869ed9a027eacd7772';
$token = '6f96814f7690761b7d96cb57873a8815';
$twilio_number = '+19382538803';

$name = isset($_GET['name']) ? $_GET['name'] : '';
$mobile_number = isset($_GET['mobile']) ? $_GET['mobile'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';

if (empty($name) || empty($mobile_number) || empty($date) || empty($time)) {
    die("Missing parameters. Please provide 'name', 'mobile', 'date', and 'time'.");
}

try {
    $client = new Client($sid, $token);
    $message = "Thank you for registering, $name.  $date at $time.come and save the life";
    $client->messages->create(
        $mobile_number,
        [
            'from' => $twilio_number,
            'body' => $message,
        ]
    );
    echo "Message sent!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

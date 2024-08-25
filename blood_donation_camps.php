<?php
include('db_config.php');

$events = [];
$query = "SELECT id, event_name, location, date, time, description FROM blood_donation_camps WHERE status='live' ORDER BY date ASC";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    } else {
        echo "No events found with status 'live'.";
    }
} else {
    echo "Query failed: " . mysqli_error($conn);
}
?>

<?php
session_start();
if (!isset($_SESSION["member_id"])) {
    echo "Please log in first.";
    exit();
}
$conn = new mysqli("127.0.0.1", "root", "", "soldier_nation", 3306);

if ($conn->connect_error) {
    echo "Database connection failed.";
    exit();
}
if (!isset($_GET["booking_date"])) {
    echo "Please select a date.";
    exit();
}

$booking_date = $_GET["booking_date"];
$day = date("l", strtotime($booking_date));
$schedule_sql = "SELECT *
                 FROM coach_schedule
                 WHERE day = '$day'";
$schedule_result = $conn->query($schedule_sql);

if ($schedule_result->num_rows == 0) {
    echo "NO_DAY";
    exit();
}

$booking_sql = "SELECT start_time
                FROM coach_bookings
                WHERE booking_date = '$booking_date'
                AND status = 'Booked'";
$booking_result = $conn->query($booking_sql);
$booked_slots = [];

while ($row = $booking_result->fetch_assoc()) {
    $booked_slots[] = $row["start_time"];
}

$slots = [
    "15:00:00" => "03:00 PM - 04:00 PM",
    "16:00:00" => "04:00 PM - 05:00 PM",
    "17:00:00" => "05:00 PM - 06:00 PM"
];

foreach ($slots as $start_time => $display_time) {
    if (in_array($start_time, $booked_slots)) {

        echo '<option value="" disabled>'
             . $display_time
             . ' - Booked</option>';
    } else {
        echo '<option value="'
             . $start_time
             . '">'
             . $display_time
             . ' - Available</option>';
    }
}
?>
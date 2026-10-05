<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("127.0.0.1", "root", "", "soldier_nation", 3306);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$member_id = $_SESSION["member_id"];
$member_name = $_SESSION["member_name"];
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_date = $_POST["booking_date"];
    $start_time = $_POST["start_time"];
    $end_time = date("H:i:s", strtotime($start_time . " +1 hour"));
    $day = date("l", strtotime($booking_date));
    $schedule_sql = "SELECT *
                     FROM coach_schedule
                     WHERE day = '$day'
                     AND start_time <= '$start_time'
                     AND end_time >= '$end_time'";
    $schedule_result = $conn->query($schedule_sql);

    if ($schedule_result->num_rows == 0) {
        $message = "The coach is not available at this time.";
        $message_type = "error";
    } else {
        $check_sql = "SELECT *
                      FROM coach_bookings
                      WHERE booking_date = '$booking_date'
                      AND start_time = '$start_time'
                      AND status = 'Booked'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $message = "Sorry, this time slot has already been booked.";
            $message_type = "error";
        } else {
            $sql = "INSERT INTO coach_bookings
                    (member_id, booking_date, start_time, end_time, status)
                    VALUES
                    ('$member_id', '$booking_date', '$start_time', '$end_time', 'Booked')";

            if ($conn->query($sql)) {
                $booking_id = $conn->insert_id;
                $message = "Session booked successfully! Your Booking ID is: " . $booking_id;
                $message_type = "success";
            } else {
                $message = "Booking failed: " . $conn->error;
                $message_type = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Session - Swoldier Nation Gym</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="form-page">
        <div class="form-container">
            <p class="section-label">
                COACHING
            </p>
            <h1>
                Book a Coach Session
            </h1>
            <p class="form-intro">
                Welcome,
                <strong>
                    <?php echo htmlspecialchars($member_name); ?>
                </strong>
            </p>

            <?php if ($message != ""): ?>
                <p class="<?php echo $message_type == 'success' ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <form method="POST" class="registration-form">
                <div class="form-group">
                    <label for="booking_date">
                        Select Date
                    </label>
                    <input
                        type="date"
                        id="booking_date"
                        name="booking_date"
                        required
                        min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                    <label for="start_time">
                        Select 1-Hour Slot
                    </label>

                    <select
                        id="start_time"
                        name="start_time"
                        required
                        class="form-select">
                        <option value="">
                            Select a date first
                        </option>
                    </select>
                </div>
                <button type="submit" class="form-button">
                    Book Session
                </button>
            </form>

            <div class="form-back">
                <p>
                    <a href="coach_schedule.php">
                        Back to Coach Schedule
                    </a>
                </p>
                <p>
                    <a href="dashboard.php">
                        Back to Dashboard
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("booking_date").addEventListener("change", function() {
            let selectedDate = this.value;
            let slotSelect = document.getElementById("start_time");
            slotSelect.innerHTML = "";

            if (selectedDate == "") {
                let option = document.createElement("option");
                option.textContent = "Select a date first";
                option.value = "";
                slotSelect.appendChild(option);
                return;
            }

            fetch("get_slots.php?booking_date=" + selectedDate)
                .then(response => response.text())
                .then(data => {
                    slotSelect.innerHTML = data;
                })
                .catch(error => {
                    slotSelect.innerHTML =
                        '<option value="">Error loading slots</option>';
                });
        });
    </script>
</body>
</html>
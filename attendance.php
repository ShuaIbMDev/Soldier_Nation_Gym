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
$submitted = false;
$today = date("Y-m-d");
$current_month = date("Y-m");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;

    $check_sql = "SELECT *
                  FROM attendance
                  WHERE member_id = '$member_id'
                  AND attendance_date = '$today'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $message = "You are already marked as present for today.";
    } else {
        $sql = "INSERT INTO attendance
                (member_id, attendance_date)
                VALUES
                ('$member_id', '$today')";

        if ($conn->query($sql) === TRUE) {
            $attendance_id = $conn->insert_id;
            $message = "Attendance recorded successfully! Attendance ID: " . $attendance_id;
        } else {
            $message = "Attendance recording failed: " . $conn->error;

        }
    }
}

$attendance_sql = "SELECT *
                   FROM attendance
                   WHERE member_id = '$member_id'
                   AND DATE_FORMAT(attendance_date, '%Y-%m') = '$current_month'
                   ORDER BY attendance_date DESC";

$attendance_result = $conn->query($attendance_sql);
$attendance_count = $attendance_result->num_rows;

$booking_sql = "SELECT *
                FROM coach_bookings
                WHERE member_id = '$member_id'
                AND status = 'Booked'
                AND booking_date >= '$today'
                ORDER BY booking_date ASC, start_time ASC
                LIMIT 1";
$booking_result = $conn->query($booking_sql);

$booking = null;
if ($booking_result->num_rows > 0) {
    $booking = $booking_result->fetch_assoc();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - Swoldier Nation Gym</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="form-page">
        <div class="form-container">
            <p class="section-label">
                ATTENDANCE
            </p>
            <h1>
                Gym Attendance
            </h1>
            <p class="form-intro">
                Welcome,
                <strong><?php echo htmlspecialchars($member_name); ?></strong>
            </p>
            <h2>
                <?php echo date("F Y"); ?>
            </h2>
            <div class="account-card">
                <h3>
                    Your Attendance
                </h3>
                <p>
                    You have attended the gym
                    <strong><?php echo $attendance_count; ?></strong>
                    time(s) this month.
                </p>
            </div>

            <?php if ($submitted): ?>

                <p class="success-message">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <form method="POST">
                <button type="submit" class="form-button">
                    Mark Me Present
                </button>

            </form>
            <h2>
                Coach Session
            </h2>

            <?php if ($booking): ?>
                <div class="account-card">
                    <h3>
                        Your Upcoming Session
                    </h3>
                    <p>
                        <strong>Date:</strong><br>
                        <?php echo date("l, d F Y", strtotime($booking["booking_date"])); ?>
                    </p>
                    <p>
                        <strong>Start Time:</strong><br>
                        <?php echo date("h:i A", strtotime($booking["start_time"])); ?>
                    </p>
                    <p>
                        <strong>End Time:</strong><br>
                        <?php echo date("h:i A", strtotime($booking["end_time"])); ?>
                    </p>
                    <p>
                        <strong>Status:</strong><br>
                        <?php echo htmlspecialchars($booking["status"]); ?>
                    </p>
                    <p>
                        <strong>Booking ID:</strong><br>
                        <?php echo htmlspecialchars($booking["booking_id"]); ?>
                    </p>
                </div>
            <?php else: ?>
                
                <div class="account-card">
                    <h3>
                        No Coach Session
                    </h3>
                    <p>
                        You currently have no coach session booked.
                    </p>
                    <p>
                        Coach sessions are optional.
                    </p>
                </div>
            <?php endif; ?>
            <h2>
                Attendance History
            </h2>

            <?php if ($attendance_count > 0): ?>
                <div class="account-card">
                    <?php while ($row = $attendance_result->fetch_assoc()): ?>
                        <p>
                            <strong>
                                <?php
                                echo date(
                                    "l, d F Y",
                                    strtotime($row["attendance_date"])
                                );
                                ?>
                            </strong>
                            <br>
                            Present
                        </p>
                        <hr>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>

                <div class="account-card">
                    <p>
                        No attendance recorded this month yet.
                    </p>
                </div>
            <?php endif; ?>

            <div class="form-back">
                <p>
                    <a href="dashboard.php">
                        Back to Dashboard
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
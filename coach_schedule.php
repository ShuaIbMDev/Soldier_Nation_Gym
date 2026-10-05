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
$sql = "SELECT * FROM coach_schedule
        ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Schedule - Swoldier Nation Gym</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="form-page">
        <div class="form-container">
            <p class="section-label">COACHING</p>
            <h1>Coach Schedule</h1>
            <p class="form-intro">
                Coach is available from 3:00 PM to 6:00 PM,
                Monday to Friday.
            </p>

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="padding: 12px;">Day</th>
                    <th style="padding: 12px;">Start</th>
                    <th style="padding: 12px;">End</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>
                        <td style="padding: 12px;">
                            <?php echo htmlspecialchars($row["day"]); ?>
                        </td>
                        <td style="padding: 12px;">
                            <?php echo date("h:i A", strtotime($row["start_time"])); ?>
                        </td>
                        <td style="padding: 12px;">
                            <?php echo date("h:i A", strtotime($row["end_time"])); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            
            <div class="form-back">
                <a href="book_session.php" class="primary-button">
                    Book a Session
                </a>
                <br><br>
                <a href="dashboard.php">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>
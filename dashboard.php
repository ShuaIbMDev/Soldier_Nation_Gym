<?php
session_start();
if (!isset($_SESSION["member_id"])) {
    header("Location: login.php");
    exit();
}
$member_id = $_SESSION["member_id"];
$member_name = $_SESSION["member_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Swoldier Nation Gym</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-logo">
            <img src="Swoldier_Nation.jpg"
                 alt="Swoldier Nation Gym Logo">
            <span>SWOLDIER NATION</span>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="coach_schedule.php">Coach Booking</a>
            <a href="attendance.php">Attendance</a>
            <a href="payment.php">Payment</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <main class="dashboard-page">
        <div class="dashboard-container">
            <div class="dashboard-welcome">
                <p class="section-label">
                    MEMBER AREA
                </p>
                <h1>
                    Welcome, <?php echo htmlspecialchars($member_name); ?>!
                </h1>
                <p>
                    Member ID:
                    <strong>
                        #<?php echo htmlspecialchars($member_id); ?>
                    </strong>
                </p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        🏋
                    </div>
                    <h2>
                        Coach Booking
                    </h2>
                    <p>
                        Check the available coach schedule and
                        book a training session.
                    </p>
                    <a href="coach_schedule.php"
                       class="dashboard-button">
                        View Schedule
                    </a>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        💳
                    </div>
                    <h2>
                        Payments
                    </h2>
                    <p>
                        Manage your gym payments and membership
                        payment information.
                    </p>
                    <a href="payment.php"
                       class="dashboard-button">
                        Make Payment
                    </a>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        📅
                    </div>
                    <h2>
                        Attendance
                    </h2>
                    <p>
                        Check your gym attendance and keep track
                        of your training visits.
                    </p>
                    <a href="attendance.php"
                       class="dashboard-button">
                        View Attendance
                    </a>
                </div>
            </div>

            <div class="account-card">
                <p class="section-label">
                    ACCOUNT
                </p>
                <h2>
                    Your Member Information
                </h2>
                <div class="account-info">
                    <div>
                        <span>Member Name</span>
                        <strong>
                            <?php echo htmlspecialchars($member_name); ?>
                        </strong>
                    </div>

                    <div>
                        <span>Member ID</span>
                        <strong>
                            #<?php echo htmlspecialchars($member_id); ?>
                        </strong>
                    </div>
                </div>
            </div>

            <div class="dashboard-actions">
                <a href="index.php"
                   class="secondary-button">
                    ← Back to Home
                </a>
                <a href="logout.php"
                   class="primary-button">
                    Logout
                </a>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <h3>SWOLDIER NATION GYM</h3>
            <p>
                Train. Improve. Repeat.
            </p>
            <p>
                © 2026 Swoldier Nation Gym
            </p>
        </div>
    </footer>
</body>
</html>
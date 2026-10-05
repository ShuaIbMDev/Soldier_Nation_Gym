<?php
session_start();
$conn = new mysqli("127.0.0.1", "root", "", "soldier_nation", 3306);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST["member_id"];
    $phone = $_POST["phone"];
    $sql = "SELECT * FROM members
            WHERE member_id = '$member_id'
            AND phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $member = $result->fetch_assoc();
        $_SESSION["member_id"] = $member["member_id"];
        $_SESSION["member_name"] = $member["name"];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Login failed. Member ID or phone number is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Swoldier Nation Gym</title>
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
            <a href="index.php#about">About</a>
            <a href="index.php#membership">Membership</a>
            <a href="register.php">Register</a>
            <a href="login.php">Log In</a>
        </div>
    </nav>

    <main class="form-page">
        <div class="form-container">
            <p class="section-label">
                MEMBER AREA
            </p>
            <h1>
                Member Login
            </h1>
            <p class="form-intro">
                Log in to access your Soldier Nation member dashboard.
            </p>

            <?php if ($message != ""): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="registration-form">
                <div class="form-group">
                    <label for="member_id">
                        Member ID
                    </label>
                    <input
                        type="number"
                        id="member_id"
                        name="member_id"
                        placeholder="Enter your Member ID"
                        required>
                </div>

                <div class="form-group">
                    <label for="phone">
                        Phone Number
                    </label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="8-digit phone number"
                        required
                        pattern="[0-9]{8}"
                        maxlength="8"
                        minlength="8"
                        title="Phone number must contain exactly 8 digits">
                </div>
                <button type="submit" class="form-button">
                    Log In
                </button>
            </form>

            <div class="form-back">
                <p>
                    Not a member yet?
                </p>
                <a href="register.php">
                    Register as a Member
                </a>
                <br><br>
                <a href="index.php">
                    ← Back to Home
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
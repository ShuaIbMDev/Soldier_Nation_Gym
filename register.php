<?php
$conn = new mysqli("127.0.0.1", "root", "", "soldier_nation", 3306);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$message = "";
$submitted = false;
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $name = $_POST["name"];
    $phone = $_POST["phone"];

    if (!preg_match("/^[0-9]{8}$/", $phone)) {
        $message = "Registration failed. Phone number must contain exactly 8 digits.";
    } else {
        $registration_date = date("Y-m-d");
        $sql = "INSERT INTO members (name, phone, registration_date)
                VALUES ('$name', '$phone', '$registration_date')";

        if ($conn->query($sql) === TRUE) {
            $member_id = $conn->insert_id;
            $message = "Registration successful! Your Member ID is: " . $member_id;
            $success = true;
        } else {
            $message = "Registration failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Swoldier Nation Gym</title>
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
                BECOME A MEMBER
            </p>
            <h1>
                Register at Swoldier Nation
            </h1>
            <p class="form-intro">
                Fill in your details below to register as a gym member.
            </p>

            <?php if ($submitted): ?>
                <div class="<?php echo $success ? 'success-message' : 'error-message'; ?>">

                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="registration-form">
                <div class="form-group">
                    <label for="name">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your full name"
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
                    Register Member
                </button>
            </form>

            <div class="form-back">
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
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
$current_month = date("Y-m");
$monthly_sql = "SELECT *
                FROM payments
                WHERE member_id = '$member_id'
                AND payment_type = 'Monthly Membership'
                AND DATE_FORMAT(payment_date, '%Y-%m') = '$current_month'
                LIMIT 1";

$monthly_result = $conn->query($monthly_sql);
$monthly_paid = ($monthly_result->num_rows > 0);

$entrance_sql = "SELECT *
                 FROM payments
                 WHERE member_id = '$member_id'
                 AND payment_type = 'Entry Fee'
                 LIMIT 1";
$entrance_result = $conn->query($entrance_sql);
$entrance_paid = ($entrance_result->num_rows > 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $amount = $_POST["amount"];
    $payment_type = $_POST["payment_type"];
    $payment_date = date("Y-m-d");
    if ($payment_type == "Entry Fee" && $entrance_paid) {
        $message = "Your entrance fee has already been paid.";

    } elseif ($payment_type == "Monthly Membership" && $monthly_paid) {
        $message = "Your monthly membership payment for this month has already been paid.";
    } else {
        $sql = "INSERT INTO payments
                (member_id, amount, payment_type, payment_date)
                VALUES
                ('$member_id', '$amount', '$payment_type', '$payment_date')";

        if ($conn->query($sql) === TRUE) {
            $payment_id = $conn->insert_id;
            $message = "Payment recorded successfully! Payment ID: " . $payment_id;
            if ($payment_type == "Entry Fee") {
                $entrance_paid = true;
            }
            if ($payment_type == "Monthly Membership") {
                $monthly_paid = true;
            }
        } else {
            $message = "Payment failed: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Swoldier Nation Gym</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="form-page">
        <div class="form-container">
            <p class="section-label">
                MEMBERSHIP
            </p>
            <h1>
                Member Payment
            </h1>
            <p class="form-intro">
                Welcome,
                <strong><?php echo htmlspecialchars($member_name); ?></strong>
            </p>

            <h2>
                Payment Status
            </h2>
            <p>
                <strong>Member ID:</strong>
                <?php echo htmlspecialchars($member_id); ?>
            </p>
            <p>
                <strong>Month:</strong>
                <?php echo date("F Y"); ?>
            </p>

            <div class="account-card">
                <h3>
                    Monthly Membership
                </h3>
                <?php if ($monthly_paid): ?>
                    <p class="success-message">
                        PAID
                    </p>

                <?php else: ?>
                    <p class="error-message">
                        NOT PAID
                    </p>
                <?php endif; ?>
            </div>

            <div class="account-card">
                <h3>
                    Entrance Fee
                </h3>
                <p>
                    One-time payment for new members.
                </p>
                <?php if ($entrance_paid): ?>
                    <p class="success-message">
                        PAID
                    </p>

                <?php else: ?>
                    <p class="error-message">
                        NOT PAID
                    </p>
                <?php endif; ?>
            </div>

            <div class="account-card">
                <h3>
                    Membership Fees
                </h3>
                <p>
                    Check the membership prices before recording your payment.
                </p>
                <p>
                    <strong>Monthly Membership:</strong>
                    Rs 1,500
                </p>
                <p>
                    <strong>3-Month Membership:</strong>
                    Rs 4,000
                </p>
                <p>
                    <strong>6-Month Membership:</strong>
                    Rs 7,500
                </p>
                <p>
                    <strong>Entry Fee:</strong>
                    Rs 1,000
                </p>
            </div>

            <div class="account-card">
                <h3>
                    Pay via MCB Juice
                </h3>
                <p>
                    Send your payment to:
                </p>
                <p style="font-size: 24px; font-weight: bold;">
                    51199220
                </p>
                <p>
                    After making the payment, record it below.
                </p>
            </div>

            <?php if ($submitted): ?>
                <p class="success-message">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <h2>
                Record Payment
            </h2>

            <form method="POST" class="registration-form">
                <div class="form-group">
                    <label for="amount">
                        Amount
                    </label>
                    <input type="number"
                           id="amount"
                           name="amount"
                           step="0.01"
                           min="0"
                           required>
                </div>

                <div class="form-group">
                    <label for="payment_type">
                        Payment Type
                    </label>
                    <select id="payment_type"
                            name="payment_type"
                            required
                            style="width: 100%; padding: 13px; background-color: #111; border: 1px solid #444; border-radius: 5px; color: white; font-size: 15px;">
                        <option value="">
                            Select payment type
                        </option>
                        <?php if (!$monthly_paid): ?>
                            <option value="Monthly Membership">
                                Monthly Membership
                            </option>
                        <?php endif; ?>

                        <?php if (!$entrance_paid): ?>
                            <option value="Entry Fee">
                                Entrance Fee
                            </option>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="form-button">
                    Record Payment
                </button>
            </form>

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
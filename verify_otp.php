<?php
session_start();

// Redirect back if user didn't submit login first
if (!isset($_SESSION['pending_user_id'])) {
    header("Location: login.php");
    exit();
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entered_otp = trim($_POST['otp']);

    if (time() > $_SESSION['otp_expires']) {
        $error_message = "Code expired. Please try logging in again.";
        unset($_SESSION['pending_user_id'], $_SESSION['otp_code'], $_SESSION['otp_expires']);
    } elseif ($entered_otp == $_SESSION['otp_code']) {
        // Complete the login session
        $_SESSION['user_id'] = $_SESSION['pending_user_id'];
        
        // Clean up temporary OTP values
        unset($_SESSION['pending_user_id'], $_SESSION['otp_code'], $_SESSION['otp_expires']);

        header("Location: booking.php");
        exit();
    } else {
        $error_message = "Invalid code. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enter OTP - Fork & Flame</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="text-center mb-3">Verification Code</h3>
                    <p class="text-muted text-center small">Check your email for the 6-digit code.</p>

                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($error_message) ?></div>
                    <?php endif; ?>

                    <form action="verify_otp.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="otp" class="form-control text-center fs-3 letter-spacing" placeholder="123456" maxlength="6" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verify & Complete Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
session_start();
require_once 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            // User not found in database
            header("Location: login.php?error=not_found");
            exit();
        }

        if (password_verify($password, $user["password"])) {
            // Generate 6-digit OTP code and set 10-minute expiry
            $otp = random_int(100000, 999999);
            
            // Store temporary data in session (do NOT set "logged_in" to true yet)
            $_SESSION['pending_user_id'] = $user['id'];
            $_SESSION['pending_email']   = $user['email'];
            $_SESSION['otp_code']        = $otp;
            $_SESSION['otp_expires']     = time() + (10 * 60);

            // Send email with OTP code
            $to = $user['email'];
            $subject = "Your Fork & Flame Verification Code";
            $message = "Your login verification code is: " . $otp . "\n\nThis code expires in 10 minutes.";
            $headers = "From: no-reply@forkandflame.com";

            mail($to, $subject, $message, $headers);

            // Redirect user to enter their OTP
            header("Location: verify_otp.php");
            exit();
        } else {
            // Password incorrect
            header("Location: login.php?error=wrong_password");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: login.php?error=db_error");
        exit();
    }
}
?>

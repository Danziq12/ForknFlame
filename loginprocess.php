<?php
session_start();
require_once 'connectdb.php';

// Load PHPMailer classes via Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
            
            // Store temporary OTP details in session
            $_SESSION['pending_user_id'] = $user['id'];
            $_SESSION['pending_email']   = $user['email'];
            $_SESSION['otp_code']        = $otp;
            $_SESSION['otp_expires']     = time() + (10 * 60);

            // Send OTP email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // SMTP Server Settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.example.com';     // Set your SMTP server (e.g., smtp.gmail.com)
                $mail->SMTPAuth   = true;
                $mail->Username   = 'your_email@example.com'; // SMTP username
                $mail->Password   = 'your_app_password';    // SMTP password or App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ENCRYPTION_SMTPS for port 465
                $mail->Port       = 587;                   // 587 or 465

                // Recipient & Sender Setup
                $mail->setFrom('no-reply@forkandflame.com', 'Fork & Flame');
                $mail->addAddress($user['email']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your Fork & Flame Verification Code';
                $mail->Body    = "
                    <div style='font-family: Arial, sans-serif; padding: 20px;'>
                        <h2>Fork & Flame Login Verification</h2>
                        <p>Your 6-digit verification code is:</p>
                        <h1 style='color: #0d6efd; letter-spacing: 4px;'>{$otp}</h1>
                        <p>This code will expire in 10 minutes.</p>
                    </div>
                ";
                $mail->AltBody = "Your login verification code is: {$otp}\n\nThis code expires in 10 minutes.";

                $mail->send();

                // Redirect user to enter their OTP
                header("Location: verify_otp.php");
                exit();

            } catch (Exception $e) {
                // Mail sending failed
                header("Location: login.php?error=mail_failed");
                exit();
            }

        } else {
            // Incorrect password
            header("Location: login.php?error=wrong_password");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: login.php?error=db_error");
        exit();
    }
}
?>

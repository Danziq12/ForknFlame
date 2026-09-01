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
        // Fetch user from database
        $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            header("Location: login.php?error=not_found");
            exit();
        }

        if (password_verify($password, $user["password"])) {
            // 1. Generate 6-digit OTP code and set 10-minute expiry
            $otp = random_int(100000, 999999);
            
            // 2. Store temporary OTP details in session
            $_SESSION['pending_user_id'] = $user['id'];
            $_SESSION['pending_email']   = $user['email'];
            $_SESSION['otp_code']        = $otp;
            $_SESSION['otp_expires']     = time() + (10 * 60);

            // 3. Send OTP email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Fetch email from environment variable or set your actual Gmail address here
                $smtpUser = $_ENV['SMTP_USER'] ?? getenv('SMTP_USER') ?: 'your_actual_gmail@gmail.com';

                // Server Settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = $smtpUser;
                $mail->Password   = 'ajjxxnbjcjehxyjp'; // App Password without spaces
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Sender and Recipient
                $mail->setFrom($smtpUser, 'Danziq'); // Quotes added here
                $mail->addAddress($user['email']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your Fork & Flame Verification Code';
                $mail->Body    = "
                    <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f8f9fa;'>
                        <div style='max-width: 500px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px;'>
                            <h2 style='color: #212529; text-align: center;'>Fork & Flame</h2>
                            <p style='color: #6c757d;'>Your 6-digit login verification code is:</p>
                            <div style='text-align: center; margin: 20px 0;'>
                                <span style='font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #0d6efd;'>{$otp}</span>
                            </div>
                            <p style='color: #6c757d; font-size: 14px;'>This code will expire in 10 minutes. If you did not request this, please ignore this email.</p>
                        </div>
                    </div>
                ";
                $mail->AltBody = "Your Fork & Flame login verification code is: {$otp}\n\nThis code expires in 10 minutes.";

                $mail->send();

                // Redirect to OTP entry page
                header("Location: verify_otp.php");
                exit();

            } catch (Exception $e) {
                // Display error explicitly during debugging
                die("PHPMailer Error: " . $mail->ErrorInfo);
            }

        } else {
            header("Location: login.php?error=wrong_password");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: login.php?error=db_error");
        exit();
    }
}
?>

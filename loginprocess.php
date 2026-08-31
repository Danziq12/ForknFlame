<?php
session_start();
header('Content-Type: application/json');

require_once 'connectdb.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Please enter your email and password.']);
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
            exit();
        }

        // Fetch user record by email
        $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['logged_in'] = true;
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['email']     = $user['email'];

            echo json_encode([
                'success' => true,
                'message' => 'Login successful.',
                'redirect' => 'index.php'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect email or password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>

<?php

session_start();

include 'connectdb.php';

$error = "";

if (
    isset($_SESSION["logged_in"]) &&
    $_SESSION["logged_in"] === true
) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';
    $confirmPassword = $_POST["confirm_password"] ?? '';

    if (
        empty($email) ||
        empty($password) ||
        empty($confirmPassword)
    ) {

        $error = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif (strlen($password) < 8) {

        $error = "Password must be at least 8 characters.";

    } elseif ($password !== $confirmPassword) {

        $error = "Passwords do not match.";

    } else {

        try {
            // 1. Check if email already exists using PDO
            $checkSql = "SELECT id FROM users WHERE email = ? LIMIT 1";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([$email]);

            if ($checkStmt->fetch()) {

                $error = "This email is already registered. Please login.";

            } else {

                // 2. Hash password and insert user using PDO
                $hashedPassword = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                $insertSql = "INSERT INTO users (email, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($insertSql);

                if ($stmt->execute([$email, $hashedPassword])) {

                    header("Location: login.php?registered=1");
                    exit();

                } else {

                    $error = "Registration failed. Please try again.";

                }
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Sign Up - Fork & Flame
    </title>

    <link
        rel="stylesheet"
        href="bootstrap.css"
    >

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<nav
    class="navbar navbar-expand-lg bg-primary"
    data-bs-theme="dark"
>

    <div class="container-fluid">

        <a
            class="navbar-brand"
            href="index.php"
        >
            Fork & Flame
        </a>

    </div>

</nav>


<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Create Account
                    </h2>


                    <?php if (!empty($error)) { ?>

                        <div class="alert alert-danger">

                            <?php
                            echo htmlspecialchars($error);
                            ?>

                        </div>

                    <?php } ?>


                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                maxlength="100"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                minlength="8"
                                required
                            >

                            <small class="text-muted">

                                Minimum 8 characters.

                            </small>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                minlength="8"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Sign Up
                        </button>

                    </form>


                    <div class="text-center mt-3">

                        <p class="mb-2">

                            Already have an account?

                        </p>

                        <a
                            href="login.php"
                            class="btn btn-outline-primary w-100"
                        >
                            Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>

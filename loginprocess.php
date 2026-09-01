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

            // User not found in database -> Redirect with query parameter

            header("Location: login.php?error=not_found");

            exit();

        }



        if (password_verify($password, $user["password"])) {

            session_regenerate_id(true);

            $_SESSION["logged_in"] = true;

            $_SESSION["user_id"]   = $user["id"];

            $_SESSION["email"]     = $user["email"];



            header("Location: index.php");

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

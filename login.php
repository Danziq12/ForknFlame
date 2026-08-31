
<?php

session_start();

include 'connectdb.php';

$error = "";
$success = "";

if (
    isset($_SESSION["logged_in"]) &&
    $_SESSION["logged_in"] === true
) {

    header("Location: index.php");
    exit();

}

if (isset($_GET["registered"])) {

    $success =
        "Registration successful. Please login.";

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (
        empty($email) ||
        empty($password)
    ) {

        $error =
            "Please enter your email and password.";

    } elseif (
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $error =
            "Please enter a valid email address.";

    } else {

        $sql = "
            SELECT id, email, password
            FROM users
            WHERE email = ?
            LIMIT 1
        ";

        $stmt =
            $conn->prepare($sql);

        $stmt->bind_param(
            "s",
            $email
        );

        $stmt->execute();

        $result =
            $stmt->get_result();

        if (
            $result->num_rows === 1
        ) {

            $user =
                $result->fetch_assoc();

            if (
                password_verify(
                    $password,
                    $user["password"]
                )
            ) {

                session_regenerate_id(true);

                $_SESSION["logged_in"] =
                    true;

                $_SESSION["user_id"] =
                    $user["id"];

                $_SESSION["email"] =
                    $user["email"];

                header(
                    "Location: index.php"
                );

                exit();

            } else {

                $error =
                    "Incorrect email or password.";

            }

        } else {

            $error =
                "Account not found. Please sign up first.";

        }

        $stmt->close();

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
        Login - Fork & Flame
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
                        Login
                    </h2>


                    <?php
                    if (!empty($success))
                    {
                    ?>

                        <div class="alert alert-success">

                            <?php
                            echo htmlspecialchars(
                                $success
                            );
                            ?>

                        </div>

                    <?php
                    }
                    ?>


                    <?php
                    if (!empty($error))
                    {
                    ?>

                        <div class="alert alert-danger">

                            <?php
                            echo htmlspecialchars(
                                $error
                            );
                            ?>

                        </div>

                    <?php
                    }
                    ?>


                    <form method="POST">

                        <div class="mb-3">

                            <label
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label
                                class="form-label"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>


                    <div
                        class="text-center mt-3"
                    >

                        <p class="mb-2">

                            Don't have an account?

                        </p>

                        <a
                            href="register.php"
                            class="btn btn-outline-primary w-100"
                        >
                            Sign Up
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
```

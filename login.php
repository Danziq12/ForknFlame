<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login - Fork & Flame</title>

<link rel="stylesheet" href="bootstrap.css">

<link rel="stylesheet" href="style.css">

</head>

<body>



<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">

<div class="container-fluid">

<a class="navbar-brand" href="index.php">Fork & Flame</a>

</div>

</nav>



<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body p-4">

<h2 class="text-center mb-4">Login</h2>



<form action="loginprocess.php" method="POST">

<div class="mb-3">

<label class="form-label">Email</label>

<input type="email" name="email" class="form-control" required>

</div>



<div class="mb-3">

<label class="form-label">Password</label>

<input type="password" name="password" class="form-control" required>

</div>



<button type="submit" class="btn btn-primary w-100">Login</button>

</form>



<div class="text-center mt-3">

<p class="mb-2">Don't have an account?</p>

<a href="register.php" class="btn btn-outline-primary w-100">Sign Up</a>

</div>

</div>

</div>

</div>

</div>

</div>



<!-- Pop-up Script for unregistered/not found users -->

<script>

const urlParams = new URLSearchParams(window.location.search);

const errorType = urlParams.get('error');



if (errorType === 'not_found') {

alert("Account not found! It looks like you haven't registered yet. Please sign up first.");

} else if (errorType === 'wrong_password') {

alert("Incorrect password. Please try again.");

}

</script>



</body>

</html>

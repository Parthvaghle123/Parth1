<?php
include("connection.php");

$lifetime = 31536000; // 1 year

ini_set('session.gc_maxlifetime', $lifetime);
ini_set('session.cookie_lifetime', $lifetime);
session_set_cookie_params($lifetime);

// Prevent auto logout by reducing garbage collection frequency
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);


session_start();
if (isset($_SESSION['AdminLoginId'])) {
  header("Location: index.php");
  exit();
}
if (isset($_POST["submit"])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  // Step 1: Check if username exists
  $checkLoginUser = mysqli_query($con, "SELECT * FROM login WHERE username='$username'");

  if (mysqli_num_rows($checkLoginUser) == 0) {
    echo "<script>alert('Username does not exist. Please sign up first.'); window.location.href='index6.php';</script>";
    exit();
  }

  // Step 2: Check password
  $checkLogin = mysqli_query($con, "SELECT * FROM login WHERE username='$username' AND password='$password'");
  if (mysqli_num_rows($checkLogin) == 0) {
    echo "<script>alert('Incorrect password.');window.location.href='index5.php';</script>";
    exit();
  }

  // Step 3: Check signup form filled
  $checkSign = mysqli_query($con, "SELECT * FROM sign WHERE username='$username'");
  if (mysqli_num_rows($checkSign) == 0) {
    echo "<script>alert('Please complete the signup form first.'); window.location.href='index6.php';</script>";
    exit();
  }

  // ✅ SUCCESS → Set session
  $_SESSION['AdminLoginId'] = $username;
  $_SESSION['username'] = $username;

  // ✅ Show loader and timer before redirect
  echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Successful</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  .loader {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #FF3D00;
            position: relative;
            margin: 20px auto;
        }
        .loader:before, .loader:after {
            content: "";
            position: absolute;
            border-radius: 50%;
            inset: 0;
            background: gray;
            transform: rotate(0deg) translate(30px);
            animation: rotate 1s ease infinite;
        }
        .loader:after {
            animation-delay: 0.5s;
        }
        @keyframes rotate {
            100% { transform: rotate(360deg) translate(30px); }
        }
        body {
            text-align: center;
            font-family: Arial;
            margin-top: 15%;
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center flex-column">
  <div class="loader"></div>
  <h4 class="fw-bold display-6 text-center fst-italic">Please Wait... <span id="seconds"></span></h4>
</div>
<script>
    let seconds = 3;
    const countdown = setInterval(function () {
        document.getElementById('seconds').innerText = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
            window.location.href = 'index.php'; // Redirect
        }
        seconds--;
    }, 1000);
</script>
</body>
</html>
HTML;
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login Panel</title>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

  <div class="container">
    <div class="myform">
      <form method="POST">
        <h2>ADMIN LOGIN</h2>
        <input type="text" placeholder="Username" name="username" class="head" id="username" >
        <input type="password" placeholder="Password" name="password" class="head" id="password">
             <div style="margin-bottom:15px;" class="forgot-link">
          <a href="index7.php" style="color: #007bff; text-decoration: none;">Forgot Password?</a>
        </div>
        <button type="submit" name="submit"><i class="fa fa-sign-in-alt"></i> LOGIN</button>
      </form>
    </div>
  </div>

<script src="validation.js"></script>
</body>
</html>

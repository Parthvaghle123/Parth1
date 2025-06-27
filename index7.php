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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($con, $_POST['username']) : '';
    $new_password = isset($_POST['new_password']) ? mysqli_real_escape_string($con, $_POST['new_password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($con, $_POST['confirm_password']) : '';

    if (empty($username) || empty($new_password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.');</script>";
    } elseif ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        // Check if user exists
        $checkQuery = "SELECT * FROM login WHERE username = '$username'";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update password
            $updateQuery = "UPDATE login SET password = '$new_password' WHERE username = '$username'";
            if (mysqli_query($con, $updateQuery)) {
                echo "<script>
                    alert('Password updated successfully.');
                    window.location.href = 'index.php'; // redirect to login page
                </script>";
            } else {
                echo "<script>alert('Error updating password: " . mysqli_error($con) . "');</script>";
            }
        } else {
            echo "<script>alert('Username not found.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>D-Moll | ForgetPassword</title>
  <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
  
  <div class="container">
    <div class="myform">
      <form method="POST">
        <h2>Reset Password</h2>
        <input type="text" placeholder="Username" name="username" class="head" id="username">
        <input type="password" placeholder="Password" name="new_password" class="head" id="password">
        <input type="password" placeholder="ConfirmPassword" name="confirm_password" class="head" id="password">
        <button type="submit" name="submit"><i class="fa fa-sign-in-alt"></i> Reset</button>
      </form>
    </div>
 
  </div>
<script src="validation.js"></script>
</body>
</html>
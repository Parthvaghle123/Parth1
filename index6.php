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


if (isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['country_code'] . $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match');window.location.href='index6.php';</script>";
        exit();
    }

    $checkUser = mysqli_query($con, "SELECT * FROM login WHERE username='$username'");
    if (mysqli_num_rows($checkUser) > 0) {
        echo "<script>alert('Username already exists. Please login.');window.location.href='index5.php';</script>";
        exit();
    }

    $insertLogin = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
    $insertSign = "INSERT INTO sign (username, email, phone, gender, dob, address)
                   VALUES ('$username', '$email', '$phone', '$gender', '$dob', '$address')";

    if (mysqli_query($con, $insertLogin) && mysqli_query($con, $insertSign)) {
        $_SESSION['AdminLoginId'] = $username;
        $_SESSION['username'] = $username;

        // Timer Redirect
        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup Success</title>
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
  <h4 class="fw-bold display-6 text-center fst-italic"> Please Wait... <span id="seconds"></span></h4>
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
    } else {
        echo "<script>alert('Signup failed: " . mysqli_error($con) . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>D-Moll | Sign Up</title>
  <link rel="stylesheet" href="sign.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <div class="myform">
      <form method="POST" >
        <h2>Sign-Up</h2>

        <!-- Username -->
        <input type="text" name="username" placeholder="Username" required class="head" id="username" />

        <!-- Email -->
        <input type="email" name="email" placeholder="Email" required class="head" id="email" />

        <!-- Phone Number with Country Code -->
        <div style="display: flex; gap: 10px; align-items: center;">
          <select name="country_code" required style="height: 30px; border-radius: 5px;margin-bottom:20px;">
            <option value="+91" selected>+91 (India)</option>
            <option value="+1">+1 (USA)</option>
            <option value="+44">+44 (UK)</option>
            <option value="+61">+61 (Australia)</option>
          </select>
          <input type="tel" name="phone" placeholder="Phone Number" required class="head"
            pattern="[0-9]{10}" title="Enter 10-digit phone number" style="flex: 1;" />
        </div>

        <!-- Gender -->
        <div class="gender">
          <label><input type="radio" name="gender" value="male" required /> Male</label>
          <label><input type="radio" name="gender" value="female" /> Female</label>
          <label><input type="radio" name="gender" value="other" /> Other</label>
        </div>

        <!-- Date of Birth -->
        <input type="date" name="dob" placeholder="Date of Birth" required style="margin-top:10px" class="head" />

        <!-- Address -->
        <input type="text" name="address" placeholder="Address" required class="head"id=address />
        <!-- Password Field -->
        <div style="position: relative; margin-bottom: 10px;">
          <input type="password" name="password" placeholder="Password" required class="head" id="password" />
          <i class="fa fa-eye" id="togglePassword" style="
            position: absolute;
            top: 30%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            display: none;
          "></i>
        </div>

        <!-- Confirm Password Field -->
        <div style="position: relative; ">
          <input type="password" name="confirmpassword" placeholder="Confirm Password" required class="head" id="confirmpassword" />
          <i class="fa fa-eye" id="toggleConfirmPassword" style="
            position: absolute;
            top: 30%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            display: none;
          "></i>
        </div>
        <!-- Submit Button -->
        <button type="submit" name="submit"><i class="fa fa-sign-in-alt"></i> Sign-In</button>

      </form>
    </div>
  </div>
  <script>
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirmpassword");
    const togglePassword = document.getElementById("togglePassword");
    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");

    // Show/hide eye icon based on input
    passwordField.addEventListener("input", function() {
      togglePassword.style.display = this.value ? "block" : "none";
    });

    confirmPasswordField.addEventListener("input", function() {
      toggleConfirmPassword.style.display = this.value ? "block" : "none";
    });

    // Toggle password visibility
    togglePassword.addEventListener("click", function() {
      const type = passwordField.type === "password" ? "text" : "password";
      passwordField.type = type;
      this.classList.toggle("fa-eye-slash");
    });

    toggleConfirmPassword.addEventListener("click", function() {
      const type = confirmPasswordField.type === "password" ? "text" : "password";
      confirmPasswordField.type = type;
      this.classList.toggle("fa-eye-slash");
    });
  </script>
<script src="validation.js"></script>
</body>

</html>
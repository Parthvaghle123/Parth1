<?php
include("config.php");
session_start();

$count = 0;
if (isset($_SESSION['cart'])) {
  $count = count($_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-Moll</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="header.css">
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top ">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <h3 class="text-center fs-2">
          Prizemarkt
        </h3>
      </a>
      <button
        class="navbar-toggler "
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3 gap-5 nav-links">
          <li class="nav-item">
            <a class="nav-link underline-animate" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link underline-animate" href="index2.php">Gift</a>
          </li>
          <li class="nav-item">
            <a class="nav-link underline-animate" href="index3.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link underline-animate" href="index4.php">Order</a>
          </li>
        </ul>
        <form class="d-flex me-4">
          <input
            class="me-2 search bg-light w-100 head"
            type="search"
            placeholder="Search"
            aria-label="Search"
            id="search" />
          <button id="searchButton" class="btn1 btn btn-success" onclick="searchProducts();" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        <div class="d-flex">
          <a href="mycart.php" class="btn2 btn btn-success w-100 h-50">MyCart(<?= $count ?>)</a>
          <!-- Keep this inside <div class="ms-2 d-flex mb-1"> -->
          <div class="dropdown nav-item position-relative text-center">
            <a class="nav-link dropdown-toggle fw-bold text-dark " href="#" id="navbarDropdown"
              role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle"></i> Account
            </a>
          <?php

            // Logout logic
            if (isset($_POST['Logout'])) {
              unset($_SESSION['AdminLoginId']) ;           
              session_destroy();
              header("Location: index.php"); // redirect to login or home page
              exit();
            }
            ?>

            <!-- Dropdown Menu HTML -->
            <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdown">
              <?php if (isset($_SESSION['AdminLoginId'])): ?>

                <!-- Show Logged-in Username -->
                <li class="dropdown-header text-success fw-bold">
                  <i class="fas fa-user me-2"></i>
                  <?php echo htmlspecialchars($_SESSION['AdminLoginId']); ?>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <!-- Logout Button -->
                <li>
                  <form method="POST" style="margin: 0;">
                    <button class="dropdown-item underline-animate fw-bold" type="submit" name="Logout">
                      <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                  </form>
                </li>

              <?php else: ?>

                <!-- If user is not logged in -->
                <li><a class="dropdown-item underline-animate" href="index5.php"><i class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                <li><a class="dropdown-item underline-animate" href="index6.php"><i class="fas fa-user-plus me-2"></i>Sign-Up</a></li>

              <?php endif; ?>
            </ul>

          </div>
        </div>
      </div>
    </div>
    </div>
  </nav>
  
</body>
</html>
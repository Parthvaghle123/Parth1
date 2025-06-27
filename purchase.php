<?php
session_start();

// USER LOGIN ચેક કરો
if (!isset($_SESSION['username'])) {
    echo "<script>
        alert('Please login to the form');
        window.location.href = 'index6.php';
    </script>";
    exit();
}

$con = mysqli_connect("localhost", "root", "", "user");

if (mysqli_connect_errno()) {
    echo "<script>
        alert('Cannot connect to database');
        window.location.href='mycart.php';
    </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['purchase'])) {

    $username = $_SESSION['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pay_mode = $_POST['pay_mode'];
    $card_number = !empty($_POST['card_number']) ? "'{$_POST['card_number']}'" : "NULL";
    $expiry=!empty($_POST['card_number']) ? "'{$_POST['card_number']}'" : "NULL";
    $cvv = !empty($_POST['cvv']) ? "'{$_POST['cvv']}'" : "NULL";
    $date = date('Y-m-d');

    // Insert into order_manager
    $query1 = "INSERT INTO `order_manager` 
        (`Email`,`Phone`, `Address`, `Pay_Mode`, `username`, `Card_Number`, `CVV`,`Card_Expiry`, `Date`, `Status`) 
        VALUES ('$email', '$phone','$address', '$pay_mode', '$username', $card_number, $cvv,$expiry, '$date', 'Approved')";

    if (mysqli_query($con, $query1)) {
        $Order_Id = mysqli_insert_id($con);

        $query2 = "INSERT INTO `user_order` (`Order_Id`, `Item_Name`, `Price`, `Quantity`, `Status`) 
                   VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query2);

        if ($stmt) {
            foreach ($_SESSION['cart'] as $item) {
                $status = 'Approved';
                mysqli_stmt_bind_param($stmt, "isiis", $Order_Id, $item['Item_Name'], $item['Price'], $item['Quantity'], $status);
                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
            unset($_SESSION['cart']); // clear cart

            // Success Timer
            echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Order Placed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
  <h4 class="fw-bold display-6 text-center fst-italic">Order Successful. Please Wait... <span id="seconds">4</span></h4>
</div>
<script>
    let seconds = 4;
    const countdown = setInterval(function () {
        document.getElementById('seconds').innerText = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
            window.location.href = 'index4.php'; // Redirect
        }
        seconds--;
    }, 1000);
</script>
</body>
</html>
HTML;
            exit();
        } else {
            echo "<script>
                alert('Error while inserting order items.');
                window.location.href='mycart.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error while inserting into order_manager.');
            window.location.href='mycart.php';
        </script>";
    }
}
?>

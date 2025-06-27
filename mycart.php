<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>D-Moll | My Cart</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="header.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

  <style>
    body {
      background-color: #f1f3f5;
    }

    .card-custom {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
      padding: 20px;
    }

    th,
    td {
      vertical-align: middle !important;
    }

    .btn-danger:hover,
    .btn-success:hover {
      transform: scale(1.05);
    }

    .btn-success {
      font-weight: bold;
      letter-spacing: 0.5px;
    }

    .itotal,
    #total {
      font-weight: 600;
    }

    .navbar ul {
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .table-responsive {
        font-size: 0.9rem;
      }
    }

    /* Table responsiveness on mobile */
    .table-responsive {
      overflow-x: auto;
    }

    /* Enhanced hover effect on table rows */
    .table-bordered tr:hover {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body>
  <div class="container py-5">
    <div class="row g-4">
      <!-- Heading Section -->
      <div class="col-12">
        <div class="card-custom text-center">
          <h2 class="mb-0">🛒 My Cart</h2>
        </div>
      </div>

      <!-- Cart Items Table -->
      <div class="col-lg-8">
        <div class="table-responsive card-custom">
          <table class="table table-bordered text-center mb-0">
            <thead class="table-dark">
              <tr>
                <th>Serial No.</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (isset($_SESSION["cart"])) {
                $serial = 1;
                foreach ($_SESSION['cart'] as $key => $value) {
                  $quantity = isset($value['Quantity']) ? (int)$value['Quantity'] : 1;
                  $price = isset($value['Price']) ? (int)$value['Price'] : 0;
                  $itemTotal = $price * $quantity;
                  $total += $itemTotal;
              ?>
                  <tr>
                    <td><?= $serial++; ?></td>
                    <td><?= htmlspecialchars($value['Item_Name']); ?></td>
                    <td>₹<?= $price; ?><input type="hidden" class="iprice" value="<?= $price; ?>"></td>
                    <td>
                      <form action="manage_cart.php" method="POST">
                        <input class="form-control text-center iquantity" type="number" name="Mod_Quantity" onchange="this.form.submit()" value="<?= $quantity; ?>" min="1" max="32" required>
                        <input type="hidden" name="Item_Name" value="<?= htmlspecialchars($value['Item_Name']); ?>">
                      </form>
                    </td>
                    <td class="itotal">₹<?= $itemTotal; ?></td>
                    <td>
                      <form action="manage_cart.php" method="POST">
                        <input type="hidden" name="Item_Name" value="<?= htmlspecialchars($value['Item_Name']); ?>">
                        <button class="btn btn-sm btn-danger" name="Remove_Item">Remove</button>
                      </form>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Order Summary Section -->
      <div class="col-lg-4">
        <div class="card-custom">
          <h4 class="mb-3">Order Summary</h4>
          <div class="d-flex justify-content-between mb-3">
            <span>Total:</span>
            <span id="total">₹<?= $total; ?></span>
          </div>
          <hr>

          <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <form action="purchase.php" method="POST">
              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email ID</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>

              <!-- Phone with +91 Dropdown -->
              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                  <select class="form-select" name="country_code" style="max-width: 100px;" required>
                    <option value="+91" selected>+91 🇮🇳</option>
                    <option value="+1">+1 🇺🇸</option>
                    <option value="+44">+44 🇬🇧</option>
                    <option value="+61">+61 🇦🇺</option>
                    <option value="+81">+81 🇯🇵</option>
                  </select>
                  <input type="tel" class="form-control" name="phone" id="phone" placeholder="9876543210" pattern="[0-9]{6,15}" maxlength="15" required>
                </div>
              </div>

              <!-- Address -->
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="address" rows="2" required></textarea>
              </div>

              <!-- Payment -->
              <div class="mb-3">
                <label class="form-label">Payment Mode</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="pay_mode" id="cod" value="COD" required onchange="toggleCardBox()">
                  <label class="form-check-label" for="cod">Cash On Delivery</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="pay_mode" id="online" value="Online" onchange="toggleCardBox()">
                  <label class="form-check-label" for="online">Online Payment</label>
                </div>
              </div>

              <!-- Credit Card Fields (hidden by default) -->
              <div id="card-box" style="display: none;">
                <div class="mb-3">
                  <label for="card_number" class="form-label">Credit Card Number</label>
                  <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456">
                </div>
                <div class="mb-3">
                  <label for="expiry" class="form-label">Expiry Date (MM/YY)</label>
                  <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY">
                </div>
                <div class="mb-3">
                  <label for="cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123">
                </div>
              </div>

              <button type="submit" class="btn btn-success w-100" name="purchase">Order Now</button>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <script>
    function toggleCardBox() {
      const isOnline = document.getElementById('online').checked;
      document.getElementById('card-box').style.display = isOnline ? 'block' : 'none';
    }

    // Format credit card number
    $('#card_number').on('input', function() {
      let value = this.value.replace(/\D/g, '').substring(0, 16);
      this.value = value.replace(/(.{4})/g, '$1 ').trim();
    });

    // CVV: Only numbers, max 4
    $('#cvv').on('input', function() {
      this.value = this.value.replace(/\D/g, '').substring(0, 4);
    });

    // Expiry Date Format MM/YY
    $('#expiry').on('input', function() {
      let val = this.value.replace(/\D/g, '');
      if (val.length >= 3) {
        val = val.substring(0, 2) + '/' + val.substring(2, 4);
      }
      this.value = val;
    });

    // Final validation on submit
    function validateForm() {
      if ($('#online').is(':checked')) {
        let cardNumber = $('#card_number').val().replace(/\s/g, '');
        let expiry = $('#expiry').val();
        let cvv = $('#cvv').val();

        // Card number validation
        if (cardNumber.length !== 16 || isNaN(cardNumber)) {
          alert('Please enter a valid 16-digit Card Number.');
          return false;
        }

        // Expiry validation MM/YY
        if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
          alert('Please enter a valid Expiry Date in MM/YY format.');
          return false;
        }

        // CVV validation
        if (cvv.length < 3 || cvv.length > 4 || isNaN(cvv)) {
          alert('Please enter a valid CVV (3 or 4 digits).');
          return false;
        }
      }

      // Phone number validation
      let phone = $('#phone').val();
      if (!/^\d{10}$/.test(phone)) {
        alert('Please enter a valid 10-digit phone number.');
        return false;
      }

      return true; // ✅ All validations passed
    }
  </script>


  <!-- JavaScript for Cart -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const iprice = document.querySelectorAll('.iprice');
      const iquantity = document.querySelectorAll('.iquantity');
      const itotal = document.querySelectorAll('.itotal');
      const total = document.getElementById('total');

      function updateSubtotal() {
        let grandTotal = 0;
        iprice.forEach((price, index) => {
          let itemTotal = price.value * iquantity[index].value;
          itotal[index].innerText = "₹" + itemTotal;
          grandTotal += itemTotal;
        });
        total.innerText = "₹" + grandTotal;
      }

      updateSubtotal();
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
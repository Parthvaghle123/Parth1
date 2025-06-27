<?php
// session_start();
include("connection.php");
include("header.php");

$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$username = $_SESSION['username'] ?? null;

// Cancel logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['cancel_reason'])) {
  $order_id = $_POST['order_id'];
  $reason = $_POST['cancel_reason'];

  if ($reason === 'Someone any Reason' && !empty($_POST['custom_reason'])) {
    $reason = $_POST['custom_reason'];
  }

  $stmt1 = $con->prepare("UPDATE order_manager SET Status = 'Cancelled', Reason = ? WHERE Order_Id = ?");
  $stmt1->bind_param("si", $reason, $order_id);
  $stmt1->execute();
  $stmt1->close();

  $stmt2 = $con->prepare("UPDATE user_order SET Status = 'Cancelled' WHERE Order_Id = ?");
  $stmt2->bind_param("i", $order_id);
  $stmt2->execute();
  $stmt2->close();

  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="header.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', sans-serif;
    }

    .order-wrapper {
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .table-title {
      font-size: 1.8rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    .order-table thead th {
      background-color: #212529;
      color: #fff;
    }

    .order-table th,
    .order-table td {
      vertical-align: middle;
      font-size: 15px;
    }

    .nested-table th {
      background-color: #f8f9fa;
    }

    .nested-table td,
    .nested-table th {
      font-size: 14px;
      padding: 0.4rem 0.5rem;
    }

    .total-cell {
      font-weight: bold;
      color: #0d6efd;
    }

    .table-responsive {
      overflow-x: auto;
    }

    .no-hover tbody tr {
      background-color: #fff;
    }

    @media (max-width: 576px) {
      .table-title {
        font-size: 1.4rem;
      }
    }

    .btn-danger:hover {
      background-color: white;
      color: red;
    }
  </style>
</head>

<body>
  <div class="container mt-5 mb-5">
    <div class="order-wrapper">
      <div class="table-title">📋 My Orders</div>
      <div class="table-responsive">
        <table class="table table-bordered text-center order-table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Address</th>
              <th>Pay Mode</th>
              <th>Items</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($username) {
              $stmt = $con->prepare("SELECT * FROM order_manager WHERE username = ?");
              $stmt->bind_param("s", $username);
              $stmt->execute();
              $result = $stmt->get_result();

              while ($order = $result->fetch_assoc()) {
                $order_id = $order['Order_Id'];
                echo "<tr>
                <td>{$order['Order_Id']}</td>
                <td>{$order['username']}</td>
                <td>{$order['Email']}</td>
                <td>{$order['Address']}</td>
                <td>{$order['Pay_Mode']}</td>
                <td>
                  <table class='table table-sm table-bordered nested-table mb-0'>
                    <thead>
                      <tr><th>Item</th><th>Price</th><th>Qty</th><th>Total</th><th>Status</th></tr>
                    </thead>
                    <tbody>";
                $item_stmt = $con->prepare("SELECT * FROM user_order WHERE Order_Id = ?");
                $item_stmt->bind_param("i", $order_id);
                $item_stmt->execute();
                $items = $item_stmt->get_result();

                $order_total = 0;
                while ($item = $items->fetch_assoc()) {
                  $total = $item['Price'] * $item['Quantity'];
                  $order_total += $total;
                  echo "<tr>
                    <td>{$item['Item_Name']}</td>
                    <td>₹{$item['Price']}</td>
                    <td>{$item['Quantity']}</td>
                    <td>₹{$total}</td>
                    <td>{$item['Status']}</td>
                  </tr>";
                }

                echo "<tr>
                <td colspan='3' class='text-end total-cell'>Total:</td>
                <td class='total-cell'>₹{$order_total}</td>
                <td></td>
              </tr></tbody></table>
              </td>
              <td><span class='badge bg-" .
                  ($order['Status'] === 'Approved' ? "success" : ($order['Status'] === 'Cancelled' ? "danger" : "warning")) . "'>{$order['Status']}</span></td>
              <td>";

                if ($order['Status'] === 'Approved') {
                  echo "<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#cancelModal' onclick='setCancelOrderId({$order_id})'>Cancel</button>";
                } else {
                  echo "<span class='text-muted'>No Action</span>";
                }

                echo "</td></tr>";
                $item_stmt->close();
              }
              $stmt->close();
            } else {
              echo "<tr><td colspan='8' class='fw-bold'>Please login to view your orders.</td></tr>";
            }
            $con->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Cancel Reason Modal -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancelModalLabel">Cancel Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="order_id" id="cancelOrderId">

          <!-- Reason Options -->
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cancel_reason" value="Wrong contact number entered">
            <label class="form-check-label">Wrong contact number entered</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cancel_reason" value="Wrong address selected">
            <label class="form-check-label">Wrong address selected</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cancel_reason" value="Ordered by mistake">
            <label class="form-check-label">Ordered by mistake</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cancel_reason" value="Expected delivery time is too long">
            <label class="form-check-label">Expected delivery time is too long</label>
          </div>

          <!-- Someone any reason (with text area) -->
          <div class="form-check">
            <input class="form-check-input" type="radio" name="cancel_reason" value="Someone any Reason" id="otherReasonRadio">
            <label class="form-check-label" for="otherReasonRadio">Someone any Reason</label>
          </div>

          <!-- Text area hidden initially -->
          <div class="mt-2" id="customReasonBox" style="display: none;">
            <label for="custom_reason" class="form-label">Write your reason:</label>
            <textarea class="form-control" name="custom_reason" id="custom_reason" placeholder="Write your reason here..."></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Submit Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JavaScript to handle textarea display -->
  <script>
    // બધા reason radio બટન માટે click ઈવેન્ટ
    document.querySelectorAll('input[name="cancel_reason"]').forEach(function(radio) {
      radio.addEventListener('change', function() {
        if (this.value === 'Someone any Reason') {
          document.getElementById('customReasonBox').style.display = 'block';
        } else {
          document.getElementById('customReasonBox').style.display = 'none';
        }
      });
    });
  </script>
  <script>
    function setCancelOrderId(id) {
      document.getElementById('cancelOrderId').value = id;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
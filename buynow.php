<?php
session_start();

$orderPlaced = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
  $_SESSION['cart'] = [];
  $orderPlaced = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buy Now - NexBuy</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffe0b2; color: #333; }
    header { background-color: #222; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    header .logo { font-size: 1.5rem; font-weight: bold; }
    header nav a { color: #fff; text-decoration: none; margin-left: 1.5rem; transition: color 0.3s ease; }
    header nav a:hover { color: white; }
    .brand-name { color: orange; }

    .container { max-width: 800px; margin: 2rem auto; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; margin-bottom: 1.5rem; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 2rem; }
    th, td { padding: 0.8rem; border: 1px solid #ccc; text-align: left; }
    th { background-color: #f5f5f5; }

    form label { display: block; margin-top: 1rem; font-weight: bold; }
    form input, form select, form textarea {
      width: 100%; padding: 0.5rem; margin-top: 0.3rem;
      border: 1px solid #ccc; border-radius: 5px;
    }

    .place-order-btn {
      margin-top: 1.5rem;
      padding: 0.75rem 1.5rem;
      background-color: orange;
      color:black;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }
    .place-order-btn:hover { background-color: #e69500; }

    .success {
      text-align: center;
      padding: 2rem;
      background-color:orange;
      color:black;
      border-radius: 10px;
    }

    footer {
      background-color: #fbe9e7;
      color:black;
      text-align: center;
      padding: 1rem 2rem;
      margin-top: 3rem;
    }
  </style>
</head>
<body>

<header>
  <div class="logo"><span class="brand-name">NexBuy</span></div>
  <nav>
    <a href="hp.php">Home</a>
    <a href="cart.php">Cart</a>
    <a href="shop.php">Shop</a>
    <a href="profile.php">Profile</a>
  </nav>
</header>

<div class="container">
  <?php if ($orderPlaced): ?>
    <div class="success">
      <h2>Thank you for your purchase!</h2>
      <p>Your order has been placed successfully.</p>
    </div>
  <?php elseif (empty($_SESSION['cart'])): ?>
    <h2>Your cart is empty.</h2>
    <p style="text-align:center;">Please <a href="shop.php">go back to shop</a> to add products.</p>
  <?php else: ?>
    <h2>Order Summary</h2>
    <table>
      <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
      </tr>
      <?php
      $total = 0;
      foreach ($_SESSION['cart'] as $item):
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
      ?>
        <tr>
          <td><?= htmlspecialchars($item['name']) ?></td>
          <td><?= $item['quantity'] ?></td>
          <td>₹<?= number_format($item['price'], 2) ?></td>
          <td>₹<?= number_format($subtotal, 2) ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
        <td><strong>₹<?= number_format($total, 2) ?></strong></td>
      </tr>
    </table>

    <form method="post">
      <h3>Shipping Details</h3>

      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="10-digit number" required>

      <label for="address">Shipping Address</label>
      <textarea id="address" name="address" rows="3" required></textarea>

      <label for="payment">Payment Method</label>
      <select id="payment" name="payment" required onchange="showPaymentFields()">
        <option value="">-- Select --</option>
        <option value="cod">Cash on Delivery</option>
        <option value="upi">UPI</option>
        <option value="card">Credit/Debit Card</option>
      </select>

      <div id="payment-details"></div>

      <button type="submit" name="place_order" class="place-order-btn">Place Order</button>
    </form>
  <?php endif; ?>
</div>

<footer>
  <p>&copy; 2025 NexBuy. All rights reserved.</p>
</footer>

<script>
  function showPaymentFields() {
    const method = document.getElementById('payment').value;
    const detailsDiv = document.getElementById('payment-details');

    detailsDiv.innerHTML = '';

    if (method === 'upi') {
      detailsDiv.innerHTML = `
        <label for="upi_id">UPI ID</label>
        <input type="text" id="upi_id" name="upi_id" placeholder="example@upi" required>
      `;
    } else if (method === 'card') {
      detailsDiv.innerHTML = `
        <label for="card_number">Card Number</label>
        <input type="text" id="card_number" name="card_number" maxlength="16" required>

        <label for="expiry">Expiry Date</label>
        <input type="month" id="expiry" name="expiry" required>

        <label for="cvv">CVV</label>
        <input type="password" id="cvv" name="cvv" maxlength="4" required>
      `;
    }
  }
</script>

</body>
</html>

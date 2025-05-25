<?php
session_start();

// Remove entire item from cart
if (isset($_GET['remove'])) {
  $removeName = $_GET['remove'];
  foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['name'] === $removeName) {
      unset($_SESSION['cart'][$index]);
      $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
      break;
    }
  }
  header("Location: cart.php");
  exit;
}

// Decrease quantity by 1
if (isset($_GET['decrease'])) {
  $decreaseName = $_GET['decrease'];
  foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['name'] === $decreaseName) {
      if ($_SESSION['cart'][$index]['quantity'] > 1) {
        $_SESSION['cart'][$index]['quantity']--;
      } else {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
      }
      break;
    }
  }
  header("Location: cart.php");
  exit;
}

// Update quantity via form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_name'], $_POST['update_quantity'])) {
  $nameToUpdate = $_POST['update_name'];
  $newQty = max(1, intval($_POST['update_quantity']));

  foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $nameToUpdate) {
      $item['quantity'] = $newQty;
      break;
    }
  }
  header("Location: cart.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #ffe0b2;
      color: #333;
      line-height: 1.6;
      padding: 2rem;
    }

    h2 {
      text-align: center;
      margin-bottom: 2rem;
      color: #222;
    }

    table {
      width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    th, td {
      padding: 1rem;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #222;
      color: white;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .remove-btn,
    .decrease-btn {
      background-color: orange;
      color: black;
      border: none;
      padding: 0.5rem 1rem;
      font-size: 0.9rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin: 0.2rem;
    }

    .remove-btn:hover,
    .decrease-btn:hover {
      background-color: darkorange;
    }

    .buy-btn {
      display: block;
      margin: 2rem auto 1rem;
      background-color: orange;
      color: black;
      border: none;
      padding: 0.8rem 2rem;
      font-size: 1.1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-align: center;
      text-decoration: none;
    }

    .buy-btn:hover {
      background-color: darkorange;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 1.5rem;
      font-size: 1.1rem;
      color: black;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    input[type="number"] {
      padding: 5px;
      width: 60px;
      font-size: 1rem;
      border-radius: 4px;
      border: 1px solid #ccc;
      text-align: center;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>

<h2>Your Shopping Cart</h2>

<?php if (!empty($_SESSION['cart'])): ?>
  <table>
    <tr>
      <th>Product</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Subtotal</th>
      <th>Action</th>
    </tr>
    <?php
    $total = 0;
    foreach ($_SESSION['cart'] as $item):
      $subtotal = $item['price'] * $item['quantity'];
      $total += $subtotal;
    ?>
    <tr>
      <td><?= htmlspecialchars($item['name']) ?></td>
      <td>₹<?= number_format($item['price'], 2) ?></td>
      <td>
        <form method="post" action="cart.php" style="display:inline;">
          <input type="hidden" name="update_name" value="<?= htmlspecialchars($item['name']) ?>">
          <input type="number" name="update_quantity" value="<?= $item['quantity'] ?>" min="1">
          <button type="submit" class="decrease-btn">Update</button>
        </form>
      </td>
      <td>₹<?= number_format($subtotal, 2) ?></td>
      <td>
        <a href="cart.php?decrease=<?= urlencode($item['name']) ?>" onclick="return confirm('Decrease quantity by 1?')">
          <button class="decrease-btn">-</button>
        </a>
        <a href="cart.php?remove=<?= urlencode($item['name']) ?>" onclick="return confirm('Remove this item?')">
          <button class="remove-btn">Remove</button>
        </a>
      </td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
      <td colspan="2"><strong>₹<?= number_format($total, 2) ?></strong></td>
    </tr>
  </table>

  <a href="buynow.php" class="buy-btn">Buy Now</a>

<?php else: ?>
  <p style="text-align:center;">Your cart is empty.</p>
<?php endif; ?>

<a class="back-link" href="shop.php">← Back to Shop</a>

</body>
</html>

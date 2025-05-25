<?php
session_start();

$products = [
  ['name' => 'Headphone', 'price' => 1579.00, 'image' => 'images/headphones.jpeg', 'features' => ['Wireless', 'Noise Cancelling', '20h Battery Life']],
  ['name' => 'Television', 'price' => 35799.00, 'image' => 'images/tv.jpeg', 'features' => ['50 inch 4K Display', 'Smart TV', 'HDR Support']],
  ['name' => 'Iphone 13', 'price' => 44999.00, 'image' => 'images/iphone 13.jpeg', 'features' => ['128GB Storage', 'Dual Camera', 'A15 Bionic Chip']],
  ['name' => 'Iphone 15', 'price' => 72999.00, 'image' => 'images/iphone 15.jpeg', 'features' => ['Dynamic Island', '48MP Camera', 'USB-C Charging']],
  ['name' => 'Monitor', 'price' => 15799.00, 'image' => 'images/monitor.jpeg', 'features' => ['27-inch IPS', '144Hz Refresh Rate', 'Adjustable Stand']],
  ['name' => 'PlayStation 5', 'price' => 49999.00, 'image' => 'images/ps5.jpeg', 'features' => ['8K Support', 'Ultra-fast SSD', 'DualSense Controller']],
  ['name' => 'Boat Earbuds', 'price' => 1299.00, 'image' => 'images/earbudes.jpeg', 'features' => ['Bluetooth 5.0', 'Water Resistant', 'Up to 5h Playtime']],
  ['name' => 'Samsung S24', 'price' => 50999.00, 'image' => 'images/s24.jpeg', 'features' => ['200MP Camera', 'AMOLED 2X Display', 'Snapdragon Gen 3']]
];

// Handle AJAX Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_add'])) {
  $productName = $_POST['ajax_add'];
  foreach ($products as $product) {
    if ($product['name'] === $productName) {
      $found = false;
      if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

      foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $productName) {
          $item['quantity']++;
          $found = true;
          break;
        }
      }

      if (!$found) {
        $_SESSION['cart'][] = ['name' => $product['name'], 'price' => $product['price'], 'quantity' => 1];
      }

      echo json_encode(['success' => true, 'total' => array_sum(array_column($_SESSION['cart'], 'quantity'))]);
      exit;
    }
  }

  echo json_encode(['success' => false]);
  exit;
}

// Find product
$productName = isset($_GET['name']) ? $_GET['name'] : '';
$selectedProduct = null;

foreach ($products as $product) {
  if ($product['name'] === $productName) {
    $selectedProduct = $product;
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $selectedProduct ? $selectedProduct['name'] : 'Product Not Found' ?> - NexBuy</title>
  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffe0b2; margin: 0; padding: 0; color: #333; }
    header { background-color: #222; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    header .logo { font-size: 1.5rem; font-weight: bold; }
    header nav a { color: #fff; text-decoration: none; margin-left: 1.5rem; }
    header nav a:hover { color: white; }
    .brand-name { color: orange; }

    .container {
      max-width: 1000px;
      margin: 2rem auto;
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      display: flex;
      gap: 2rem;
    }

    .product-image img {
      width: 300px;
      height: auto;
      border-radius: 10px;
    }

    .product-details h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .product-details p.price {
      font-size: 1.5rem;
      color: #e69500;
      margin-bottom: 1rem;
    }

    .product-details ul {
      list-style-type: disc;
      padding-left: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .add-to-cart-btn {
      background-color: orange;
      color: black;
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .add-to-cart-btn:hover {
      background-color: #e69500;
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
    <a href="shop.php">Shop</a>
    <a href="cart.php" id="cart-link">Cart (<span id="cart-count"><?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?></span>)</a>
    <a href="au.php">About Us</a>
    <a href="contact.php">Contact</a>
    <a href="profile.php">Profile</a>
  </nav>
</header>

<?php if ($selectedProduct): ?>
  <div class="container">
    <div class="product-image">
      <img src="<?= $selectedProduct['image'] ?>" alt="<?= htmlspecialchars($selectedProduct['name']) ?>">
    </div>
    <div class="product-details">
      <h2><?= htmlspecialchars($selectedProduct['name']) ?></h2>
      <p class="price">₹<?= number_format($selectedProduct['price'], 2) ?></p>
      <ul>
        <?php foreach ($selectedProduct['features'] as $feature): ?>
          <li><?= htmlspecialchars($feature) ?></li>
        <?php endforeach; ?>
      </ul>
      <button class="add-to-cart-btn" data-product="<?= htmlspecialchars($selectedProduct['name']) ?>">Add to Cart</button>
    </div>
  </div>
<?php else: ?>
  <div style="text-align: center; padding: 4rem;">
    <h2>Product not found.</h2>
    <p><a href="shop.php">Back to Shop</a></p>
  </div>
<?php endif; ?>

<footer>
  <p>&copy; 2025 NexBuy. All rights reserved.</p>
</footer>

<script>
document.querySelectorAll('.add-to-cart-btn').forEach(button => {
  button.addEventListener('click', function () {
    const product = this.getAttribute('data-product');
    fetch('product.php?name=' + encodeURIComponent(product), {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: new URLSearchParams({ ajax_add: product })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById('cart-count').textContent = data.total;
        alert(`${product} added to cart!`);
      } else {
        alert('Failed to add product.');
      }
    })
    .catch(() => alert('Error occurred.'));
  });
});
</script>

</body>
</html>

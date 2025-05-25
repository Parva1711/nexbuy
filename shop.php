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

// Search
$searchTerm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$filteredProducts = array_filter($products, function ($product) use ($searchTerm) {
  return strpos(strtolower($product['name']), $searchTerm) !== false;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop - NexBuy</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffe0b2; color: #333; line-height: 1.6; }
    header { background-color: #222; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    header .logo { font-size: 1.5rem; font-weight: bold; }
    header nav a { color: #fff; text-decoration: none; margin-left: 1.5rem; transition: color 0.3s ease; }
    header nav a:hover { color: white; }
    .brand-name { color: orange; }

    .products { padding: 3rem 2rem; text-align: center; }
    .products h2 { margin-bottom: 2rem; font-size: 2rem; }

    .search-form { margin-bottom: 2rem; }
    .search-form input[type="text"] {
      padding: 0.5rem 1rem; font-size: 1rem; width: 250px;
      border: 1px solid #ccc; border-radius: 5px; margin-right: 0.5rem;
    }
    .search-form button {
      padding: 0.5rem 1rem; background-color: orange;
      border: none; border-radius: 5px; font-size: 1rem; cursor: pointer;
    }
    .search-form button:hover { background-color: #e69500; }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
      justify-items: center;
    }

    .product-card {
      width: 240px;
      height: 420px;
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 1rem;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      overflow: hidden;
      text-align: center;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .product-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 0.5rem;
    }

    .product-card h3 {
      font-size: 1.1rem;
      margin: 0.3rem 0;
      height: 2.4em;
      overflow: hidden;
    }

    .product-card a {
      text-decoration: none;
      color: black;
    }

    .product-card a:hover h3 {
      color: orange;
    }

    .feature-list {
      text-align: left;
      font-size: 0.85rem;
      color: #555;
      height: 60px;
      overflow: hidden;
      margin-bottom: 0.5rem;
      padding-left: 1rem;
    }

    .feature-list li {
      list-style-type: disc;
      margin-bottom: 0.3rem;
    }

    footer {
      background-color: #fbe9e7;
      color:black;
      text-align: center;
      padding: 1rem 2rem;
      margin-top: 3rem;
    }

    .add-to-cart-btn {
      background-color: orange;
      color: black;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .add-to-cart-btn:hover {
      background-color: #e69500;
    }
  </style>
</head>
<body>

<header>
  <div class="logo"><span class="brand-name">NexBuy</span></div>
  <nav>
    <a href="hp.php">Home</a>
    <a href="cart.php" id="cart-link">Cart (<span id="cart-count"><?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?></span>)</a>
    <a href="au.php">About Us</a>
    <a href="contact.php">Contact</a>
    <a href="profile.php">Profile</a>
  </nav>
</header>

<section class="products">
  <h2>All Products</h2>

  <form method="get" action="shop.php" class="search-form">
    <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($searchTerm) ?>">
    <button type="submit">Search</button>
  </form>

  <div class="product-grid">
    <?php if (count($filteredProducts) > 0): ?>
      <?php foreach ($filteredProducts as $product): ?>
        <div class="product-card">
          <a href="product.php?name=<?= urlencode($product['name']) ?>">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
          </a>
          <a href="product.php?name=<?= urlencode($product['name']) ?>">
            <h3><?= $product['name'] ?></h3>
          </a>
          <p>₹<?= number_format($product['price'], 2) ?></p>
          <ul class="feature-list">
            <?php foreach ($product['features'] as $feature): ?>
              <li><?= htmlspecialchars($feature) ?></li>
            <?php endforeach; ?>
          </ul>
          <button class="add-to-cart-btn" data-product="<?= htmlspecialchars($product['name']) ?>">Add to Cart</button>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No products found.</p>
    <?php endif; ?>
  </div>
</section>

<footer>
  <p>&copy; 2025 NexBuy. All rights reserved.</p>
</footer>

<script>
document.querySelectorAll('.add-to-cart-btn').forEach(button => {
  button.addEventListener('click', function () {
    const product = this.getAttribute('data-product');
    fetch('shop.php', {
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

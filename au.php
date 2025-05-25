<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - NexBuy</title>
  <style>
    /* ===== CSS Styles ===== */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffe0b2;
      color: #333;
    }

    header {
      background-color: #222;
      color: #fff;
      padding: 1em;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 1.5em;
      font-weight: bold;
    }

    nav a {
      color:white;
      margin: 0 10px;
      text-decoration: none;
    }

    nav a:hover,
    nav a.active {
      color:white;
    }

    main.about-container {
      padding: 2em;
      max-width: 900px;
      margin: auto;
      background: #fff;
      border-radius: 8px;
      margin-top: 2em;
    }

    .about-header h1 {
      font-size: 2.5em;
      margin-bottom: 0.2em;
    }

    .about-content h2 {
      margin-top: 1.5em;
      color: #444;
    }

    .about-content ul {
      list-style-type: disc;
      margin-left: 20px;
    }

    button {
      margin-top: 1em;
      padding: 0.5em 1em;
      background-color:orange;
      color:black;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color:darkorange;
    }

    footer {
      text-align: center;
      padding: 1em;
      background: #fbe9e7;
      color:black;
      margin-top: 3em;
    }
     .brand-name {
      color: orange;
    }
  </style>
</head>
<body>

  <!-- ===== Header ===== -->
  <header>
  <div class="logo"><span class="brand-name">NexBuy</span></div>
    <nav>
      <a href="hp.php">Home</a>
      <a href="shop.php">Shop</a>
      <a href="cart.php">Cart<a>
      <a href="contact.php">Contact</a>
      <a href="profile.php">Profile</a>
    </nav>
  </header>

  <!-- ===== Main Content ===== -->
  <main class="about-container">
    <section class="about-header">
      <h1>About Us</h1>
      <p>Your trusted partner in quality online shopping.</p>
    </section>

    <section class="about-content">
      <h2>Our Story</h2>
      <p>
        Founded in 2020, we started with a simple mission: deliver the best products at affordable prices.
        Our journey began in a small warehouse and has grown into a nationwide eCommerce platform.
      </p>

      <h2>Why Shop With Us?</h2>
      <ul>
        <li>High-quality, curated products</li>
        <li>Fast and reliable delivery</li>
        <li>Top-notch customer support</li>
      </ul>

      <button onclick="toggleMore()">Read More</button>
      <div id="more-text" style="display:none; margin-top: 1em;">
        <p>
          We believe in sustainability, transparency, and customer satisfaction. Every product is handpicked, tested, and reviewed before it hits the shelves.
        </p>
      </div>
    </section>
  </main>

  <!-- ===== Footer ===== -->
  <footer>
    <p>&copy; <span id="year"></span> NexBuy. All rights reserved.</p>
  </footer>

  <!-- ===== JavaScript ===== -->
  <script>
    // Toggle "Read More" content
    function toggleMore() {
      const moreText = document.getElementById("more-text");
      moreText.style.display = (moreText.style.display === "none") ? "block" : "none";
    }

    // Set current year in footer
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>

</body>
</html>

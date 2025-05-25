<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NexBuy | Online Shopping</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #fffde7, #fff3e0);
      color: #333;
    }

    header {
      background-color:black;
      color:orange;
      padding: 20px 40px;
      text-align: center;
      font-size: 28px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .hero {
      text-align: center;
      padding: 60px 20px;
      max-width: 800px;
      margin: auto;
    }

    .hero h1 {
      font-size: 40px;
      color:black;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 18px;
      color: #555;
      line-height: 1.6;
      margin-bottom: 40px;
    }

    .buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 60px;
      flex-wrap: wrap;
    }

    .button {
      text-decoration: none;
      padding: 14px 30px;
      font-weight: bold;
      border-radius: 8px;
      font-size: 16px;
      transition: 0.3s;
      box-shadow: 0 6px 15px rgba(255, 111, 0, 0.2);
    }

    .login-btn {
      background-color:orange;
      color:black;
    }

    .login-btn:hover {
      background-color:darkorange;
    }

    .signup-btn {
      background-color: white;
      color:orange;
      border: 2px solid orange;
    }

    .signup-btn:hover {
      background-color:orange;
      color: white;
    }

    .features {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      padding: 40px 20px;
      background-color: #fff8e1;
    }

    .feature {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      max-width: 250px;
      text-align: center;
      transition: 0.3s;
    }

    .feature:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(255, 111, 0, 0.2);
    }

    .feature h3 {
      color:orange;
      margin-bottom: 10px;
    }

    .feature p {
      font-size: 14px;
      color: #666;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: #fbe9e7;
      font-size: 14px;
      color:black;
    }
    .brand-name {
      color: orange;
    }
  </style>
</head>
<body>

  <header>
    NexBuy
  </header>

  <section class="hero">
   <h1>Welcome to <span class="brand-name">NexBuy</span></h1>
    <p>
      Your trusted destination for online shopping! Discover trending products, hot deals,
      and unbeatable prices. We bring quality, convenience, and style right to your fingertips.
    </p>

    <div class="buttons">
      <a href="validate1.php" class="button login-btn">Login</a>
      <a href="signup.php" class="button signup-btn">Sign Up</a>
    </div>
  </section>

  <section class="features">
    <div class="feature">
      <h3>🛍️ Best Deals</h3>
      <p>Enjoy discounts and special offers every day.</p>
    </div>
    <div class="feature">
      <h3>🔒 Secure Payment</h3>
      <p>Shop confidently with safe and encrypted transactions.</p>
    </div>
    <div class="feature">
      <h3>🚚 Fast Delivery</h3>
      <p>Quick shipping across the country to your doorstep.</p>
    </div>
  </section>

  <footer>
    &copy; 2025 NexBuy. All rights reserved.
  </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NexBuy - Contact Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background:#ffe0b2;
      color: #333;
    }

    header {
      background: #222;
      color: orange;
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

    .profile-link {
      display: inline-block;
      vertical-align: middle;
    }

    .profile-pic {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      border: 2px solid orange;
      vertical-align: middle;
    }

    .contact-section {
      max-width: 600px;
      margin: 3em auto;
      background: #fff;
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 2px 6px orange;
    }

    .contact-section h2 {
      text-align: center;
      margin-bottom: 1em;
    }

    .contact-form label {
      display: block;
      margin: 0.5em 0 0.2em;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 0.7em;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 1em;
    }

    .contact-form button {
      background-color: orange;
      color: black;
      border: none;
      padding: 0.7em 1.5em;
      border-radius: 5px;
      cursor: pointer;
    }

    .contact-form button:hover {
      background-color: #ff9500;
    }

    footer {
      text-align: center;
      padding: 1em;
      background: #fbe9e7;
      color:black;
      margin-top: 4em;
    }

    .brand-name {
      color: orange;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="logo">NexBuy</div>
    <nav>
      <a href="hp.php">Home</a>
      <a href="shop.php">Shop</a>
       <a href="cart.php">Cart</a>
      <a href="au.php">About</a>
      <a href="profile.php" class="profile-link">Profile</a>
    </nav>
  </header>

  <!-- Contact Section -->
  <section class="contact-section">
    <h2>Contact Us</h2>
    <form class="contact-form" onsubmit="return handleContactForm()">
      <label for="name">Your Name</label>
      <input type="text" id="name" required />

      <label for="email">Your Email</label>
      <input type="email" id="email" required />

      <label for="message">Your Message</label>
      <textarea id="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; <span id="year"></span> NexBuy. All rights reserved.</p>
  </footer>

  <!-- JavaScript -->
  <script>
    function handleContactForm() {
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const message = document.getElementById("message").value.trim();

      if (name && email && message) {
        alert("Thank you for contacting us, " + name + "!");
        // You can add form submission logic here (AJAX/PHP)
      } else {
        alert("Please fill in all fields.");
      }

      return false; // Prevent actual form submission
    }

    document.getElementById("year").textContent = new Date().getFullYear();
  </script>

</body>
</html>

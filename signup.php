<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  </head>
  <style>
  body {
    font-family: 'Arial';
    background: linear-gradient(to right, #fff8e1, #ffe0b2);
    padding: 20px;
  }

  form {
    background-color:white;
    padding: 25px;
    border-radius: 10px;
    max-width: 400px;
    margin: auto;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }

  input[type="radio"] {
    margin-right: 5px;
    margin-left: 10px;
  }

  .error {
    color: #ff0000;
    font-size: 0.9em;
    margin-left: 5px;
  }

  input[type="submit"] {
    background-color:orange;
    color:black;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
  }

  input[type="submit"]:hover {
    background-color:darkorange;
  }

  .signup-link {
    display: block;
    text-align: center;
    margin-top: 20px;
  }

  .signup-link a {
    display: inline-block;
    padding: 10px 20px;
    color: black;
    text-decoration: none;
    border-radius: 6px;
    font-size: 16px;
    background-color: #ddd;
  }

  .signup-link a:hover {
    background-color: #ccc;
  }
</style>

<body>

  <form id="Sign_up" action="signup1.php"onsubmit="return signup()" method="POST">
    <h2>Create Account</h2>
    Username:
    <input type="text" name="username" id="username" autocomplete="username" >

    Password:
    <input type="password" name="password" id="passwordS" autocomplete="new-password">

    Email:
    <input type="email" name="email" id="email" autocomplete="email">

    <input type="submit" value="Sign Up">
    <p>Alreda have an account? <a href="validate1.php">Login</a></p>
  </form>

  <script>
    function signup() {
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("passwordS").value.trim();
      const email = document.getElementById("email").value.trim();

      let error = "";

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!email) {
        error += "Email is required.\n";
      } else if (!emailRegex.test(email)) {
        error += "Invalid email format.\n";
      }

      if (!username) {
        error += "Username is required.\n";
      }

      if (!password) {
        error += "Password is required.\n";
      } else if (password.length < 8) {
        error += "Password must be at least 8 characters long.\n";
      }

      if (error) {
        alert(error);
        return false; // Prevent submission
      }

      alert("Signup successful! Redirecting to Home...");
      window.location.href = "hp.php"; // Redirect to homepage
      return false; // Prevent default form submission
    }
  </script>

</body>
</html>

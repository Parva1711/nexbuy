<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters.";
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "web_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo "Email already exists.";
        $check->close();
        $conn->close();
        exit();
    }
    $check->close();


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
    
        session_start();
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

    
        $to = $email;
        $subject = "Welcome to NexBuy!";
        $message = "Hello $username,\n\nThank you for signing up at NexBuy!\nWe're excited to have you on board.\n\nHappy shopping!\nNexBuy Team";
        $headers = "From: no-reply@nexbuy.com";
        @mail($to, $subject, $message, $headers);

        $stmt->close();
        $conn->close();

    
        header("Location: profile.php");
        exit();
    } else {
        echo "Signup failed: " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>

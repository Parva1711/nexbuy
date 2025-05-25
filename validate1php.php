<?php
session_start();

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$host = "localhost";
$username = "root";
$password = "PHR@17parva";
$dbname = "nexxbuy";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = isset($_POST["username"]) ? test_input($_POST["username"]) : "";
$password = isset($_POST["password"]) ? test_input($_POST["password"]) : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT * FROM signup WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();


            if ($password === $row["password"]) {
            
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];

            
                $to = $row['email'];
                $subject = "Login Successful - Welcome Back to NexBuy!";
                $message = "Hello " . $row['username'] . ",\n\nYou have successfully logged in to NexBuy.\n\nWelcome back!\n\nRegards,\nNexBuy Team";
                $headers = "From: noreply@nexbuy.com";

                @mail($to, $subject, $message, $headers);

                header("Location: hp.php");
                exit();
            } else {
                echo "<script>
                        alert('Invalid password.');
                        window.location.href = 'validate1.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Invalid username.');
                    window.location.href = 'validate1.php';
                  </script>";
        }

        $stmt->close();
    } else {
        echo "SQL Error: " . $conn->error;
    }
}
$conn->close();
?>

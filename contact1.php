<?php
// Database connection (PostgreSQL/Supabase)
$host = "YOUR_SUPABASE_HOST";         // e.g., db.abcxyz.supabase.co
$db   = "postgres";                   // default DB in Supabase
$user = "YOUR_SUPABASE_USER";        // usually your email or service role
$pass = "YOUR_SUPABASE_PASSWORD";    // service role key or generated password
$port = "5432";

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass sslmode=require");

if (!$conn) {
  die("Connection failed: " . pg_last_error());
}

// Sanitize POST data
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

// Validate inputs
if (empty($name) || empty($email) || empty($message)) {
  die("All fields are required.");
}

// Insert into contact_messages table
$query = "INSERT INTO contact_messages (name, email, message) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, array($name, $email, $message));

if ($result) {
  echo "Message sent successfully!";
} else {
  echo "Error: " . pg_last_error($conn);
}

pg_close($conn);
?>

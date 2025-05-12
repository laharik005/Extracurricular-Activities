<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_db";

// Create connection
$servername = "localhost:4306";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // securely hash password

// Check if username already exists
$check_stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
$check_stmt->bind_param("s", $user);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
  echo "Username already exists. <a href='signup.html'>Try another one</a>";
} else {
  // Insert new user
  $stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $user, $pass);

  if ($stmt->execute()) {
    echo "Sign up successful! <a href='index.html'>Login here</a>";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$check_stmt->close();
$conn->close();
?>

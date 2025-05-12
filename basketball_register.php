<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_db";

// Connect to DB
$servername = "localhost:4306";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form values
$name = $_POST['name'];
$email = $_POST['email'];
$roll = $_POST['roll'];

// Use a prepared statement
$stmt = $conn->prepare("INSERT INTO basketball_registrations (name, email, roll) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $roll);

if ($stmt->execute()) {
    // Redirect to success page after successful registration
    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

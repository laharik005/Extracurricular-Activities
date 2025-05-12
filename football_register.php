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

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$roll = $_POST['roll'];

// Insert into database
$sql = "INSERT INTO football_registrations (name, email, roll)VALUES ('$name', '$email', '$roll')";
$stmt = $conn->prepare("INSERT INTO football_registrations (name, email, roll) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $roll);
if ($stmt->execute()) {
    // Registration successful
    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}




$conn->close();
?>

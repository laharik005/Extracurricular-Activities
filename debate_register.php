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
$topic = $_POST['topic'];
$sub_topic = $_POST['sub_topic'];

// Prepare statement
$stmt = $conn->prepare("INSERT INTO debate_registrations (name, email, topic, sub_topic) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $topic, $sub_topic);

// Execute
if ($stmt->execute()) {
  header("Location: success.html");
  exit();
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

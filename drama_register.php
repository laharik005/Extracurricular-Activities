<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "project_db",4306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$drama_title = $_POST['drama_title'];
$slot = $_POST['slot'];

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO drama_registrations (full_name, email, drama_title, slot) VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $full_name, $email, $drama_title, $slot);

if ($stmt->execute()) {
  header("Location: success.html");
  exit();
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

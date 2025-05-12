<?php

$conn = new mysqli("localhost", "root", "", "project_db",4306);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$roll = $_POST['roll'];

$sql = "INSERT INTO photography_registrations  (name, email, roll) VALUES ('$name', '$email', '$roll')";
$stmt = $conn->prepare("INSERT INTO photography_registrations (name, email, roll) VALUES (?, ?, ?)");
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

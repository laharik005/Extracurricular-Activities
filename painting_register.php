<?php
// Add port number 4306
$conn = new mysqli("localhost", "root", "", "project_db",4306 );

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$class_type = $_POST['class_type'];
$preferred_slot = $_POST['preferred_slot'];

$stmt = $conn->prepare("INSERT INTO painting_registrations (full_name, email, class_type, preferred_slot) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $email, $class_type, $preferred_slot);

if ($stmt->execute()) {
    // Registration successful
    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

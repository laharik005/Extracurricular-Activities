<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_db";

// Connect to DB
$servername = "localhost:4306";
$conn = new mysqli($servername, $username, $password, $dbname,);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$name = $_POST['name'];
$email = $_POST['email'];
$interest = $_POST['interest'];

// Prepare the SQL statement properly
$stmt = $conn->prepare("INSERT INTO sciencehub_registrations (name, email, interest) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $interest);

// Execute the prepared statement
if ($stmt->execute()) {
    header("Location: success.html"); // Redirect to success page
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

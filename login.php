<?php
session_start();

$conn = new mysqli("localhost", "root", "", "project_db",4306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get submitted values
$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify password (use if password is hashed)
    if (password_verify($password, $row['password'])) {
        // Optional: set session variables
        $_SESSION['username'] = $username;

        // Redirect to activities.html
        header("Location: activities.html");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Invalid username.";
}

$stmt->close();
$conn->close();
?>

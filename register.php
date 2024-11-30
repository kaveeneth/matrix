<!-- This file is part of the Matrix Login Project.
Originally developed by Kaveesha Nethmal © 2024.
Unauthorized modification, distribution, or reproduction of this file is strictly prohibited.
For inquiries, contact the original developer. -->


<?php
// Database connection
$host = 'localhost';
$db = 'matrix_login';
$user = 'root';
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hashing

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

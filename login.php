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

// Start session
session_start();

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user information from database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        // Store user info in session variables
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;

        // Redirect to another site/page
        header("Location: https://777lncxc-5501.asse.devtunnels.ms/"); // Replace with your actual site or file
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

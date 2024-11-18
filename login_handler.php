<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantamail";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Update the last_login timestamp
            $update_login_sql = "UPDATE users SET last_login = NOW() WHERE email = '$email'";
            $conn->query($update_login_sql);

            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];

            // Send success response
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            // Incorrect password
            echo json_encode(['success' => false, 'message' => 'Wrong password!']);
        }
    } else {
        // Email not found
        echo json_encode(['success' => false, 'message' => 'Email not Existed!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete login details!']);
}

$conn->close();

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

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Update last_login timestamp
            $update_login_sql = "UPDATE users SET last_login = NOW() WHERE email = '$email'";
            $conn->query($update_login_sql);

            // Set session or any login logic here
            $_SESSION['user_id'] = $row['user_id'];
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password!']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete login details!']);
}

$conn->close();
?>

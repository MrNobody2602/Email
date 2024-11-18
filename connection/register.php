<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantamail";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed!']));
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered!']);
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Generate user_id based on the format QM_ACCXX
        $user_id_query = "SELECT MAX(user_id) AS max_user_id FROM users";
        $result = $conn->query($user_id_query);
        $row = $result->fetch_assoc();
        $new_user_id = $row['max_user_id'] ? intval(substr($row['max_user_id'], -2)) + 1 : 1;
        $formatted_user_id = sprintf("QM_ACC%02d", $new_user_id);

        // Insert new user into the database
        $insert_sql = "INSERT INTO users (user_id, username, email, password) VALUES ('$formatted_user_id', '$username', '$email', '$hashedPassword')";
        if ($conn->query($insert_sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Registration failed!']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete form data!']);
}

$conn->close();
?>

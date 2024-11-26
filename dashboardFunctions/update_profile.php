<?php
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: ../login.php");
    exit();
}

include '../connection/conn.php';

$response = [];

// Fetch user profile data
$user_profile = [];
if ($user_id) {
    $stmt = $conn->prepare("SELECT * FROM update_profile WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_profile = $result->fetch_assoc();
    $stmt->close();
}

// Handle Password Change
if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Verify current password
    $password_check_stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
    $password_check_stmt->bind_param("s", $user_id);
    $password_check_stmt->execute();
    $result = $password_check_stmt->get_result();
    $user_data = $result->fetch_assoc();

    if ($user_data && password_verify($current_password, $user_data['password'])) {
        // Update password
        $update_password_stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $update_password_stmt->bind_param("ss", $new_password, $user_id);

        if ($update_password_stmt->execute()) {
            $response = ['type' => 'success', 'message' => 'Password updated successfully!'];
        } else {
            $response = ['type' => 'error', 'message' => 'Failed to update password.'];
        }

        $update_password_stmt->close();
    } else {
        $response = ['type' => 'error', 'message' => 'Current password is incorrect.'];
    }

    $password_check_stmt->close();
}

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $phone_number = $_POST['phone_number'];

    $image = $user_profile['image'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "../uploads/images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    if ($user_profile) {
        $stmt = $conn->prepare("UPDATE update_profile SET username = ?, firstname = ?, lastname = ?, age = ?, address = ?, birthday = ?, phone_number = ?, image = ? WHERE user_id = ?");
        $stmt->bind_param("sssisssss", $username, $firstname, $lastname, $age, $address, $birthday, $phone_number, $image, $user_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO update_profile (user_id, username, firstname, lastname, age, address, birthday, phone_number, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssissss", $user_id, $username, $firstname, $lastname, $age, $address, $birthday, $phone_number, $image);
    }

    if ($stmt->execute()) {
        // Update `users` table
        $update_user_stmt = $conn->prepare("UPDATE users SET username = ? WHERE user_id = ?");
        $update_user_stmt->bind_param("ss", $username, $user_id);
        $update_user_stmt->execute();

        $_SESSION['username'] = $username;

        $response = ['type' => 'success', 'message' => 'Profile updated successfully!'];
    } else {
        $response = ['type' => 'error', 'message' => 'Failed to update profile.'];
    }

    $stmt->close();
}

echo json_encode($response);
exit();
?>

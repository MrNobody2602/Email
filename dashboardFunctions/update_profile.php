<?php
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: ../login.php");
    exit();
}

include '../connection/conn.php';

$user_profile = [];
if ($user_id) {
    $stmt = $conn->prepare("SELECT * FROM update_profile WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_profile = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id) {
    $username = $_POST['username'];
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
        $stmt = $conn->prepare("UPDATE update_profile SET username = ?, age = ?, address = ?, birthday = ?, phone_number = ?, image = ? WHERE user_id = ?");
        $stmt->bind_param("sisssss", $username, $age, $address, $birthday, $phone_number, $image, $user_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO update_profile (user_id, username, age, address, birthday, phone_number, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissss", $user_id, $username, $age, $address, $birthday, $phone_number, $image);
    }

    if ($stmt->execute()) {
        // Update the `users` table with the new username
        $update_user_stmt = $conn->prepare("UPDATE users SET username = ? WHERE user_id = ?");
        $update_user_stmt->bind_param("ss", $username, $user_id);
        $update_user_stmt->execute();

        // Update the session data
        $_SESSION['username'] = $username;

        echo "<script>alert('Profile updated successfully!'); window.location.href = '../dashboard/?page=inbox'</script>";
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
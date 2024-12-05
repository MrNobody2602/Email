<?php
session_start();
include '../connection/conn.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_id = $_POST['id'];
    $new_status = $_POST['status'];
    $valid_statuses = ['inbox', 'trash', 'archive'];

    if (!in_array($new_status, $valid_statuses)) {
        echo json_encode(["status" => "error", "message" => "Invalid status."]);
        exit();
    }

    $stmt = $conn->prepare("UPDATE emails SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $email_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Email moved to $new_status.", "new_status" => $new_status]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
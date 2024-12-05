<?php
include '../connection/conn.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM emails WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Email deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting email: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No email ID provided."]);
}

$conn->close();
?>
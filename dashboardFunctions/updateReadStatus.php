<?php
include '../connection/conn.php';

$data = json_decode(file_get_contents('php://input'), true);
$email_id = $data['email_id'];

$response = ['success' => false];

if (!empty($email_id)) {
    $updateQuery = "UPDATE emails SET read_status = 1 WHERE id = ?";
    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("i", $email_id);
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = $stmt->error;
        }
        $stmt->close();
    } else {
        $response['error'] = $conn->error;
    }
}

$conn->close();
echo json_encode($response);
?>
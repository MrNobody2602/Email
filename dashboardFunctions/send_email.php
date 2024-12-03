<?php
date_default_timezone_set('Asia/Manila');
require '../connection/conn.php';
require __DIR__ . '/../vendor/autoload.php';

use WebSocket\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_email = $_POST['sender'];
    $recipient_email = $_POST['recipient'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql_check_recipient = "SELECT * FROM users WHERE email = ?";
    $stmt_check_recipient = $conn->prepare($sql_check_recipient);
    $stmt_check_recipient->bind_param("s", $recipient_email);
    $stmt_check_recipient->execute();
    $result = $stmt_check_recipient->get_result();

    if ($result->num_rows == 0) {
        echo "Recipient email not found!";
        exit;
    }

    $message_id = 'QM_MSG' . str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);

    $image_uploads = [];
    $document_uploads = [];
    $video_upload = null;

    // Handle image uploads
    $image_uploads = [];
    if (isset($_FILES['image']) && is_array($_FILES['image']['name'])) {
        foreach ($_FILES['image']['name'] as $key => $name) {
            if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['image']['tmp_name'][$key];
                $uploadDir = '../uploads/images/';
                $fileName = basename($name);
                $uploadFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $uploadFilePath)) {
                    $image_uploads[] = $uploadFilePath;
                } else {
                    echo "Failed to upload image: " . $name . "<br>";
                }
            }
        }
    }

    // Handle video uploads
    $video_upload = null;
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/videos/';
        $fileName = basename($_FILES['video']['name']);
        $video_upload = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['video']['tmp_name'], $video_upload)) {
        } else {
            echo "Failed to upload video: " . $_FILES['video']['name'] . "<br>";
        }
    }


    // Handle document uploads
    $document_uploads = [];
    if (isset($_FILES['document']) && is_array($_FILES['document']['name'])) {
        foreach ($_FILES['document']['name'] as $key => $name) {
            if ($_FILES['document']['error'][$key] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['document']['tmp_name'][$key];
                $uploadDir = '../uploads/documents/';
                $fileName = basename($name);
                $uploadFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $uploadFilePath)) {
                    $document_uploads[] = $uploadFilePath; // Add to uploads array
                } else {
                    echo "Failed to upload document: " . $name . "<br>";
                }
            }
        }
    }

    $image_uploads_json = json_encode($image_uploads);
    $document_uploads_json = json_encode($document_uploads);

    $sql = "INSERT INTO emails (message_id, sender_email, recipient_email, subject, message, image_uploads, video_upload, document_uploads)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $message_id, $sender_email, $recipient_email, $subject, $message, 
                      $image_uploads_json, $video_upload, $document_uploads_json);

    if ($stmt->execute()) {
        echo "Email sent successfully!";
        
        $notificationData = [
            'message_id' => $message_id,
            'sender' => $sender_email,
            'recipient' => $recipient_email,
            'subject' => $subject,
            'message' => $message,
            'image_uploads' => $image_uploads_json,
            'video_upload' => $video_upload,
            'document_uploads' => $document_uploads_json,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $msg = json_encode($notificationData);

        try {
            $client = new Client("ws://localhost:8081/emailing");
            $client->send($msg);
            $client->close();
        } catch (Exception $e) {
            error_log("WebSocket Error: " . $e->getMessage());
        }
    } else {
        if ($conn->errno == 1062) {
            echo "Duplicate message ID detected. Please retry.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

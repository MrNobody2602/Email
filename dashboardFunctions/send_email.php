<?php
require '../connection/conn.php';
require __DIR__ . '/../vendor/autoload.php';

use WebSocket\Client;

// error_log("Send Email PHP SCRIPT STARTED");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $sender_email = $_POST['sender'];
    $recipient_email = $_POST['recipient'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $image_uploads = [];
    $document_uploads = [];

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
// Prepare JSON strings from the arrays
$image_uploads_json = json_encode($image_uploads);
$document_uploads_json = json_encode($document_uploads);

// Prepare SQL statement to insert data into the database
$sql = "INSERT INTO emails (sender_email, recipient_email, subject, message, image_uploads, video_upload, document_uploads)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Check if prepare was successful
if ($stmt === false) { 
    die("MySQL prepare error: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssssss", $sender_email, $recipient_email, $subject, $message, 
                  $image_uploads_json, $video_upload, $document_uploads_json);

if ($stmt->execute()) {
    echo "Email sent successfully!";

    $notificationData = [
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
        echo "Failed to send notification: " . $e->getMessage();
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
}
?>
<?php 
require_once '../connection/conn.php';

if (isset($_POST['recipient'])) {
    
    $recipient = trim($_POST['recipient']);

    $query = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $query->bindParam(':email', $recipient);
    $query->execute();

    $count = $query->fetchColumn();

    if ($count > 0){
        echo 'Recipient Exist';
    } else {
        echo "Recipient Doesn't Exist";
    }
} else {
    echo 'No recipient provided';
}
?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

include '../connection/conn.php';

// Get the logged-in user's email
$query = "SELECT email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $recipient_email = htmlspecialchars($row['email']);
} else {
    $recipient_email = '';
}

// Fetch emails with status = 'trash'
$email_query = "SELECT * FROM emails WHERE recipient_email = ? AND status = 'trash' ORDER BY created_at DESC";
if ($email_stmt = $conn->prepare($email_query)) {
    $email_stmt->bind_param("s", $recipient_email);
    $email_stmt->execute();
    $email_result = $email_stmt->get_result();
} else {
    echo "<tr><td colspan='6'>Error preparing email statement: " . $conn->error . "</td></tr>";
}

$conn->close();
?>

<div class="pages__title">
    <h3>Trash</h3>
</div>

<div class="container">
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="trash-table">
                <thead>
                    <tr>
                        <th scope="col">Sender Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date</th>
                        <th scope="col">Read Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if ($email_result->num_rows > 0) {
                            while ($email_row = $email_result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($email_row['sender_email']) . "</td>
                                        <td>" . htmlspecialchars($email_row['subject']) . "</td>
                                        <td>" . htmlspecialchars($email_row['message']) . "</td>
                                        <td>" . htmlspecialchars($email_row['created_at']) . "</td>
                                        <td>" . ($email_row['read_status'] ? 'Read' : 'Unread') . "</td>
                                        <td class='action-icons'>
                                            <button class='icon icon-button archive-button' onclick='changeStatus(" . $email_row['id'] . ", \"inbox\")' title='restore'>
                                                <i class='fa fa-inbox'></i>
                                            </button>
                                            <button class='icon icon-button delete-button' onclick='deletePermanently(" . $email_row['id'] . ")' title='delete permanently'>
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Trash is empty.</td></tr>";
                        }
                        $email_stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailModalLabel">Email Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Sender Email: </strong><span id="modal-sender"></span></p>
                    <p><strong>Subject: </strong><span id="modal-subject"></span></p>
                    <p><strong>Message: </strong><span id="modal-message"></span></p>
                    <p><strong>Date: </strong><span id="modal-date"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container">
        <!-- SUCCESS TOAST -->
        <div class="toast valid-toast" id="validMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <i class="fa fa-check-circle-o valid-icon" aria-hidden="true"></i>
            <div class="toast-body valid-toast-body"></div>
        </div>

        <!-- WARNING TOAST -->
        <div class="toast warning-toast" id="warningMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <i class="fa fa-exclamation-triangle warning-icon" aria-hidden="true"></i>
            <div class="toast-body warning-toast-body"></div>
        </div>

        <!-- ERROR TOAST -->
        <div class="toast invalid-toast" id="invalidMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <i class="fa fa-times-circle-o invalid-icon"></i>
            <div class="toast-body invalid-toast-body"></div>
        </div>
    </div>

    <!-- Loading Screen -->
    <div id="loadingScreen" class="loading-screen d-none">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<script src="../assets/JQUERY/jquery-3.7.1.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/page-action-js/trash_action.js"></script>
<?php
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

include '../connection/conn.php';

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

// Fetch emails sent to the logged-in user
$email_query = "SELECT * FROM emails WHERE recipient_email = ? ORDER BY created_at DESC";
if ($email_stmt = $conn->prepare($email_query)) {
    $email_stmt->bind_param("s", $recipient_email);
    $email_stmt->execute();
    $email_result = $email_stmt->get_result();

} else {
    echo "<tr><td colspan='5'>Error preparing email statement: " . $conn->error . "</td></tr>";
}

$conn->close();
?>
    <div class="pages__title">
        <h1>INBOX</h1>
    </div>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="inbox-table">
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
                        <tr>
                        <?php 
                            if ($email_result->num_rows > 0) {
                                while ($email_row = $email_result->fetch_assoc()) {
                                    $emailData = htmlspecialchars(json_encode($email_row));
                                    $glowClass = $email_row['read_status'] ? '' : 'glowing-border';
                                    echo "<tr class='view-emailDetails $glowClass' data-email='$emailData'>
                                            <td>" . htmlspecialchars($email_row['sender_email']) . "</td>
                                            <td>" . htmlspecialchars($email_row['subject']) . "</td>
                                            <td class='message-cell'>" . htmlspecialchars($email_row['message']) . "</td>
                                            <td>" . htmlspecialchars($email_row['created_at']) . "</td>
                                            <td>" . ($email_row['read_status'] ? 'Read' : 'Unread') . "</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No emails found for this recipient.</td></tr>";
                            }

                            $email_stmt->close();
                        ?>
                        </tr>
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
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/inboxModal.js"></script>
    <!-- <script>
        const socket = new WebSocket('ws://localhost:8081/emailing');

        socket.onopen = function(event) {
            console.log("Connected to WebSocket server.");
        };

        socket.onmessage = function(event) {
            const newEmail = JSON.parse(event.data);
            console.log("New message received:", newEmail);

            const noEmailsRow = document.querySelector("#inbox-table tbody tr td[colspan='6']");
            if (noEmailsRow) {
                noEmailsRow.parentElement.remove();
            }

            const table = document.querySelector("#inbox-table tbody");
            const newRow = document.createElement('tr');
            const emailData = JSON.stringify(newEmail);

            newRow.classList.add('view-emailDetails');
            if (!newEmail.read_status) {
                newRow.classList.add('glowing-border');
            }
            newRow.setAttribute('data-email', emailData);

            newRow.innerHTML = `
                <td>${newEmail.sender}</td>
                <td>${newEmail.subject}</td>
                <td class='message-cell'>${newEmail.message}</td>
                <td>${newEmail.created_at}</td>
                <td>${newEmail.read_status ? 'Read' : 'Unread'}</td>
            `;

            table.prepend(newRow);

            newRow.addEventListener("click", function () {
                const dataAttribute = newRow.getAttribute("data-email");
                if (!dataAttribute) {
                    console.error("Missing data-email attribute");
                    return;
                }

                const emailData = JSON.parse(dataAttribute);

                document.getElementById("modal-sender").textContent = emailData.sender_email;
                document.getElementById("modal-subject").textContent = emailData.subject;
                document.getElementById("modal-message").textContent = emailData.message;
                document.getElementById("modal-date").textContent = emailData.created_at;

                // Show the modal
                emailModal.show();

                if (newRow.classList.contains('glowing-border')) {
                    markEmailAsRead(emailData.id, newRow);
                }
            });
        };
        
        socket.onclose = function(event) {
            console.log("Disconnected from WebSocket server.");
        };

        socket.onerror = function(error){
            console.log("Websocket error:", error);
        }
    </script> -->
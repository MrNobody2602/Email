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
    <h3>INBOX</h3>
</div>

<div class="container">
    <div class="table-wrapper">
        <div class="table-responsive">
            <div class="delete-all-container">
                <button id="delete-all"><i class="fas fa-trash delete-all"></i></button>
                <button id="archive-all"><i class="fas fa-archive archive-all"></i></button>
            </div>
            <table class="table table-striped table-hover" id="inbox-table">
                <thead>
                    <tr>
                        <th class="checkbox-favorite">
                            <input type="checkbox" id="select-all">
                        </th>
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
                                $emailData = htmlspecialchars(json_encode($email_row));
                                $glowClass = $email_row['read_status'] ? '' : 'glowing-border';
                                echo "<tr class='view-emailDetails $glowClass' data-email='$emailData'>
                                        <td class='checkbox-favorite'>
                                            <input type='checkbox' class='row-checkbox'>
                                            <span class='favorite'><i class='fas fa-star'></i></span>
                                        </td>
                                        <td class='sender-cell'>" . htmlspecialchars($email_row['sender_email']) . "</td>
                                        <td>" . htmlspecialchars($email_row['subject']) . "</td>
                                        <td class='message-cell'>" . htmlspecialchars($email_row['message']) . "</td>
                                        <td>" . htmlspecialchars($email_row['created_at']) . "</td>
                                        <td>" . ($email_row['read_status'] ? 'Read' : 'Unread') . "</td>
                                        <td class='action-icons'>
                                            <a href='archive.php?id=" . htmlspecialchars($email_row['id']) . "' title='Archive' class='icon archive-icon'>
                                                <i class='fa fa-archive'></i>
                                            </a>
                                            <a href='delete.php?id=" . htmlspecialchars($email_row['id']) . "' title='Delete' class='icon delete-icon'>
                                                <i class='fa fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>You're inbox is empty.</td></tr>";
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
</div>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/inboxModal.js"></script>
<script>
    const selectAllCheckbox = document.getElementById('select-all');
const rowCheckboxes = document.querySelectorAll('.row-checkbox');
const deleteAllContainer = document.querySelector('.delete-all-container');
const favoriteIcons = document.querySelectorAll('.favorite');

// Prevent checkbox clicks from triggering other events
const preventCheckboxPropagation = (event) => {
  event.stopPropagation();
};

// Prevent favorite icon clicks from triggering other events
const preventFavoritePropagation = (event) => {
  event.stopPropagation();

  // Toggle favorite state (optional logic)
  const icon = event.target;
  if (icon.classList.contains('fa-star')) {
    icon.classList.toggle('favorited'); // Add or remove a favorited class
    icon.style.color = icon.classList.contains('favorited') ? 'gold' : '#b3b3b3';
  }
};

// Toggle "Select All" checkbox and "Delete All" button
selectAllCheckbox.addEventListener('change', (event) => {
  rowCheckboxes.forEach((checkbox) => {
    checkbox.checked = selectAllCheckbox.checked;
  });
  toggleDeleteAllButton();
  event.stopPropagation(); // Prevent other events like modal triggers
});

// Toggle visibility of the "Delete All" button based on selected rows
const toggleDeleteAllButton = () => {
  const checkedCount = Array.from(rowCheckboxes).filter((checkbox) => checkbox.checked).length;
  deleteAllContainer.style.display = checkedCount > 0 ? 'block' : 'none';
};

// Add event listeners to each row checkbox
rowCheckboxes.forEach((checkbox) => {
  checkbox.addEventListener('change', (event) => {
    selectAllCheckbox.checked = Array.from(rowCheckboxes).every((cb) => cb.checked);
    toggleDeleteAllButton();
    event.stopPropagation(); // Prevent modal or unintended behavior
  });

  // Prevent checkbox clicks from triggering the modal
  checkbox.addEventListener('click', preventCheckboxPropagation);
});

// Add event listeners to favorite icons
favoriteIcons.forEach((icon) => {
  icon.addEventListener('click', preventFavoritePropagation);
});

</script>
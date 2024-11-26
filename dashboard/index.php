<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Get user information from the session
$user_name = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$username = $user_name;

// Include the database connection file
include '../connection/conn.php';

// Fetch the email from the users table
$query = "SELECT email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $sender_email = htmlspecialchars($row['email']);
} else {
    $sender_email = ''; 
}

// Fetch the existing profile data if available
$user_profile = [];
if ($user_id) {
    $stmt = $conn->prepare("SELECT * FROM update_profile WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_profile = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>

<?php include('header.php'); ?>

<body>
    <main class="navbar">
        <div class="container-fluid">
            <div class="topnav-title">
                <i class="fa-regular fa-envelope"></i>
                <span class="QM-title">QuantaMail</span>
            </div>
            <div class="d-flex search-input">
                <i class="fa-solid fa-search search-icon"></i>
                <input class="searchBar" type="search" placeholder="Search" aria-label="Search">
                <button class="searchButton" type="submit">Search</button>
            </div>
            <span class="navigation__group">
                <img src="<?= isset($user_profile['image']) ? '../uploads/images/' . $user_profile['image'] : '../assets/svg/User-profile.svg' ?>" class="profile" width="150">
            </span>
            <div class="dropdown__wrapper conceal" id="profileDropdown">
                <div class="dropdown__group">
                    <div class="user-name"><?= $_SESSION['username'] ?? $user_profile['username'] ?? '' ?></div>
                    <div class="email"><?php echo isset($sender_email) ? $sender_email : ''; ?></div>
                </div>
                <hr class="divider">
                <div class="profile__dropdown">
                    <ul>
                    <li data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <img src="<?= isset($user_profile['image']) ? '../uploads/images/' . $user_profile['image'] : '../assets/svg/User-profile.svg' ?>" class="profile" width="150">
                        <span class="profile__links">My Profile</span>
                    </li>
                        <li>
                            <img src="../assets/svg/settings.svg" alt="Settings"> 
                            <span class="profile__links">Settings</span>
                        </li>
                    </ul>
                    <hr class="divider">
                    <ul>
                        <li onclick="window.location.href='../logout.php'">
                            <img src="../assets/svg/logout.svg" alt="Log Out">
                            <span class="profile__links">Logout</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <div class="container-fluid d-flex">
        <!-- EDIT PROFILE Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" id="modalContent">
                    <form action="../dashboardFunctions/update_profile.php" id="updateProfileForm" method="POST" enctype="multipart/form-data">
                        <div class="modal-header" id="modalHeader">
                            <p class="profileModalTitle"><?php echo isset($sender_email) ? $sender_email : ''; ?></p>
                            <button type="button" class="btn-close profileButtonClose" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="modalBody">
                            <div class="mb-3 position-relative text-center">
                                <img id="previewImage" src="<?= isset($user_profile['image']) ? '../uploads/images/' . $user_profile['image'] : '' ?>" 
                                    class="rounded-circle profile-image" width="100" height="100" style="object-fit: cover; border: 1px solid #fff">
                                <label for="image" class="position-absolute edit-button" style="bottom: 0; right: 190px; cursor: pointer;">
                                    <img src="../assets/svg/pen-edit.svg" alt="edit profile" title="change image" width="24" height="24">
                                </label>
                                <input type="file" class="d-none" name="image" id="image" accept="image/*" onchange="previewFile()">
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="editProfileModal">Username</label>
                                    <input type="text" class="form-control editProfileInput" name="username" value="<?= $_SESSION['username'] ?? $user_profile['username'] ?? '' ?>">
                                </div>
                                <div class="col-md-4 mb-3">     
                                    <label class="editProfileModal">Firstname</label>
                                    <input type="text" class="form-control editProfileInput" name="firstname" value="<?= $user_profile['firstname'] ?? '' ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="editProfileModal">Lastname</label>
                                    <input type="text" class="form-control editProfileInput" name="lastname" value="<?= $user_profile['lastname'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="editProfileModal">Phone Number</label>
                                    <input type="number" class="form-control editProfileInput" name="phone_number" value="<?= $user_profile['phone_number'] ?? '' ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="editProfileModal">Age</label>
                                    <input type="number" class="form-control editProfileInput" name="age" value="<?= $user_profile['age'] ?? '' ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="editProfileModal">Birthday</label>
                                    <input type="date" format="YYYY-MM-DD" class="form-control datepicker-input" name="birthday" value="<?= $user_profile['birthday'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="editProfileModal">Address</label>
                                <input type="text" class="form-control editProfileInput" name="address" value="<?= $user_profile['address'] ?? '' ?>">
                            </div>
                            <hr class="editProfileDivider">
                            <div class="row">
                                <div class="col-md-6 mb-3 position-relative">
                                    <label class="editProfileModal">Current Password</label>
                                    <input type="password" class="form-control editProfileInput" name="current_password" id="currentPassword">
                                    <span class="toggle-password">
                                        <i class="fas fa-eye editProfileToggle" id="toggleCurrentPassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3 position-relative">
                                    <label class="editProfileModal">New Password</label>
                                    <input type="password" class="form-control editProfileInput" name="new_password" id="newPassword">
                                    <span class="toggle-password">
                                        <i class="fas fa-eye editProfileToggle" id="toggleNewPassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="editProfileFooter">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                    <div class="toast-container">
                        <!-- SUCCESS TOAST -->
                        <div class="toast valid-toast" id="validProfileMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                            <i class="fa fa-check-circle-o valid-icon" aria-hidden="true"></i>
                            <div class="toast-body valid-toast-body"></div>
                        </div>

                        <!-- WARNING TOAST -->
                        <div class="toast warning-toast" id="warningProfileMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                            <i class="fa fa-exclamation-triangle warning-icon" aria-hidden="true"></i>
                            <div class="toast-body warning-toast-body"></div>
                        </div>

                        <!-- ERROR TOAST -->
                        <div class="toast invalid-toast" id="invalidProfileMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                            <i class="fa fa-times-circle-o invalid-icon"></i>
                            <div class="toast-body invalid-toast-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content flex-grow-1 p-4">
        <?php
            if (isset($_GET['page'])) {
                $page = strtolower($_GET['page']);
                switch ($page) {
                    case 'inbox':
                        include('Inbox.php');
                        break;
                    case 'compose':
                        include('Compose.php');
                        break;
                    case 'sent':
                        include('Sent.php');
                        break;
                    case 'drafts':
                        include('Draft.php');
                        break;
                    case 'starred':
                        include('Starred.php');
                        break;
                    case 'archive':
                        include('Archive.php');
                        break;
                    case 'trash':
                        include('Trash.php');
                        break;
                    default:
                        include('Inbox.php');
                        break;
                    }
                } else {
                    include('inbox.php');
                }
            ?>
        </div>
    </div>

    <nav class="bottom-navbar">
        <a href="?page=compose" class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'compose') ? 'active' : ''; ?>">
            <i class="fa-solid fa-pen"></i>
            <span>Compose</span>
        </a>
        <a href="?page=inbox" class="nav-item <?php echo (!isset($_GET['page']) || $_GET['page'] === 'inbox') ? 'active' : ''; ?>">
            <i class="fa-solid fa-inbox"></i>
            <span>Inbox</span>
        </a>
        <a href="?page=sent" class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'sent') ? 'active' : ''; ?>">
            <i class="fa-solid fa-paper-plane"></i>
            <span>Sent</span>
        </a>
        <a href="?page=starred" class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'sent') ? 'active' : ''; ?>">
            <i class="fa-regular fa-bookmark"></i>
            <span>Starred</span>
        </a>
        <a href="?page=archive" class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'sent') ? 'active' : ''; ?>">
            <i class="fa-solid fa-box-archive"></i>
            <span>Archive</span>
        </a>
        <a href="?page=drafts" class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'drafts') ? 'active' : ''; ?>">
            <i class="fa-solid fa-file-alt"></i>
            <span>Drafts</span>
        </a>
        <a href="?page=trash" class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] === 'trash') ? 'active' : ''; ?>">
            <i class="fa-solid fa-trash"></i>
            <span>Trash</span>
        </a>
    </nav>
    <script src="../assets/JQUERY/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/toggle_UpdatePassword.js"></script>
    <script src="../assets/js/updateProfileValidation.js"></script>
    <script>
        function previewFile() {
            const preview = document.getElementById('previewImage');
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.onload = () => { preview.src = reader.result; };
            if (file) reader.readAsDataURL(file);
        }
    </script>
</body>
</html>
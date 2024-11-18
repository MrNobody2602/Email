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

    <div class="container-fluid d-flex main-sidebar-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <span class="expand-btn"><i class="fa-solid fa-bars"></i></span>
            <div class="sidebar-links">
                <ul>
                    <li>
                        <a href="?page=compose" title="Compose mail">
                            <div class="icon">
                                <img src="../assets/svg/compose.svg" title="Compose Icon">
                                <span class="link hide">Compose</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="?page=inbox" class="active" title="Messages">
                            <div class="icon">
                                <img src="../assets/svg/inbox.svg" title="Inbox Icon">
                            </div>
                            <span class="link hide">Inbox</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=sent" title="Sent Mails">
                            <div class="icon">
                                <img src="../assets/svg/sent.svg" title="Sent Icon">
                            </div>
                        <span class="link hide">Sent</span>
                        </a>
                    </li>   
                    <li>
                        <a href="?page=drafts" title="Draft Mails">
                            <div class="icon">
                                <img src="../assets/svg/draft.svg" title="Drafts Icon">
                            </div>
                        <span class="link hide">Drafts</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=starred" title="Starred Mails">
                            <div class="icon">
                                <img src="../assets/svg/starred.svg" title="Starred Icon">
                            </div>
                        <span class="link hide">Starred</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=archive" title="Archived Mails">
                            <div class="icon">
                                <img src="../assets/svg/archive.svg" title="Archive Icon">
                            </div>
                        <span class="link hide">Archive</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=trash" title="Trash Mails">
                            <div class="icon">
                                <img src="../assets/svg/trash.svg" title="Trash Icon">
                            </div>
                        <span class="link hide">Trash</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    
        <!-- EDIT PROFILE Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="../dashboardFunctions/update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo isset($sender_email) ? $sender_email : ''; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 text-center">
                                <img id="previewImage" src="<?= isset($user_profile['image']) ? '../uploads/images/' . $user_profile['image'] : '' ?>" class="rounded-circle" width="100">
                                <input type="file" class="form-control mt-3" name="image" id="image" accept="image/*" onchange="previewFile()">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= $_SESSION['username'] ?? $user_profile['username'] ?? '' ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" value="<?= $user_profile['phone_number'] ?? '' ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Age</label>
                                    <input type="number" class="form-control" name="age" value="<?= $user_profile['age'] ?? '' ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Birthday</label>
                                    <input type="date" class="form-control" name="birthday" value="<?= $user_profile['birthday'] ?? '' ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="<?= $user_profile['address'] ?? '' ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
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
                    case 'spam':
                        include('Spam.php');
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
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
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
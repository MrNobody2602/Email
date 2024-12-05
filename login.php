<?php include('login_header.php'); ?>
<body>
    <div class="container">
        <div class="row global">
            <div class="col-md-4 login-form">
                <h1 class="log-in-title">LOG IN</h1>
                <form id="loginForm" method="post" novalidate>
                    <div class="input-container">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="Email" id="email" class="email-input" autocomplete="email">
                        <label class="email-label">Email</label>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <input type="password" name="Password" id="password" class="password-input">
                        <label class="password-label">Password</label>
                        <span class="toggle-password">
                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </span>
                    </div>
                    <div>
                        <a href="registration_form.php" class="to-login">Doesn't have an account?</a>
                        <button type="submit" class="register-btn">
                            <span class="span-mother">
                                <span>s</span>
                                <span>u</span>
                                <span>b</span>
                                <span>m</span>
                                <span>i</span>
                                <span>t</span>
                            </span>
                            <span class="span-mother2">
                                <span>s</span>
                                <span>u</span>
                                <span>b</span>
                                <span>m</span>
                                <span>i</span>
                                <span>t</span>
                            </span>
                        </button>
                    </div>
                    <footer class="loginFooter">
                    © 2024 BSIT-41A. All Rights Reserved.
                </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container for Stacking Toasts Vertically -->
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

    <!-- jQuery -->
    <script src="./assets/JQUERY/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Your Custom JS -->
    <script src="./assets/js/login_validation.js"></script>
    <script src="./assets/js/toggle_password.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
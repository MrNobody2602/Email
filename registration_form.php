<?php include('login_header.php'); ?>
<body>
    <div class="container">
        <div class="row global">
            <div class="col-md-4 registration-card">
                <h1 class="sign-in-title">SIGN UP</h1>
                <form id="registrationForm" method="POST" novalidate>
                    <div class="input-container">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="username" id="username" class="username-input" autocomplete="username">
                        <label class="username-label">Username</label>
                        <small id="usernameCount" class="char-count">0/50 characters</small>
                    </div>
                    <div class="input-container">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" id="email" class="email-input" autocomplete="email">
                        <label class="email-label">Email</label>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <input type="password" name="password" id="password" class="password-input">
                        <label class="password-label">Password</label>
                        <span class="toggle-password">
                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </span>
                        <small id="passwordStrength" class="char-count">Password Strength:</small>
                    </div>
                    <div class="input-container">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" id="confirm_password" class="password-input">
                        <label class="password-label">Confirm Password</label>
                        <span class="toggle-password">
                            <i class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                        </span>
                    </div>  
                    <div>
                        <a href="login.php" class="to-login">Do you have an account?<br>Proceed to login ↪</a>
                    </div>  
                    <div>
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
                    <footer class="registrationFooter">
                    © 2024 BSIT-41A. All Rights Reserved.
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container for Stacking Toasts Vertically -->
    <div class="toast-container">
        <div class="toast valid-toast" id="validMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <i class="fa fa-check-circle-o valid-icon" aria-hidden="true"></i>
            <div class="toast-body valid-toast-body"></div>
        </div>

        <div class="toast warning-toast" id="warningMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <i class="fa fa-exclamation-triangle warning-icon" aria-hidden="true"></i>
            <div class="toast-body warning-toast-body"></div>
        </div>

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

    <!-- JQUERY -->
    <script src="./assets/JQUERY/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/registration_validation.js"></script>
    <script src="./assets/js/toggle_password.js"></script>
    <script src="./assets/js/script.js"></script>
    
    <!-- BOOTSTRAP JS -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
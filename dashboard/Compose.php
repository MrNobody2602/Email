<div class="pages__title">
    <h3>NEW MESSAGE</h3>
</div>

    <div class="compose-container">
        <form action="" class="composeForm" id="composeForm" method="post" enctype="multipart/form-data" novalidate>
            <div class="input-group">
                <label for="sender">Sender:</label>
                <input name="sender" class="sender-input" id="sender" value="<?php echo isset($sender_email) ? $sender_email : ''; ?>" readonly>
                
                <label for="recipient">Recipients Email:</label>
                <input type="email" name="recipient" class="recipient-input" id="recipient" required>
                
                <label for="subject">Subject:</label>
                <input type="text" name="subject" class="subject-input" id="subject" required>

                <div class="file-upload-container">
                    <!-- Image Upload Box -->
                    <div class="file-upload-box">
                        <span class="badge badge-counter" id="image-count">0</span>
                        <label for="image-upload" class="file-upload-label">
                            <img src="../assets/svg/photo.svg" alt="Image"> Image
                        </label>
                        <input type="file" id="image-upload" name="image[]" accept="image/*" multiple>
                    </div>

                    <!-- Video Upload Box -->
                    <div class="file-upload-box">
                        <span class="badge badge-counter" id="video-count">0</span>
                        <label for="video-upload" class="file-upload-label">
                            <img src="../assets/svg/video.svg" alt="Document File"> Video
                        </label>
                        <input type="file" id="video-upload" name="video" accept=".mp4,.mov,.vid">
                    </div>

                    <!-- Document Upload Box -->
                    <div class="file-upload-box">
                        <span class="badge badge-counter" id="document-count">0</span>
                        <label for="document-upload" class="file-upload-label">
                            <img src="../assets/svg/document.svg" alt="Document File"> Docs
                        </label>
                        <input type="file" id="document-upload" name="document[]" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.ppt,.pptx,.ai,.indd,.psd" multiple>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label for="message">Message:</label>
                <textarea name="message" id="compMessage" class="messageBox" required></textarea>
                <small id="messageCount" class="char-count">0 Characters</small>
            </div>
            
            <button class="composeButton" type="submit">
            <div class="svg-wrapper-1">
                <div class="svg-wrapper">
                <img src="../assets/svg/sendButton.svg" alt="Send" class="svgButton">
                </div>
            </div>
            <span>Send</span>
            </button>
        </form>

        <div class="toast-container">
            <!-- SUCCESS TOAST -->
            <div class="toast valid-toast" id="validMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">    
                <div class="toast-body valid-toast-body"></div>
            </div>

            <!-- WARNING TOAST -->
            <div class="toast warning-toast" id="warningMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="toast-body warning-toast-body"></div>
            </div>

            <!-- ERROR TOAST -->
            <div class="toast invalid-toast" id="invalidMessage" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="toast-body invalid-toast-body"></div>
            </div>
        </div>

        <div id="loadingScreen" class="loading-screen d-none">
            <div class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
    </div>
<!-- jQuery -->
<script src="../assets/JQUERY/jquery-3.7.1.min.js"></script>
<!-- Include Bootstrap JS for toasts -->
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/attachment.js"></script>
<script src="../assets/js/compose_Validation.js"></script>
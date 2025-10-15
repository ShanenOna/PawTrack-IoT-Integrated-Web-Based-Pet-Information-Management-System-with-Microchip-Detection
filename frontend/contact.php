<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Contact Us";
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/head.php");
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pawtrack/frontend/partials/client-nav.php'; ?>

    <!-- Main Content -->
    <div class="contact-main">
        <!-- Left Side - Image and Info -->
        <div class="contact-left">
            <div class="contact-info-card">
                <h2 class="contact-title">Connect With Us!</h2>

                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>000-000-0000 </span>
                        <i class="fa-solid fa-envelope"></i>
                        <span>sample@gmail.com</span>
                    </div>
                </div>

                <div class="contact-image-wrapper">
                    <img src="/pawtrack/assets/images/contact_girl_dog.png" alt="Girl with dog" class="contact-image">
                </div>
            </div>
        </div>

        <!-- Right Side - Contact Form -->
        <div class="contact-right">
            <div class="contact-form-card">
                <form class="contact-form" id="contactForm">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Value" required>
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" id="surname" name="surname" placeholder="Value" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Value" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Value" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="contact-submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" /pawtrack/assets/js/script.js"></script>
</body>

</html>
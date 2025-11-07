
<?php
$pageTitle = "PawTrack - FAQs";
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <?php include(__DIR__ . "/partials/client-nav.php"); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="faq-container">
            <h1 class="faq-title">FAQs</h1>

            <div class="faq-item">
                <h3>1. What is PawTrack?</h3>
                <p>PawTrack is an IoT-integrated, web-based system that helps pet owners and veterinary clinics securely manage pet information using microchip detection.</p>
            </div>

            <div class="faq-item">
                <h3>2. How does the microchip scanning work?</h3>
                <p>When your pet’s RFID-enabled microchip is scanned, PawTrack automatically retrieves their profile from a secure database, showing vaccination history, medical records, and owner details.</p>
            </div>

            <div class="faq-item">
                <h3>3. Do I need to install anything to use PawTrack?</h3>
                <p>No. PawTrack is a web-based platform — all you need is an internet connection and login credentials.</p>
            </div>

            <div class="faq-item">
                <h3>4. Who can use PawTrack?</h3>
                <p>PawTrack is designed for pet owners, veterinary staff, and administrators. Each has different access levels to ensure security and privacy.</p>
            </div>

            <div class="faq-item">
                <h3>5. How secure is my information?</h3>
                <p>Your data is protected with encryption, access control, and secure authentication to prevent unauthorized access.</p>
            </div>

            <div class="faq-item">
                <h3>6. I forgot my password. How do I reset it?</h3>
                <p>Go to the login page and click “Forgot Password.” Follow the instructions to securely reset your password.</p>
            </div>

            <div class="faq-item">
                <h3>7. Can administrators monitor system activity?</h3>
                <p>Yes. Administrators can view audit logs that record all major events, including logins and data changes.</p>
            </div>

            <div class="faq-item">
                <h3>8. Is PawTrack only for dogs and cats?</h3>
                <p>No. PawTrack works with any pet that has a compatible RFID microchip.</p>
            </div>
        </div>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/pawtrack/assets/js/script.js"></script>
</body>

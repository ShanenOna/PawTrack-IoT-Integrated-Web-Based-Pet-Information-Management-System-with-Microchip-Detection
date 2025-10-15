<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - About Us";
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/head.php");
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pawtrack/frontend/partials/client-nav.php'; ?>

    <!-- Hero Section with Header Image -->
    <section class="about-hero">
        <div class="about-hero-image">
            <img src="/pawtrack/assets/images/about_header.png" alt="Happy family with pet">
            <div class="about-hero-text">
                <h1>Your Trusted Pet Information Management System with Microchip Detection</h1>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="about-content">
        <div class="about-container">
            <p class="about-text">
                At PawTrack, we believe that every pet deserves safe, reliable, and accessible care. Our IoT-integrated
                web-based system is designed to make pet information management easier, faster, and more secure for both
                veterinary clinics and pet owners. By combining microchip detection technology with a centralized,
                real-time database, PawTrack eliminates the hassle of manual record-keeping and ensures that vital
                information, such as vaccination history, medical records, and identification details, is always at your
                fingertips. Developed with veterinarians, clinic staff, and pet owners in mind, PawTrack streamlines the
                process of retrieving and updating records, protecting sensitive data through strong security measures,
                and keeping every branch connected through seamless data synchronization. Our mission is simple: to
                strengthen the bond between pets, pet owners, and veterinarians by making pet care smarter, safer, and
                more efficient.
            </p>
        </div>
    </section>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" /pawtrack/assets/js/script.js"></script>
</body>

</html>
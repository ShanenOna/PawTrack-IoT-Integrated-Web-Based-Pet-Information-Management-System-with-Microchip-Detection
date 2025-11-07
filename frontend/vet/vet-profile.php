<?php
include(__DIR__ . "/../partials/vet-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Vet Profile";
include(__DIR__ . "/../partials/head.php");
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <nav class="navbar vet-navbar">
        <div class="nav-container">
            <div class="logo">PawTrack</div>
            <ul class="nav-links">
               <!-- <li><a href="vet-profile.php" class="active">Dashboard</a></li> -->
            </ul>
            <div class="vet-nav-icons">
               <!-- <i class="fa-solid fa-bell"></i> -->
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="vet-main-content">
        <!-- Sidebar -->
        <aside class="vet-sidebar">
            <div class="vet-profile-card">
                <img src="" alt="Vet Profile" class="vet-profile-image" id="vetProfileImage">
                <h3 class="vet-name" id="vetName">Loading...</h3>
                <div class="vet-btn-container">
                    <div class="vet-menu">
                    <button class="vet-menu-item active" onclick="location.href='/vet/profile'">
                        <i class="fa-solid fa-user"></i> Profile
                    </button>
                    <button class="vet-menu-item" onclick="location.href='/vet/pet-details'">
                        <i class="fa-solid fa-file-lines"></i> Reports
                    </button>
                    </div>
                    <button class="vet-logout-btn" onclick="vetLogout()">
                        <i class="fa-solid fa-right-from-bracket"></i> Log Out
                    </button>
                </div>
                
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="vet-content-area">
            <div class="vet-info-card">
                <div class="vet-info-grid">
                    <div class="vet-info-col">
                        <p><strong>Name:</strong> <span id="vetNameFull">Loading...</span></p>
                        <p><strong>Role:</strong> Veterinarian</p>
                        <p><strong>Employee ID:</strong> <span id="vetID">Loading...</span></p>
                        <p><strong>Clinic Branch:</strong> <span id="vetClinic">Bethlehem Animal Clinic – Quezon City</span></p>
                    </div>
                    <div class="vet-info-col">
                        <p><strong>Specialization:</strong> <span id="vetSpecialization">N/A</span></p>
                        <p><strong>License Number:</strong> <span id="vetLicense">N/A</span></p>
                        <p><strong>Years of Experience:</strong> <span id="vetExperience">N/A</span></p>
                    </div>
                </div>
                <div class="vet-contact-info">
                    <p><strong>Contact Number:</strong> <span id="vetContact">N/A</span></p>
                    <p><strong>Email:</strong> <span id="vetEmail">Loading...</span></p>
                </div>
            </div>
        </main>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js"></script>

    <!-- Scripts -->
    <script src="/assets/js/fetch-vet-profile.js"></script>
    <script src="/assets/js/user-popout.js"></script>

</body>
</html>

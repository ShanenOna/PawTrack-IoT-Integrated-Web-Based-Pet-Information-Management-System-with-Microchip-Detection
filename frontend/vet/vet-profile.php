<?php
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/vet-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Vet Profile";
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/head.php");
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <nav class="navbar vet-navbar">
        <div class="nav-container">
            <div class="logo">PawTrack</div>
            <ul class="nav-links">
                <li><a href="vet-profile.php" class="active">Dashboard</a></li>
            </ul>
            <div class="vet-nav-icons">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="vet-main-content">
        <!-- Sidebar -->
        <aside class="vet-sidebar">
            <div class="vet-profile-card">
                <img src="/pawtrack/storage/images/vet/<?= $pic ?>" alt="Vet Profile" class="vet-profile-image">
                <h3 class="vet-name">Dr. <?= $fname . ' ' . $sname ?></h3>

                <div class="vet-menu">
                    <button class="vet-menu-item active" onclick="location.href='vet-profile.php'">
                        <i class="fa-solid fa-user"></i> Profile
                    </button>
                    <button class="vet-menu-item" onclick="location.href='vet-reports.php'">
                        <i class="fa-solid fa-file-lines"></i> Reports
                    </button>
                </div>

                <button class="vet-logout-btn" onclick="vetLogout()">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="vet-content-area">
            <div class="vet-info-card">
                <div class="vet-info-grid">
                    <div class="vet-info-col">
                        <p><strong>Name:</strong> Dr. <?= $fname . ' ' . $sname ?></p>
                        <p><strong>Role:</strong> Veterinarian</p>
                        <p><strong>Employee ID:</strong> <?= $id ?></p>
                        <p><strong>Clinic Branch:</strong> Bethlehem Animal Clinic – Quezon City</p>
                    </div>
                    <div class="vet-info-col">
                        <p><strong>Specialization:</strong> Small Animal Medicine & Surgery</p>
                        <p><strong>License Number:</strong> PRC-VET-34567</p>
                        <p><strong>Years of Experience:</strong> 8 years</p>
                    </div>
                </div>
                <div class="vet-contact-info">
                    <p><strong>Contact Number:</strong> +63 917 456 7890</p>
                    <p><strong>Email:</strong> <?= $email ?></p>
                </div>
            </div>
        </main>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" /pawtrack/assets/js/script.js"></script>
</body>

</html>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/vet-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Search Pet";
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
                <li><a href="vet-search.html" class="active">Dashboard</a></li>
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
                <img src="vet_profile.png" alt="Vet Profile" class="vet-profile-image">
                <h3 class="vet-name">Dr. Maria Isabel Santos</h3>

                <div class="vet-menu">
                    <button class="vet-menu-item" onclick="location.href='vet-profile.html'">
                        <i class="fa-solid fa-user"></i> Profile
                    </button>
                    <button class="vet-menu-item active" onclick="location.href='vet-search.html'">
                        <i class="fa-solid fa-file-lines"></i> Reports
                    </button>
                </div>

                <button class="vet-logout-btn" onclick="logout()">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="vet-content-area">
            <div class="vet-search-section">
                <h2 class="vet-search-title">Search Pet Microchip</h2>
                <div class="vet-search-bar">
                    <input type="text" id="vetSearchInput" placeholder="Search pet microchip number here"
                        class="vet-search-input">
                    <button class="vet-search-btn" onclick="searchPetMicrochip()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
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
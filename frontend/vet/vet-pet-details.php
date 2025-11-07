<?php
include(__DIR__ . "/../partials/vet-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Pet Details";
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
               <!-- <li><a href="vet-search.php" class="active">Dashboard</a></li> -->
            </ul>
            <div class="vet-nav-icons">
                <!-- <i class="fa-solid fa-bell"></i> -->
                <!-- <i class="fa-solid fa-user"></i> -->
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="vet-main-content">
        <!-- Dynamic Sidebar -->
        <aside class="vet-sidebar">
            <div class="vet-profile-card">
                <img src="" alt="Vet Profile" class="vet-profile-image">
                <h3 class="vet-name">Loading...</h3>
                <div class="vet-btn-container">
                <div class="vet-menu">
                    <button class="vet-menu-item" onclick="location.href='/vet/profile'">
                        <i class="fa-solid fa-user"></i> Profile
                    </button>
                    <button class="vet-menu-item active" onclick="location.href='/vet/pet-details'">
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
            <!-- Search Section -->
            <div class="vet-search-section">
                <h2 class="vet-search-title">Search Pet Microchip</h2>
                <div class="vet-search-bar">
                    <input type="text" id="searchPetInput" placeholder="Enter Microchip Number" class="vet-search-input">
                    <button id="searchPetBtn" class="vet-add-btn">+</button>
                </div>
            </div>

            <!-- Pet Details Grid (Hidden Initially) -->
            <div class="vet-pet-details-grid" id="petDetailsGrid" style="display: none;">
                <!-- Pet Image -->
                <div class="vet-pet-image-card">
                    <img src="/assets/images/petsamples.png" alt="Pet" class="vet-pet-image" id="petImage">
                </div>

                <!-- Pet Info -->
                <div class="vet-pet-info-card">
                    <h3 class="vet-card-title">Microchip Number</h3>
                    <p class="vet-microchip-display" id="petMicrochip">Loading...</p>
                    <div class="vet-pet-details" id="petDetails">
                        <!-- Dynamic Pet Details Will Be Injected Here -->
                    </div>
                </div>

                <!-- Pet Records -->
                <div class="vet-records-card">
                    <h3 class="vet-card-title">Pet Records</h3>
                    <div class="vet-records-list" id="petRecords">
                        <!-- Links/Buttons Will Be Rendered Here -->
                    </div>
                </div>

                <!-- Reports Actions -->
                <div class="vet-actions-card">
                    <h3 class="vet-card-title">Reports</h3>
                    <div class="vet-actions-list">
                        <button class="vet-action-btn">Update Vaccinations <i class="fa-solid fa-pen"></i></button>
                        <button class="vet-action-btn">Generate Medical Reports <i class="fa-solid fa-pen"></i></button>
                        <button class="vet-action-btn">Write a Note <i class="fa-solid fa-pen"></i></button>
                    </div>
                </div>

                <!-- Email Owner -->
                <div class="vet-email-card">
                    <h3 class="vet-card-title">Email the owner</h3>
                    <h4>Email</h4>
                    <input type="text" class="vet-email-input" id="ownerEmail">
                    <h4>Message</h4>
                    <input type="email" placeholder="Value" class="vet-email-input" id="messageContent">
                    <button class="vet-submit-btn">Submit</button>
                </div>
            </div>
        </main>
    </div>

    <div class="paw-pattern"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/fetch-vet-profile.js"></script>
    <script src="/assets/js/search-pet.js"></script> 

</body>
</html>

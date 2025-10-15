<?php
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/vet-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Pet Details";
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
            <!-- Search Section -->
            <div class="vet-search-section">
                <h2 class="vet-search-title">Search Pet Microchip</h2>
                <div class="vet-search-bar">
                    <input type="text" id="vetSearchInput" value="00000000000000000" class="vet-search-input">
                    <button class="vet-add-btn">+</button>
                </div>
            </div>

            <!-- Pet Details Grid -->
            <div class="vet-pet-details-grid">
                <!-- Pet Image -->
                <div class="vet-pet-image-card">
                    <img src="/pawtrack/assets/images/petsamples.png" alt="Pet" class="vet-pet-image">
                </div>

                <!-- Pet Info -->
                <div class="vet-pet-info-card">
                    <h3 class="vet-card-title">Microchip Number</h3>
                    <p class="vet-microchip-display">00000000000000000</p>
                    <div class="vet-pet-details">
                        <p><strong>Name:</strong> Mochi</p>
                        <p><strong>Species:</strong> Dog</p>
                        <p><strong>Breed:</strong> Shih Tzu – Poodle Mix (Shih-Poo)</p>
                        <p><strong>Gender:</strong> Female</p>
                        <p><strong>Age:</strong> 3 years old</p>
                        <p><strong>Weight:</strong> 5.8 kg</p>
                        <p><strong>Color/Markings:</strong> Light brown coat with darker ears</p>
                    </div>
                </div>

                <!-- Pet Records -->
                <div class="vet-records-card">
                    <h3 class="vet-card-title">Pet Records</h3>
                    <div class="vet-records-list">
                        <a href="#" class="vet-record-link">Vaccination History</a>
                        <a href="#" class="vet-record-link">Medical Records</a>
                        <a href="#" class="vet-record-link">Notes</a>
                    </div>
                </div>

                <!-- Reports Actions -->
                <div class="vet-actions-card">
                    <h3 class="vet-card-title">Reports</h3>
                    <div class="vet-actions-list">
                        <button class="vet-action-btn">
                            Update Vaccinations
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="vet-action-btn">
                            Generate Medical Reports
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="vet-action-btn">
                            Write a Note
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                </div>

                <!-- Email Owner -->
                <div class="vet-email-card">
                    <h3 class="vet-card-title">Email the owner</h3>
                    <input type="email" placeholder="Value" class="vet-email-input">
                    <button class="vet-submit-btn">Submit</button>
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
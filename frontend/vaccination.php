<?php
session_start(); // Start session once

// Check if a client is logged in
if (isset($_SESSION['ClientID'])) {
    include(__DIR__ . '/../partials/client-session.php');
}
// Check if a vet is logged in
elseif (isset($_SESSION['VetID'])) {
    include(__DIR__ . '/../partials/vet-session.php');
} else {
    // No session, redirect to login
    header("Location: /");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Audit Logs";
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <nav class="navbar admin-navbar">
        <div class="nav-container">
            <div class="logo">PawTrack</div>
            <div class="admin-search-bar">
                <input type="text" placeholder="Search User by Name / Email / ID" class="admin-search-input">
                <button class="admin-search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="admin-nav-icon">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </nav>

        <!-- Main Content Area -->
        <main class="admin-content-area" style="padding: 2rem;">
            <div style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 1rem;" onclick="window.history.back();">
                <img src="/assets/images/arrow.png" alt="back" style="height: 30px; width: 30px; ">
                <h1 class="admin-table-title" style="color: #d97706; margin: 0;">Vaccination History</h1>
            </div>

            <div class="admin-table-container">
                <table class="admin-audit-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sept 25, 2025 10:35</td>
                            <td>Dr. Maria Santos</td>
                            <td>Veterinarian</td>
                            <td>Updated vaccination record for Mochi</td>
                            <td class="status-success">Success</td>
                        </tr>
                        <tr>
                            <td>Sept 25, 2025 09:50</td>
                            <td>Julia Denina</td>
                            <td>Pet Owner</td>
                            <td>Logged in</td>
                            <td class="status-success">Success</td>
                        </tr>
                        <tr>
                            <td>Sept 24, 2025 16:26</td>
                            <td>Admin: Paul Tan</td>
                            <td>Administrator</td>
                            <td>Created new user account for Vet ID VET-105</td>
                            <td class="status-success">Success</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" /pawtrack/assets/js/script.js"></script>
</body>

</html>
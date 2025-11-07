<?php
include(__DIR__ . "/../partials/admin-session.php");
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
                    <button class="admin-btn" onclick="window.location.href='/admin/management'">Management</button>
                    <!--
                    <button class="admin-btn" onclick=""window.location.href='/admin/audit'>Audit</button>
                    -->     
                </button>
            </div>
            <div class="admin-nav-icon">
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="admin-main-content">
        <main class="admin-content-area">

            <!-- Admins Table -->
            <h2 class="admin-table-title">Admins</h2>
            <div class="admin-table-container">
                <table class="admin-audit-table" id="admin-table">
                    <thead>
                        <tr>
                            <th>AdminID</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            <th>Admin Start Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JS will populate this -->
                    </tbody>
                </table>
            </div>

            <!-- Veterinarians Table -->
            <h2 class="admin-table-title">Veterinarians</h2>
            <div class="admin-table-container">
                <table class="admin-audit-table" id="vet-table">
                    <thead>
                        <tr>
                            <th>VetID</th>
                            <th>Vet Name</th>
                            <th>Vet Email</th>
                            <th>Vet Start Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JS will populate this -->
                    </tbody>
                </table>
            </div>

            <!-- Clients Table -->
            <h2 class="admin-table-title">Clients</h2>
            <div class="admin-table-container">
                <table class="admin-audit-table" id="client-table">
                    <thead>
                        <tr>
                            <th>ClientID</th>
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Client Start Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JS will populate this -->
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/manage-user.js"></script>
</body>

</html>

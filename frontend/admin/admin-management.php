<?php
include(__DIR__ . "/../partials/admin-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Admin Management";
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <nav class="navbar admin-navbar">
        <div class="nav-container">
            <div class="logo">PawTrack</div>
            
            <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $adminId = $_SESSION['AdminID'] ?? '';
            $adminPic = $_SESSION['AdminPic'] ?? '';
            $adminName = trim(($_SESSION['AdminFName'] ?? '') . ' ' . ($_SESSION['AdminSName'] ?? ''));
            $adminEmail = $_SESSION['AdminEmail'] ?? '';
            ?>
            <div class="admin-nav-icon" data-user-id="<?= htmlspecialchars($adminId) ?>" data-user-role="admin">
                <?php if ($adminPic): ?>
                    <img src="<?= htmlspecialchars($adminPic) ?>" alt="Admin avatar" class="user-avatar" style="width:28px;height:28px;border-radius:50%;object-fit:cover;" />
                <?php else: ?>
                    <i class="fa-solid fa-user"></i>
                <?php endif; ?>
            </div>
            <span class="user-name" style="display:none"><?= htmlspecialchars($adminName) ?></span>
            <span class="user-email" style="display:none"><?= htmlspecialchars($adminEmail) ?></span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="admin-main-content">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-profile-card">
                <img src="<?= htmlspecialchars($pic) ?>" alt="Admin Profile" class="vet-profile-image">
                <h3 class="admin-title">Admin</h3>
                <p class="admin-subtitle"><?= $fname . ' ' . $sname ?></p>

                <div class="admin-menu">
                    <button class="admin-menu-item active" onclick="location.href='/admin/management'">
                        <i class="fa-solid fa-users-gear"></i> Management
                    </button>
                    <!--
                    <button class="admin-menu-item" onclick="location.href='/admin/audit'">
                        <i class="fa-solid fa-clock-rotate-left"></i> Audit Logs
                    </button>
                     -->
                </div>
                
                <button class="admin-logout-btn" onclick="adminLogout()">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-content-area">
            <div class="admin-actions-grid">
                <!-- Manage Users Card -->
                <div class="admin-action-card" onclick="location.href='/admin/manage-users'">
                    <i class="fa-solid fa-user-plus admin-action-icon"></i>
                    <h3 class="admin-action-title">Manage Users</h3>
                </div>

                <!-- Edit User Card 
                <div class="admin-action-card" onclick="alert('Edit User feature')">
                    <i class="fa-solid fa-pen admin-action-icon"></i>
                    <h3 class="admin-action-title">Edit User</h3>
                </div>
                -->
            </div>
        </main>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js"></script>
</body>

</html>
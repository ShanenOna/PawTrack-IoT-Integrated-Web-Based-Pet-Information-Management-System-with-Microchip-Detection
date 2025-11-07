<!-- Navigation Bar -->
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">PawTrack</div>
        <ul class="nav-links">
            <li><a href="/about"
                    class="<?= strpos($_SERVER['REQUEST_URI'], 'about') !== false ? 'active' : '' ?>">About Us</a></li>

            <li><a href="/contact"
                    class="<?= strpos($_SERVER['REQUEST_URI'], 'contact') !== false ? 'active' : '' ?>">Contact Us</a></li>

            <li><a href="/dashboard"
                    class="<?= strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false ? 'active' : '' ?>">Dashboard</a></li>

            <li><a href="/faqs"
                    class="<?= strpos($_SERVER['REQUEST_URI'], 'faqs') !== false ? 'active' : '' ?>">FAQs</a></li>
        </ul>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $sessionId = $_SESSION['ClientID'] ?? $_SESSION['VetID'] ?? $_SESSION['AdminID'] ?? '';
    $sessionRole = isset($_SESSION['ClientID']) ? 'client' : (isset($_SESSION['VetID']) ? 'vet' : (isset($_SESSION['AdminID']) ? 'admin' : ''));
    ?>
    <div class="user-icon" data-user-id="<?= htmlspecialchars($sessionId) ?>" data-user-role="<?= htmlspecialchars($sessionRole) ?>">
            <?php
            // If session provides a user pic, show it; otherwise show a generic icon
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $uPic = $_SESSION['ClientPic'] ?? null;
            $uName = trim(($_SESSION['ClientFName'] ?? '') . ' ' . ($_SESSION['ClientLName'] ?? '')) ?: '';
            ?>
            <?php if ($uPic): ?>
                <img src="<?= htmlspecialchars($uPic) ?>" alt="avatar" class="user-avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;" />
            <?php else: ?>
                <i class="fa-solid fa-user"></i>
            <?php endif; ?>
            <span class="user-name" style="display:none"><?= htmlspecialchars($uName) ?></span>
            <span class="user-email" style="display:none"><?= htmlspecialchars($_SESSION['ClientEmail'] ?? '') ?></span>
        </div>
    </div>
</nav>

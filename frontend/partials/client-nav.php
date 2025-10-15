<!-- Navigation Bar -->
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">PawTrack</div>
        <ul class="nav-links">
            <li><a href="/pawtrack/frontend/about.php"
                    class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About Us</a></li>
            <li><a href="/pawtrack/frontend/contact.php"
                    class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>">Contact Us</a></li>
            <li><a href="/pawtrack/frontend/dashboard.php"
                    class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="/pawtrack/frontend/faqs.php"
                    class="<?= basename($_SERVER['PHP_SELF']) == 'faqs.php' ? 'active' : '' ?>">FAQs</a></li>
        </ul>
        <div class="user-icon">
            <i class="fa-solid fa-user"></i>
        </div>
    </div>
</nav>
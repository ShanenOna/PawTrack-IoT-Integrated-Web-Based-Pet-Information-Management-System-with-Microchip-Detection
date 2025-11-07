<!-- User Profile Section -->
<div class="profile-section">
    <div class="profile-card">
        <img src="<?= $pic ?>" alt="User Profile" class="profile-image">
        <h3 class="profile-title"><?= $fname . ' ' . $lname ?></h3>
        <p class="profile-info">Client ID:<?= $id ?></p>
        <p class="profile-info"><?= $email ?></p>
        <p class="profile-info"><?php echo date('F j, Y', strtotime($startDate)); ?></p>
        <button class="admin-logout-btn" onclick="logout()">
            <i class="fa-solid fa-right-from-bracket"></i> Log Out
        </button>
    </div>
</div>
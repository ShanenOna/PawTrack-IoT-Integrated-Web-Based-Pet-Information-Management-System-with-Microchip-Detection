<?php
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/client-session.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - Dashboard";

include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/head.php");
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pawtrack/frontend/partials/client-nav.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/pawtrack/frontend/partials/client-profile-card.php'; ?>

        <!-- My Pets Section -->
        <div class="pets-section">
            <div class="pets-header">
                <h2 class="section-title">
                    My Pets
                </h2>
                <button class="expand-btn">⊕</button>
            </div>

            <div class="pets-container">
                <?php if (!empty($pets)): ?>
                    <?php foreach ($pets as $pet): ?>
                        <a href="pets.php?pet_id=<?= urlencode($pet['PetID']) ?>" class="pet-card clickable">
                            <img src="/pawtrack/storage/images/pets/<?= htmlspecialchars($pet['PetPic']) ?>"
                                alt="<?= htmlspecialchars($pet['PetName']) ?>" class="pet-image">
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-pets">No pets found. Add one to get started!</p>
                <?php endif; ?>
            </div>

            <!-- Microchip Scanner -->
            <div class="scanner-section">
                <h3 class="scanner-title">Microchip Scanner</h3>
                <div class="scanner-input">
                    <input type="text" placeholder="Your microchip number will automatically show up once scanned"
                        class="microchip-input">
                    <button class="add-btn">+</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" /pawtrack/assets/js/script.js"></script>
</body>

</html>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/client-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "PawTrack - My Pets";
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/frontend/partials/head.php");
if (isset($_GET['pet_id'])) {
    $petID = $_GET['pet_id'];
    $pet = $fetch->getPetDetails($petID);

    if ($pet) {
        $petRecords = $fetch->getPetRecords($petID);
        $latestRecord = $fetch->getLatestPetRecord($petID);
        $vet = $fetch->getPetVeterinary($latestRecord['VetID']);
    } else {
        echo "Pet not found.";
    }
} else {
    echo "No PetID provided.";
}
?>

<body>
    <!-- Top Brown Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/pawtrack/frontend/partials/client-nav.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Pet Details Section -->
        <div class="pet-details-container">
            <h2 class="section-title">
                <span class="back-arrow" onclick="window.location.href='dashboard.php'">◀</span> My Pets
            </h2>

            <!-- Microchip Number -->
            <div class="microchip-box">
                <div class="microchip-label">Microchip Number</div>
                <div class="microchip-number"><?= $pet['PetChipNum'] ?></div>
                <button class="add-microchip-btn">⊕</button>
            </div>

            <!-- Pet Info Cards -->
            <div class="pet-info-grid">
                <!-- Pet Image -->
                <div class="pet-image-card">
                    <img src="/pawtrack/storage/images/pets/<?= htmlspecialchars($pet['PetPic']) ?>" alt="Pet"
                        class="pet-detail-image">
                </div>

                <!-- Pet Name Card -->
                <div class="info-card orange-card">
                    <h3 class="card-title"><?= $pet['PetName'] ?></h3>
                    <p class="card-info">Species (Dog, Cat, etc.)</p>
                    <p class="card-info">Breed</p>
                    <p class="card-info">Age / Date of Birth</p>
                    <p class="card-info">Gender</p>
                </div>

                <!-- Owner Name Card -->
                <div class="info-card orange-card">
                    <h3 class="card-title"><?= $fname . ' ' . $lname ?></h3>
                    <p class="card-info">Client ID:<?= $id ?></p>
                    <p class="card-info"><?= $email ?></p>
                    <p class="card-info"><?php echo date('F j, Y', strtotime($startDate)); ?></p>
                    <p class="card-info">Information Here</p>
                </div>

                <!-- Pet Records Menu -->
                <div class="records-menu">
                    <h3 class="menu-title">Pet Records</h3>
                    <button class="menu-item active" onclick="showTab('vaccination')">Vaccination History</button>
                    <button class="menu-item" onclick="showTab('medical')">Past Medical Records</button>
                    <button class="menu-item" onclick="showTab('notes')">Notes from Veterinarians</button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Vaccination History Tab -->
                <div id="vaccination-tab" class="tab-pane active">
                    <h2 class="tab-title">
                        Vaccination History
                    </h2>
                    <div class="table-container">
                        <table class="records-table">
                            <thead>
                                <tr>
                                    <th colspan="3" class="table-header">VACCINATION RECORD</th>
                                </tr>
                                <tr>
                                    <th>Shot Type</th>
                                    <th>Date</th>
                                    <th>Next Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($petRecords)): ?>
                                    <?php foreach ($petRecords as $record): ?>
                                        <tr>
                                            <td><?= $record['VaxRecord'] ?></td>
                                            <td><?= $record['Date'] ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="no-pets">No records found.</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Medical Records Tab -->
                <div id="medical-tab" class="tab-pane">
                    <h2 class="tab-title">
                        Medical Records
                    </h2>
                    <div class="table-container">
                        <table class="records-table">
                            <thead>
                                <tr>
                                    <th colspan="3" class="table-header">PUPPY INFORMATION</th>
                                </tr>
                                <tr>
                                    <th>Pet's Name: <?= $pet['PetName'] ?></th>
                                    <th>Breed:</th>
                                    <th>Color:</th>
                                </tr>
                                <tr>
                                    <th>Registered Number: <?= $pet['PetChipNum'] ?></th>
                                    <th>Sex:</th>
                                    <th>Birth Weight:</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="records-table" style="margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th colspan="3" class="table-header">KNOWN HEALTH CONDITIONS</th>
                                </tr>
                                <tr>
                                    <th>Diagnosis</th>
                                    <th>Date Diagnosed</th>
                                    <th>Treatment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($petRecords)): ?>
                                    <?php foreach ($petRecords as $record): ?>
                                        <tr>
                                            <td><?= $record['MedRecord'] ?></td>
                                            <td><?= $record['Date'] ?></td>
                                            <td><?= $record['VaxRecord'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="no-pets">No records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Vet Notes Tab -->
                <div id="notes-tab" class="tab-pane">
                    <h2 class="tab-title">
                        Notes from Veterinarians
                    </h2>
                    <div class="notes-container">
                        <div class="note-header">
                            <p><strong>Date:</strong> <?= $latestRecord['Date'] ?></p>
                            <p><strong>Veterinarian:</strong> Dr. <?= $vet['VetFName'] . ' ' . $vet['VetSName'] ?>, DVM
                            </p>
                        </div>
                        <div class="note-content">
                            <p><strong>Notes:</strong></p>
                            <ul>
                                <?php if (!empty($petRecords)): ?>
                                    <?php foreach ($petRecords as $record): ?>
                                        <li><?= $record['MedRecord'] ?></li>
                                        <li>Vaccinated <?= $record['VaxRecord'] ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>No records found.</li>
                                <?php endif; ?>
                            </ul>
                            <p><strong>Follow-up Recommendation:</strong> Routine wellness check in 6 months.</p>
                        </div>
                    </div>
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
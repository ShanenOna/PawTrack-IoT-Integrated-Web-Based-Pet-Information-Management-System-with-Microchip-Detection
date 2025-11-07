<?php
session_start(); // Ensure session is started

include(__DIR__ . "/partials/client-session.php"); // Client session
include(__DIR__ . "/partials/head.php"); // Head section

// ---- Extract PetID from URL ----
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));

if ($segments[0] === 'pets' && isset($segments[1])) {
    $petID = $segments[1];
} elseif (isset($_GET['pet_id'])) {
    $petID = $_GET['pet_id'];
} else {
    header("Location: /dashboard"); // redirect if no PetID
    exit;
}

// ---- Fetch Pet Details ----
$pet = $fetch->getPetDetails($petID);
if (!$pet) {
    echo "<p>Pet not found.</p>";
    exit;
}

// ---- Store PetID in session for API calls ----
$_SESSION['CurrentPetID'] = $petID;

// Fetch pet records, latest record, and vet info
$petRecords = $fetch->getPetRecords($petID);
$latestRecord = $fetch->getLatestPetRecord($petID);
$vet = $latestRecord ? $fetch->getPetVeterinary($latestRecord['VetID']) : null;

// Fetch owner info
$owner = $fetch->getClientDetails($pet['ClientID']);
$fname = $owner['FirstName'] ?? '';
$lname = $owner['LastName'] ?? '';
$email = $owner['Email'] ?? '';
$startDate = $owner['CreatedAt'] ?? '';
?>

<body>
    <!-- Top Bar -->
    <div class="top-bar"></div>

    <!-- Navigation Bar -->
    <?php include(__DIR__ . '/partials/client-nav.php'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="pet-details-container">
            <h2 class="section-title" onclick="windows.history.back()">
                <span class="back-arrow" onclick="window.location.href='/dashboard'">◀</span> My Pets
            </h2>

            <!-- Microchip Number -->
            <div class="microchip-box">
                <div class="microchip-label">Microchip Number</div>
                <div class="microchip-number"><?= htmlspecialchars($pet['PetChipNum']) ?></div>
        
            </div>

            <!-- Pet Info Grid -->
            <div class="pet-info-grid">
                <!-- Pet Image -->
                <div class="pet-image-card">
                    <img src="/storage/images/pets/<?= htmlspecialchars($pet['PetPic'] ?: 'petsamples.png') ?>"
                         alt="<?= htmlspecialchars($pet['PetName'] ?: 'Pet Image') ?>" 
                         class="pet-detail-image">
                </div>

                <!-- Pet Info Card -->
                <div class="info-card orange-card">
                    <h3 class="card-title"><?= htmlspecialchars($pet['PetName']) ?></h3>
                    <p class="card-info">Species: <?= htmlspecialchars($pet['Species']) ?></p>
                    <p class="card-info">Breed: <?= htmlspecialchars($pet['Breed']) ?></p>
                    <p class="card-info">Age: <?= htmlspecialchars($pet['Age']) ?></p>
                    <p class="card-info">Gender: <?= htmlspecialchars($pet['Gender']) ?></p>
                    <p class="card-info">Weight: <?= htmlspecialchars($pet['Weight']) ?> kg</p>
                    <p class="card-info">Color/Markings: <?= htmlspecialchars($pet['ColorMarkings']) ?></p>
                </div>

                <!-- Owner Info Card -->
                <div class="info-card orange-card">
                    <h3 class="card-title"><?= htmlspecialchars($fname . ' ' . $lname) ?></h3>
                    <p class="card-info">Client ID: <?= htmlspecialchars($pet['ClientID']) ?></p>
                    <p class="card-info"><?= htmlspecialchars($email) ?></p>
                    <p class="card-info">Joined: <?= $startDate ? date('F j, Y', strtotime($startDate)) : '' ?></p>
                </div>

                <!-- Pet Records Menu -->
                <div class="records-menu">
                    <h3 class="menu-title">Pet Records</h3>
                    <button class="menu-item active" data-tab="vaccination" onclick="showTab('vaccination', this)">Vaccination History</button>
                    <button class="menu-item" data-tab="medical" onclick="showTab('medical', this)">Past Medical Records</button>
                    <button class="menu-item" data-tab="notes" onclick="showTab('notes', this)">Notes from Veterinarians</button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Vaccination History Tab -->
                <div id="vaccination-tab" class="tab-pane active">
                    <h2 class="tab-title">Vaccination History</h2>
                    <div class="table-container">
                        <table class="records-table">
                            <thead>
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
                                            <td><?= htmlspecialchars($record['VaxRecord']) ?></td>
                                            <td><?= htmlspecialchars($record['Date']) ?></td>
                                            <td><?= htmlspecialchars($record['NextDue'] ?? '-') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="3">No records found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Medical Records Tab -->
                <div id="medical-tab" class="tab-pane">
                    <h2 class="tab-title">Medical Records</h2>
                    <div class="table-container">
                        <table class="records-table">
                            <thead>
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
                                            <td><?= htmlspecialchars($record['MedRecord']) ?></td>
                                            <td><?= htmlspecialchars($record['Date']) ?></td>
                                            <td><?= htmlspecialchars($record['VaxRecord']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="3">No records found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notes Tab -->
                <div id="notes-tab" class="tab-pane">
                    <h2 class="tab-title">Notes from Veterinarians</h2>
                    <div class="notes-container">
                        <?php if ($latestRecord && $vet): ?>
                            <div class="note-header">
                                <p><strong>Date:</strong> <?= htmlspecialchars($latestRecord['Date']) ?></p>
                                <p><strong>Veterinarian:</strong> Dr. <?= htmlspecialchars($vet['VetFName'] . ' ' . $vet['VetSName']) ?>, DVM</p>
                            </div>
                            <div class="note-content">
                                <p><strong>Notes:</strong></p>
                                <ul>
                                    <?php foreach ($petRecords as $record): ?>
                                        <li><?= htmlspecialchars($record['MedRecord']) ?: 'No medical notes' ?></li>
                                        <li>Vaccinated: <?= htmlspecialchars($record['VaxRecord']) ?: 'N/A' ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <p><strong>Follow-up Recommendation:</strong> Routine wellness check in 6 months.</p>
                            </div>
                        <?php else: ?>
                            <p>No veterinarian notes found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab switching JS -->
    <script>
    function showTab(tabName, btn) {
        document.querySelectorAll('.tab-pane').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.menu-item').forEach(b => b.classList.remove('active'));

        document.getElementById(tabName + '-tab').classList.add('active');
        if (btn) btn.classList.add('active');
    }
    </script>

    <!-- Paw Print Background Pattern -->
    <div class="paw-pattern"></div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/pet-records.js"></script>
    <script>
        // Expose PetID to client scripts for reliable fetching
        window.PAWTRACK_PET_ID = <?= json_encode($petID) ?>;
    </script>
</body>

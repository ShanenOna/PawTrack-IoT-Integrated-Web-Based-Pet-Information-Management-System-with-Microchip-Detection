<?php

include_once(__DIR__ . "/db.php");


class Vet
{
    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    /* ======================================================
       Add Vaccination Record
       ====================================================== */
    public function addVaccinationRecord($petID, $clientID, $shotType, $date, $nextDueDate, $veterinarian, $clinic)
    {
        try {
            $sql = "INSERT INTO vaccination_records 
                    (PetID, ClientID, ShotType, Date, NextDueDate, Veterinarian, Clinic)
                    VALUES (:PetID, :ClientID, :ShotType, :Date, :NextDueDate, :Veterinarian, :Clinic)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':PetID' => $petID,
                ':ClientID' => $clientID,
                ':ShotType' => $shotType,
                ':Date' => $date,
                ':NextDueDate' => $nextDueDate,
                ':Veterinarian' => $veterinarian,
                ':Clinic' => $clinic
            ]);
            return ['status' => 'success', 'message' => 'Vaccination record added successfully.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /* ======================================================
       Add Medical Record
       ====================================================== */
    public function addMedicalRecord($petID, $clientID, $diagnosis, $dateDiagnosed, $treatment, $notes)
    {
        try {
            $sql = "INSERT INTO medical_records 
                    (PetID, ClientID, Diagnosis, DateDiagnosed, Treatment, Notes)
                    VALUES (:PetID, :ClientID, :Diagnosis, :DateDiagnosed, :Treatment, :Notes)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':PetID' => $petID,
                ':ClientID' => $clientID,
                ':Diagnosis' => $diagnosis,
                ':DateDiagnosed' => $dateDiagnosed,
                ':Treatment' => $treatment,
                ':Notes' => $notes
            ]);
            return ['status' => 'success', 'message' => 'Medical record added successfully.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /* ======================================================
       Add Vet Note
       ====================================================== */
    public function addNote($petID, $clientID, $date, $veterinarian, $clinic, $visitType, $notes, $followUp)
    {
        try {
            $sql = "INSERT INTO pet_notes 
                    (PetID, ClientID, VisitDate, Veterinarian, Clinic, VisitType, Notes, FollowUpRecommendation)
                    VALUES (:PetID, :ClientID, :Date, :Veterinarian, :Clinic, :VisitType, :Notes, :FollowUpRecommendation)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':PetID' => $petID,
                ':ClientID' => $clientID,
                ':Date' => $date,
                ':Veterinarian' => $veterinarian,
                ':Clinic' => $clinic,
                ':VisitType' => $visitType,
                ':Notes' => $notes,
                ':FollowUpRecommendation' => $followUp
            ]);
            return ['status' => 'success', 'message' => 'Note added successfully.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /* ======================================================
    Fetch Vaccination Records
    ====================================================== */
    public function getVaccinationRecords($petID)
    {
        try {
            $sql = "SELECT ShotType, Date, NextDueDate, Veterinarian, Clinic
                    FROM vaccination_records
                    WHERE PetID = :PetID
                    ORDER BY Date DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':PetID' => $petID]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($records) {
                return ['status' => 'success', 'records' => $records];
            } else {
                return ['status' => 'empty', 'message' => 'No vaccination records found.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /* ======================================================
    Fetch Medical Records
    ====================================================== */
    public function getMedicalRecords($petID)
    {
        try {
            $sql = "SELECT Diagnosis, DateDiagnosed, Treatment, Notes
                    FROM medical_records
                    WHERE PetID = :PetID
                    ORDER BY DateDiagnosed DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':PetID' => $petID]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($records) {
                return ['status' => 'success', 'records' => $records];
            } else {
                return ['status' => 'empty', 'message' => 'No medical records found.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /* ======================================================
    Fetch Pet Notes
    ====================================================== */
    public function getNotes($petID)
    {
    try {
        // Include VisitDate so frontend can display the note date
        $sql = "SELECT VisitDate, Veterinarian, Clinic, VisitType, Notes, FollowUpRecommendation AS FollowUp
            FROM pet_notes
            WHERE PetID = :PetID
            ORDER BY VisitDate DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':PetID' => $petID]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($records) {
                return ['status' => 'success', 'records' => $records];
            } else {
                return ['status' => 'empty', 'message' => 'No notes found.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /* ======================================================
    Download Full Pet Record (Vaccination + Medical + Notes)
    ====================================================== */
    public function downloadFullPetRecord($petID)
    {
            $fpdfPath = __DIR__ . "/../lib/fpdf/fpdf.php";
            if (!file_exists($fpdfPath)) {
                // Clean any output buffers and send a clear error so clients don't receive corrupted PDF data
                while (ob_get_level() > 0) {
                    ob_end_clean();
                }
                http_response_code(500);
                header('Content-Type: text/plain');
                echo "PDF generation library not found. Expected: {$fpdfPath}. Please install FPDF in lib/fpdf/.";
                exit;
            }
            require_once($fpdfPath); // Adjust path if needed

            if (!class_exists('FPDF')) {
                while (ob_get_level() > 0) {
                    ob_end_clean();
                }
                http_response_code(500);
                header('Content-Type: text/plain');
                echo "FPDF class not found after including {$fpdfPath}. Please ensure the library is valid.";
                exit;
            }

            // --- Fetch all records ---
            $vaccination = $this->getVaccinationRecords($petID);
            $medical = $this->getMedicalRecords($petID);
            $notes = $this->getNotes($petID);

            // --- Initialize PDF ---
            // Fetch pet and owner info (if available)
            try {
                $stmt = $this->pdo->prepare("SELECT p.PetName, p.PetChipNum, p.PetPic, p.PetID, c.ClientFName, c.ClientLName
                                            FROM pet p
                                            LEFT JOIN client c ON p.ClientID = c.ClientID
                                            WHERE p.PetID = :PetID");
                $stmt->execute([':PetID' => $petID]);
                $petInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                $petInfo = null;
            }


        $pdf = new FPDF();
        // Set safe margins to avoid table overflow and compute usable width
        $leftRightMargin = 15; // mm
        $topMargin = 15;
        $pdf->SetMargins($leftRightMargin, $topMargin, $leftRightMargin);
        $pdf->AddPage();
        $usableWidth = $pdf->GetPageWidth() - ($leftRightMargin * 2);

            // Helper: approximate number of lines needed for a text in a given width
            $nbLines = function($pdf, $w, $txt) {
                $txt = trim((string)$txt);
                if ($txt === '') return 1;
                $words = preg_split('/\s+/', $txt);
                $lines = 1;
                $cur = '';
                foreach ($words as $word) {
                    $test = $cur === '' ? $word : $cur . ' ' . $word;
                    if ($pdf->GetStringWidth($test) <= $w) {
                        $cur = $test;
                    } else {
                        $lines++;
                        $cur = $word;
                    }
                }
                return $lines;
            };

            // Title: centered, bold, in #d97706
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetTextColor(217, 119, 6); // #d97706
            $pdf->Cell(0, 10, 'Pawtrack Pet Record', 0, 1, 'C');
            $pdf->Ln(3);

            // Pet information header (filled with #d97706)
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetFillColor(217, 119, 6);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(0, 8, 'Pet Information', 0, 1, 'L', true);
            $pdf->Ln(1);

            // Pet details
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0, 0, 0);
            $petName = $petInfo['PetName'] ?? '-';
            $petChip = $petInfo['PetChipNum'] ?? '-';
            $ownerName = '-';
            if (!empty($petInfo)) {
                $ownerName = trim(($petInfo['ClientFName'] ?? '') . ' ' . ($petInfo['ClientLName'] ?? '')) ?: '-';
            }
            $pdf->Cell(40, 7, 'Name:', 0, 0);
            $pdf->Cell(0, 7, $petName, 0, 1);
            $pdf->Cell(40, 7, 'Microchip:', 0, 0);
            $pdf->Cell(0, 7, $petChip, 0, 1);
            $pdf->Cell(40, 7, 'Owner:', 0, 0);
            $pdf->Cell(0, 7, $ownerName, 0, 1);
            $pdf->Ln(5);

            /* ------------------------- SECTION: VACCINATION ------------------------- */
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 8, "Vaccination Records", 0, 1);
            $pdf->SetFont('Arial', 'B', 12);
            // Table header (proportional widths)
            $col1 = round($usableWidth * 0.5); // Shot Type
            $col2 = round($usableWidth * 0.25); // Date
            $col3 = $usableWidth - $col1 - $col2; // Next Due (remainder)
            $pdf->Cell($col1, 8, 'Shot Type', 1);
            $pdf->Cell($col2, 8, 'Date', 1);
            $pdf->Cell($col3, 8, 'Next Due', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);

            if (!empty($vaccination['records'])) {
                // Render each row using MultiCell per column so text wraps within fixed column widths
                $pdf->SetFont('Arial', '', 12);
                $lineHeight = 6; // height per wrapped line in mm
                foreach ($vaccination['records'] as $rec) {
                    $t1 = $rec['ShotType'] ?? '-';
                    $t2 = $rec['Date'] ?? '-';
                    $t3 = $rec['NextDueDate'] ?? '-';

                    // compute lines needed for each column (small padding subtracted)
                    $l1 = max(1, $nbLines($pdf, $col1 - 2, $t1));
                    $l2 = max(1, $nbLines($pdf, $col2 - 2, $t2));
                    $l3 = max(1, $nbLines($pdf, $col3 - 2, $t3));
                    $maxLines = max($l1, $l2, $l3);
                    $rowHeight = $lineHeight * $maxLines;

                    // starting position
                    $x = $pdf->GetX();
                    $y = $pdf->GetY();

                    // Column 1
                    $pdf->SetXY($x, $y);
                    $pdf->MultiCell($col1, $lineHeight, $t1, 1, 'L');
                    // Column 2
                    $pdf->SetXY($x + $col1, $y);
                    $pdf->MultiCell($col2, $lineHeight, $t2, 1, 'L');
                    // Column 3
                    $pdf->SetXY($x + $col1 + $col2, $y);
                    $pdf->MultiCell($col3, $lineHeight, $t3, 1, 'L');

                    // move cursor to the end of the row (no extra spacing for vaccination table)
                    $pdf->SetXY($x, $y + $rowHeight);
                }
            } else {
                $pdf->Cell(0, 8, "No vaccination records found.", 0, 1);
                $pdf->Ln();
            }

            $pdf->Ln(5);

            /* ------------------------- SECTION: MEDICAL ------------------------- */
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 8, "Medical Records", 0, 1);
            $pdf->SetFont('Arial', 'B', 12);
            // Table header (proportional widths) — 3 columns (no Follow Up column)
            $mcol1 = round($usableWidth * 0.45); // Diagnosis
            $mcol2 = round($usableWidth * 0.275); // Date Diagnosed
            $mcol3 = $usableWidth - $mcol1 - $mcol2; // Treatment (remainder)
            $pdf->Cell($mcol1, 8, 'Diagnosis', 1);
            $pdf->Cell($mcol2, 8, 'Date Diagnosed', 1);
            $pdf->Cell($mcol3, 8, 'Treatment', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);

            if (!empty($medical['records'])) {
                $pdf->SetFont('Arial', '', 12);
                $lineHeight = 6;
                $rowSpacing = 2;
                foreach ($medical['records'] as $rec) {
                    $t1 = $rec['Diagnosis'] ?? '-';
                    $t2 = $rec['DateDiagnosed'] ?? '-';
                    $t3 = $rec['Treatment'] ?? '-';

                    $l1 = max(1, $nbLines($pdf, $mcol1 - 2, $t1));
                    $l2 = max(1, $nbLines($pdf, $mcol2 - 2, $t2));
                    $l3 = max(1, $nbLines($pdf, $mcol3 - 2, $t3));
                    $maxLines = max($l1, $l2, $l3);
                    $rowHeight = $lineHeight * $maxLines;

                    $x = $pdf->GetX();
                    $y = $pdf->GetY();

                    $pdf->SetXY($x, $y);
                    $pdf->MultiCell($mcol1, $lineHeight, $t1, 1, 'L');
                    $pdf->SetXY($x + $mcol1, $y);
                    $pdf->MultiCell($mcol2, $lineHeight, $t2, 1, 'L');
                    $pdf->SetXY($x + $mcol1 + $mcol2, $y);
                    $pdf->MultiCell($mcol3, $lineHeight, $t3, 1, 'L');

                    $pdf->SetXY($x, $y + $rowHeight + $rowSpacing);

                    if (!empty($rec['Notes'])) {
                        // Print notes as a full-width row below with spacing before and after
                        $pdf->SetXY($x, $y + $rowHeight + $rowSpacing);
                        $noteLines = max(1, $nbLines($pdf, $usableWidth - 2, 'Notes: ' . $rec['Notes']));
                        $noteHeight = $noteLines * $lineHeight;
                        $pdf->MultiCell($usableWidth, $lineHeight, 'Notes: ' . $rec['Notes'], 1, 'L');
                        // after notes row add small spacing
                        $pdf->Ln($rowSpacing);
                    }
                }
            } else {
                $pdf->Cell(0, 8, "No medical records found.", 0, 1);
            }

            $pdf->Ln(5);

            /* ------------------------- SECTION: NOTES ------------------------- */
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 8, "Vet Notes", 0, 1);
            $pdf->SetFont('Arial', 'B', 12);
            // Table header (5 columns with adjusted proportions)
            // Allocate more space to the Notes column so it stays readable
            $ncol1 = round($usableWidth * 0.25); // Veterinarian
            $ncol2 = round($usableWidth * 0.20); // Clinic
            $ncol3 = round($usableWidth * 0.15); // Visit Type
            $ncol4 = round($usableWidth * 0.10); // Follow Up
            $ncol4 = $usableWidth - $ncol1 - $ncol2 - $ncol3; // Follow Up (remainder)
            $pdf->Cell($ncol1, 8, 'Veterinarian', 1);
            $pdf->Cell($ncol2, 8, 'Clinic', 1);
            $pdf->Cell($ncol3, 8, 'Visit Type', 1);
            $pdf->Cell($ncol4, 8, 'Follow Up', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);

                if (!empty($notes['records'])) {
                    $pdf->SetFont('Arial', '', 12);
                    $lineHeight = 6; // height per wrapped line in mm
                    $rowSpacing = 2; // only tables with notes get extra spacing
                    foreach ($notes['records'] as $rec) {
                        $t1 = $rec['Veterinarian'] ?? '-';
                        $t2 = $rec['Clinic'] ?? '-';
                        $t3 = $rec['VisitType'] ?? '-';
                        $t4 = $rec['FollowUp'] ?? '-';
                        $tNotes = $rec['Notes'] ?? '';

                        $l1 = max(1, $nbLines($pdf, $ncol1 - 2, $t1));
                        $l2 = max(1, $nbLines($pdf, $ncol2 - 2, $t2));
                        $l3 = max(1, $nbLines($pdf, $ncol3 - 2, $t3));
                        $l4 = max(1, $nbLines($pdf, $ncol4 - 2, $t4));
                        $maxLines = max($l1, $l2, $l3, $l4);
                        $rowHeight = $lineHeight * $maxLines;

                        $x = $pdf->GetX();
                        $y = $pdf->GetY();

                        // Render the 4 main columns
                        $pdf->SetXY($x, $y);
                        $pdf->MultiCell($ncol1, $lineHeight, $t1, 1, 'L');
                        $pdf->SetXY($x + $ncol1, $y);
                        $pdf->MultiCell($ncol2, $lineHeight, $t2, 1, 'L');
                        $pdf->SetXY($x + $ncol1 + $ncol2, $y);
                        $pdf->MultiCell($ncol3, $lineHeight, $t3, 1, 'L');
                        $pdf->SetXY($x + $ncol1 + $ncol2 + $ncol3, $y);
                        $pdf->MultiCell($ncol4, $lineHeight, $t4, 1, 'L');

                        // move down to after the main row
                        $pdf->SetXY($x, $y + $rowHeight + $rowSpacing);

                        // If notes present, print as full-width row below and add spacing
                        if (!empty($tNotes)) {
                            $pdf->SetX($x);
                            $noteLines = max(1, $nbLines($pdf, $usableWidth - 2, 'Notes: ' . $tNotes));
                            $pdf->MultiCell($usableWidth, $lineHeight, 'Notes: ' . $tNotes, 1, 'L');
                            $pdf->Ln($rowSpacing);
                        }
                    }
                } else {
                    $pdf->Cell(0, 8, "No notes found.", 0, 1);
                }

            // --- Ensure no prior output (whitespace or warnings) corrupts PDF ---
            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            // --- Output PDF to browser (force download) ---
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=Pet_{$petID}_Full_Record.pdf");
            // Use 'D' to force download; Output will write binary PDF to stdout
            $pdf->Output('D', "Pet_{$petID}_Full_Record.pdf");
            exit;
        }

}
?>

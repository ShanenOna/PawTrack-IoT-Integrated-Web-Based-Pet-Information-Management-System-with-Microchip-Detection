<?php
// Generate PDF for PetID P002 and save to storage/test_pet_P002.pdf
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/../lib/fpdf/fpdf.php';
require_once __DIR__ . '/vet-class.php';

if (!isset($pdo) || !$pdo) {
    echo "Missing PDO instance in db.php\n";
    exit(1);
}
$vet = new Vet($pdo);
$petID = 'P002';
$outPath = __DIR__ . '/../storage/test_pet_P002.pdf';

// Fetch records
$vaccination = $vet->getVaccinationRecords($petID);
$medical = $vet->getMedicalRecords($petID);
$notes = $vet->getNotes($petID);

// Fetch pet info
try {
    $stmt = $pdo->prepare("SELECT p.PetName, p.PetChipNum, p.PetPic, p.PetID, c.ClientFName, c.ClientLName
                                         FROM pet p
                                         LEFT JOIN client c ON p.ClientID = c.ClientID
                                         WHERE p.PetID = :PetID");
    $stmt->execute([':PetID' => $petID]);
    $petInfo = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $petInfo = null;
}

$pdf = new FPDF();
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

// Title
$pdf->SetFont('Arial', 'B', 18);
$pdf->SetTextColor(217, 119, 6);
$pdf->Cell(0, 10, 'Pawtrack Pet Record', 0, 1, 'C');
$pdf->Ln(3);

// Pet information header
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(217, 119, 6);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, 'Pet Information', 0, 1, 'L', true);
$pdf->Ln(1);

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

/* VACCINATION */
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, "Vaccination Records", 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$col1 = round($usableWidth * 0.5);
$col2 = round($usableWidth * 0.25);
$col3 = $usableWidth - $col1 - $col2;
$pdf->Cell($col1, 8, 'Shot Type', 1);
$pdf->Cell($col2, 8, 'Date', 1);
$pdf->Cell($col3, 8, 'Next Due', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);

if (!empty($vaccination['records'])) {
    $lineHeight = 6;
    foreach ($vaccination['records'] as $rec) {
        $t1 = $rec['ShotType'] ?? '-';
        $t2 = $rec['Date'] ?? '-';
        $t3 = $rec['NextDueDate'] ?? '-';
        $l1 = max(1, $nbLines($pdf, $col1 - 2, $t1));
        $l2 = max(1, $nbLines($pdf, $col2 - 2, $t2));
        $l3 = max(1, $nbLines($pdf, $col3 - 2, $t3));
        $maxLines = max($l1, $l2, $l3);
        $rowHeight = $lineHeight * $maxLines;
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x, $y);
        $pdf->MultiCell($col1, $lineHeight, $t1, 1, 'L');
        $pdf->SetXY($x + $col1, $y);
        $pdf->MultiCell($col2, $lineHeight, $t2, 1, 'L');
        $pdf->SetXY($x + $col1 + $col2, $y);
        $pdf->MultiCell($col3, $lineHeight, $t3, 1, 'L');
        $pdf->SetXY($x, $y + $rowHeight);
    }
} else {
    $pdf->Cell(0, 8, "No vaccination records found.", 0, 1);
    $pdf->Ln();
}

$pdf->Ln(5);

/* MEDICAL */
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, "Medical Records", 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$mcol1 = round($usableWidth * 0.45);
$mcol2 = round($usableWidth * 0.275);
$mcol3 = round($usableWidth * 0.2);
$mcol4 = $usableWidth - $mcol1 - $mcol2 - $mcol3;
$pdf->Cell($mcol1, 8, 'Diagnosis', 1);
$pdf->Cell($mcol2, 8, 'Date Diagnosed', 1);
$pdf->Cell($mcol3, 8, 'Treatment', 1);
$pdf->Cell($mcol4, 8, 'Notes', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);

if (!empty($medical['records'])) {
    $lineHeight = 6;
    $rowSpacing = 2;
    foreach ($medical['records'] as $rec) {
        $t1 = $rec['Diagnosis'] ?? '-';
        $t2 = $rec['DateDiagnosed'] ?? '-';
        $t3 = $rec['Treatment'] ?? '-';
        $tNotes = $rec['Notes'] ?? '';
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
        $pdf->SetXY($x + $mcol1 + $mcol2 + $mcol3, $y);
        $pdf->MultiCell($mcol4, $lineHeight, '', 1, 'L');
        $pdf->SetXY($x, $y + $rowHeight + $rowSpacing);
        if (!empty($tNotes)) {
            $pdf->SetX($x);
            $noteLines = max(1, $nbLines($pdf, $usableWidth - 2, 'Notes: ' . $tNotes));
            $pdf->MultiCell($usableWidth, $lineHeight, 'Notes: ' . $tNotes, 1, 'L');
            $pdf->Ln($rowSpacing);
        }
    }
} else {
    $pdf->Cell(0, 8, "No medical records found.", 0, 1);
}

$pdf->Ln(5);

/* VET NOTES */
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 8, "Vet Notes", 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$ncol1 = round($usableWidth * 0.25);
$ncol2 = round($usableWidth * 0.20);
$ncol3 = round($usableWidth * 0.15);
$ncol4 = round($usableWidth * 0.10);
$ncol5 = $usableWidth - $ncol1 - $ncol2 - $ncol3 - $ncol4;
$pdf->Cell($ncol1, 8, 'Veterinarian', 1);
$pdf->Cell($ncol2, 8, 'Clinic', 1);
$pdf->Cell($ncol3, 8, 'Visit Type', 1);
$pdf->Cell($ncol4, 8, 'Follow Up', 1);
$pdf->Cell($ncol5, 8, 'Notes', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);

if (!empty($notes['records'])) {
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
        $pdf->SetXY($x, $y);
        $pdf->MultiCell($ncol1, $lineHeight, $t1, 1, 'L');
        $pdf->SetXY($x + $ncol1, $y);
        $pdf->MultiCell($ncol2, $lineHeight, $t2, 1, 'L');
        $pdf->SetXY($x + $ncol1 + $ncol2, $y);
        $pdf->MultiCell($ncol3, $lineHeight, $t3, 1, 'L');
        $pdf->SetXY($x + $ncol1 + $ncol2 + $ncol3, $y);
        $pdf->MultiCell($ncol4, $lineHeight, $t4, 1, 'L');
        $pdf->SetXY($x, $y + $rowHeight + $rowSpacing);
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

// Save to file
$pdf->Output('F', $outPath);

echo "Saved: $outPath\n";

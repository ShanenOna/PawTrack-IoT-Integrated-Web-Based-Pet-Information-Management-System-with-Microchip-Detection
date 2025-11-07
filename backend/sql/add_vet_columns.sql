-- Migration: add vet-specific profile columns if they do not exist
-- Run this once against the PawTrack database (e.g., via phpMyAdmin or mysql CLI)

ALTER TABLE `vet`
  ADD COLUMN IF NOT EXISTS `VetSpecialization` VARCHAR(255) NULL AFTER `VetEmail`,
  ADD COLUMN IF NOT EXISTS `VetLicenseNo` VARCHAR(100) NULL AFTER `VetSpecialization`,
  ADD COLUMN IF NOT EXISTS `VetExperience` INT NULL AFTER `VetLicenseNo`,
  ADD COLUMN IF NOT EXISTS `VetContact` VARCHAR(50) NULL AFTER `VetExperience`,
  ADD COLUMN IF NOT EXISTS `ClinicBranch` VARCHAR(255) NULL AFTER `VetContact`;

-- Notes:
-- 1) Some MySQL versions do not support IF NOT EXISTS on ADD COLUMN; if your server errors,
--    remove the IF NOT EXISTS parts and run each ADD COLUMN only if the column is missing.
-- 2) To run from command line (Windows PowerShell), use:
--    mysql -u root -p pawtrack < path\to\add_vet_columns.sql

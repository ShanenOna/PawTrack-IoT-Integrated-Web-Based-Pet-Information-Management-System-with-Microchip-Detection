<!DOCTYPE html>
<html lang="en">



<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
include(__DIR__ . "/frontend/partials/head.php");
?>


<!-- DYNAMIC ROUTING -->
<?php 
//===== ROUTES ================
$routes = [
    "/" => "frontend/login.php",
    "/signup" => "frontend/signup.php",
    "/about" => "frontend/about.php",
    "/contact" => "frontend/contact.php",
    "/dashboard" => "frontend/dashboard.php",
    "/faqs" => "frontend/faqs.php",
    "/pets" => "frontend/pets.php",
    "/admin/login" => "frontend/admin/admin-login.php",
    "/vet/login" => "frontend/vet/vet-login.php",
    "/admin/audit" => "frontend/admin/admin-audit.php",
    "/admin/management" => "frontend/admin/admin-management.php",
    "/admin/manage-users" => "frontend/admin/admin-manage-user.php",
    "/vet/pet-details" => "frontend/vet/vet-pet-details.php",
    "/vet/profile" => "frontend/vet/vet-profile.php",
    "/vet/search" => "frontend/vet/vet-search.php",
    "/vaccination" => "frontend/vaccination.php",
    "/medical-records" => "frontend/medical-records.php",
    "/notes" => "frontend/notes.php",
];

//=============================

if (preg_match('#^/pets/([A-Za-z0-9]+)$#', $path, $matches)) {
    $_GET['pet_id'] = $matches[1]; // store PetID in GET
    include "frontend/pets.php";
    exit;
}

if (isset($routes[$path])) {
    include $routes[$path];
} else {
    // Route not found -> send 404 and show friendly page
    http_response_code(404);
    // make $path available to the 404 template
    include __DIR__ . "/frontend/404.php";
    exit;
}
?>
  
</html>


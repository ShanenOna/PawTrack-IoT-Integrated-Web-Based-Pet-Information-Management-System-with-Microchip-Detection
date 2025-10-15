<?php
session_start();
session_unset();
session_destroy();
header("Location: /pawtrack/frontend/vet/vet-login.php");
exit();
?>
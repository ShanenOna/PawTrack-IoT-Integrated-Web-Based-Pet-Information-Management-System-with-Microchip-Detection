<?php
session_start();
session_unset();
session_destroy();
header("Location: /pawtrack/frontend/admin/admin-login.php");
exit();
?>
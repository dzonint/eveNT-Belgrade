<?php 
require_once 'admin/database.php';
!$_SESSION['administrator'] ? header("Location: index.php") : $a = 1; // Bukvalno bilo šta u else.
require_once 'modules/header.php'; 
require_once 'modules/navbar.php';
require_once 'modules/body-users.php';
require_once 'modules/footer.php'; 
?>
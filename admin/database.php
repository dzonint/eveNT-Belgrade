<?php 
session_start();
if(isset($_SESSION['SESS_CHANGEID']) == TRUE) {
session_unset();
session_regenerate_id();
}

$conn = mysqli_connect("localhost", "root", "", "event_locator") or die("Neuspešno otvaranje baze - " . mysqli_connect_error()); 
 mysqli_set_charset($conn, "utf8"); // Bitan korak, da znakovi latinice ne bi ispadali kao znakovi pitanja.
?>
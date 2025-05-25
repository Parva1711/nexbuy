<?php
session_start();

$_SESSION = [];

session_destroy();


header("Location: validate1.php"); 
exit();
?>

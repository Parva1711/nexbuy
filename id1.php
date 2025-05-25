<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: hp.php");
    exit();
}
?>
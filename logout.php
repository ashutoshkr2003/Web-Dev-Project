<?php
include("includes/config.php");
$_SESSION['user'] = '';
echo "<script>alert('Successfully logged out'); window.location='login.php';</script>";
?>

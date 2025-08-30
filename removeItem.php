<?php
include("includes/config.php");

$pid = $_GET['pID'];
$sql = "DELETE FROM cart WHERE productId = $pid AND userId = " . $_SESSION['userId'];
$result = mysqli_query($conn, $sql);
header("location: cart.php");
?>

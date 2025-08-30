<?php

include("includes/config.php");

$userId = $_POST['userId'];
$productId = $_POST['productId'];

$sql = "SELECT id FROM cart WHERE userId='$userId' AND productId=$productId";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);
$sql = "SELECT price FROM products WHERE id=$productId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$price = (int) $row['price'];
if ($numRows) {
    $sql = "UPDATE cart SET qty=qty+1 WHERE userId='$userId' AND productId=$productId";
} else {
    $sql = "INSERT INTO cart(userId, productId, qty) VALUES('$userId',$productId,1)";
}
mysqli_query($conn, $sql);
?>
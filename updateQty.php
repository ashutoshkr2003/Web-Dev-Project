<?php

include("includes/config.php");

$userId = $_POST['userId'];
$productId = $_POST['productId'];
$qty = $_POST['qty'];

//$sql = "SELECT id FROM cart WHERE userId='$userId' AND productId=$productId";
//$result = mysqli_query($conn, $sql);
//$numRows = mysqli_num_rows($result);
if ($qty == 0) {
    $sql = "DELETE FROM cart WHERE userId='$userId' AND productId=$productId";
    mysqli_query($conn, $sql);
    header("location: cart.php");
} else {
    $sql = "SELECT price FROM products WHERE id=$productId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $price = $row['price'];
    $totalPrice = $qty * $price;
    $sql = "UPDATE cart SET qty=$qty WHERE userId='$userId' AND productId=$productId";
    mysqli_query($conn, $sql);
    echo $totalPrice;
}

?>
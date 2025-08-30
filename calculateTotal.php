<?php
include("includes/config.php");

$userId = $_POST['userId'];
$sql = "SELECT SUM(B.price*A.qty) AS totalPrice FROM cart A INNER JOIN products B ON A.productId=B.id WHERE A.userID = '$userId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$total = $row['totalPrice'];
echo $total;
?>
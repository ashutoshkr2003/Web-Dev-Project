<?php
include("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $totalAmount = $_POST['totalAmount'];

    // Insert order details into the orders table
    $sql = "INSERT INTO orders (userId, totalAmount, orderDate) VALUES ('$userId', '$totalAmount', CURDATE())";
    if (mysqli_query($conn, $sql)) {
        $orderId = mysqli_insert_id($conn);

        // Move cart items to order items table
        $sql = "INSERT INTO order_items (orderId, productId, qty, userId)
                SELECT '$orderId', productId, qty, '$userId' FROM cart WHERE userId = '$userId'";
        if (mysqli_query($conn, $sql)) {
            // Clear the cart
            $sql = "DELETE FROM cart WHERE userId = '$userId'";
            mysqli_query($conn, $sql);

            echo "<script>alert('Order placed successfully!'); window.location.href = 'index.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
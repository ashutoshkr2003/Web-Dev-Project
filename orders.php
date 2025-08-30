<!DOCTYPE html>
<?php
include("includes/config.php");

// Calculate line totals in SQL query
$sql = "SELECT orderId, totalAmount, orderDate FROM orders WHERE userId = " . $_SESSION['userId'] . " ORDER BY orderDate DESC";
$result = mysqli_query($conn, $sql);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simplikart</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="css/flexslider.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="common.js"></script>
    <script>
        $(document).ready(function() {
            getCart("<?=$_SESSION['userId']?>");
        });
    </script>
</head>
<body class="tm-gray-bg">
<div class="tm-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3 tm-site-name-container">
                <a href="index.php" class="tm-site-name">Simplikart</a>
            </div>
            <div class="col-md-8 col-sm-9">
                <div class="mobile-menu-icon">
                    <i class="fa fa-bars"></i>
                </div>
                <nav class="tm-nav">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">All Products</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">
                                Welcome, <?= $_SESSION['user'] ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" style="height: auto;">
                                <li><a href="orders.php">Orders</a></li>
                                <li><a href="logout.php" class="tm-logout" style="color: darkred;">Logout</a></li>
                            </ul>
                        </li>
                        <li style="margin-top: -8px"><span id="panelCart"></span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 100px;">
    <div class="tm-section-header" style="margin-bottom: 20px">
        <div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
        <div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Orders</h2></div>
        <div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
    </div>
    <table class="table table-striped" style="text-align: center">
        <thead>
        <tr>
<!--            <th scope="col" style="text-align: center">S. No.</th>-->
            <th scope="col" style="text-align: center">Order id</th>
            <th scope="col" style="text-align: center">Order date</th>
            <th scope="col" style="text-align: center">Total amount</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
<!--                <td>--><?php //= $count ?><!--</td>-->
                <td><?= $row['orderId'] ?></td>
                <td><?= date('F j, y', strtotime($row['orderDate'])) ?></td>
                <td><?= moneyFormatIndia($row['totalAmount'], 2) ?></td>
                <td><a href="order.php?id=<?= $row['orderId'] ?>">View</a></td>
            </tr>
        <?php
        $count++;
        endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

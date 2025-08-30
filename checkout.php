<!DOCTYPE html>
<?php
include("includes/config.php");

// Calculate line totals in SQL query
$sql = "SELECT 
    A.productId, 
    A.qty, 
    B.name, 
    B.price,
    (A.qty * B.price) as line_total 
    FROM cart A 
    INNER JOIN products B ON A.productId = B.id 
    WHERE A.userId = " . $_SESSION['userId'];
$result = mysqli_query($conn, $sql);

// Calculate total in SQL
$totalSql = "SELECT SUM(A.qty * B.price) as total 
    FROM cart A 
    INNER JOIN products B ON A.productId = B.id 
    WHERE A.userId = " . $_SESSION['userId'];
$totalResult = mysqli_query($conn, $totalSql);
$totalPrice = mysqli_fetch_assoc($totalResult)['total'] ?? 0;
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
            <div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Checkout</h2></div>
            <div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-right">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td class="text-right"><?= moneyFormatIndia($row['price'], 2) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['qty']) ?></td>
                        <td class="text-right"><?= moneyFormatIndia($row['line_total'], 2) ?></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td class="text-right"><b><?= moneyFormatIndia($totalPrice, 2) ?></b></td>
                </tr>
            </tbody>
        </table>
        <form action="placeOrder.php" method="POST" style="text-align: right;">
            <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
            <input type="hidden" name="totalAmount" value="<?= $totalPrice ?>">
            <button type="submit" class="btn btn-primary tm-checkout-btn" style="
                margin-top: 20px;
                padding: 12px 35px;
                font-size: 18px;
                background-color: #FCDD44;
                color: #000;
                border: none;
                border-radius: 30px;
                font-weight: 600;
                text-transform: uppercase;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                cursor: pointer;
            ">
                Confirm Order
            </button>
        </form>
    </div>
</body>
</html>

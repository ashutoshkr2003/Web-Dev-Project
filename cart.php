<!DOCTYPE html>
<?php
include("includes/config.php")
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
    <script src="common.js"></script>
    <script>
        $(document).ready(function() {
            getCart("<?=$_SESSION['userId']?>");
        });
    </script>
</head>
<body class="tm-gray-bg">

<style>
    
    /* Add responsive styles */
    @media (max-width: 768px) {
        .tm-about-box-2 .row {
            height: auto !important;
            padding: 15px;
        }
        
        .tm-about-box-2 .col-lg-4 {
            width: 100%;
            margin-bottom: 15px;
        }
        
        .tm-about-box-2 .col-lg-5 {
            width: 100%;
            padding: 0 15px;
        }
        
        .tm-about-box-2 .col-lg-3 {
            width: 100%;
            text-align: left;
            padding: 15px;
        }
        
        .tm-about-box-2-img {
            max-height: 200px;
            width: 100% !important;
            object-fit: cover;
        }
        
        .tm-about-box-2-text {
            padding: 15px 0;
        }
    }
    

</style>
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

<script>
    function addClassOnLoad(elementSelector, className) {
        window.addEventListener('load', () => {
            const element = document.querySelector(elementSelector);
            if (element) {
                element.classList.add(className);
            } else {
                console.error(`Element with selector "${elementSelector}" not found.`);
            }
        });
    }
    addClassOnLoad('#cartLink', 'active');

</script>

<?php
$userId = $_SESSION['userId'];
$sql = "SELECT A.productId,A.qty,B.name,B.man,B.img,B.price FROM cart A INNER JOIN products B ON A.productId=B.id WHERE A.userId=$userId";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num == 0) {?>
<h2 class="tm-section-title" style="margin-top: 100px; margin-bottom: 20px">Cart empty!</h2>
    <?php
} else {
    ?>

<!-- white bg -->
<section class="tm-white-bg section-padding-bottom" style="margin-top: 40px">
    <div class="container">
        <div class="row">
            <div class="tm-section-header section-margin-top">
                <div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
                <div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">Cart</h2></div>
                <div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
            </div>
        </div>
        <div class="row">
            <!-- Testimonial -->
            <div class="col-lg-12">
                <div class="tm-what-we-do-right" style="min-width: 100% !important;">
                    <?php
                    $totalPrice = 0;
                    for ($i = 0; $i < $num; $i++){
                        $row = mysqli_fetch_assoc($result);
                        $pid = $row['productId'];
                        $name = $row['name'];
                        $manufacturer = $row['man'];
                        $img = $row['img'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $totalPrice += $price * $qty;
                    ?>
                    <div class="tm-about-box-2" style="padding-bottom: 25px" ">
                        <div class="row" style="height: 120px">
                            <div class="col-lg-4" style="height: 100%; width: 220px">
                                <img src="img/products/<?=$img?>" alt="image" class="tm-about-box-2-img" style="object-fit: cover; height: 100%; width: 100%">
                            </div>
                            <div class="col-lg-5" style="display: flex; flex-direction: column;">
                                <div class="tm-about-box-2-text" style="min-width: 100% !important">
                                    <h3 class="tm-about-box-2-title"><?=$name?></h3>
                                    <p class="tm-about-box-2-description gray-text"><?=$manufacturer?></p>
                                    Qty: <input id="qty-<?=$pid?>" type="number" min="0" max="100" step="1" value="<?=$qty?>">
                                    <button onclick="updateQty('<?=$userId?>','<?=$pid?>')">Update</button>
                                    <div class="row" style="position: absolute">
                                        <div class="col-lg-12">
                                            <a href="removeItem.php?pID=<?=$pid?>" style="color: darkred"><p class="tm-about-box-2-footer">Remove</p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h4 style="text-align: right" id="total-price-<?=$pid?>"><?=$price*$qty?></h4>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                <div class="col-lg-12" style="text-align: right">
                    <h3>Total amount:</h3>
                    <h4 id="total-amount"><?=$totalPrice?></h4>
                    <button onclick="window.location.href='checkout.php'" class="btn btn-primary tm-checkout-btn" style="
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
                        Proceed to Checkout
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
}
?>
<footer class="tm-black-bg main-footer">
    <div class="container">
        <div class="row">
            <p class="tm-copyright-text">Copyright &copy; 2024 Digital Enigma</p>
        </div>
    </div>
</footer>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>			<!-- flexslider js -->
<script type="text/javascript" src="js/templatemo-script.js"></script>      		<!-- Templatemo Script -->
<script>
    $(function() {

        // https://css-tricks.com/snippets/jquery/smooth-scrolling/
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    $(window).load(function(){
        // Flexsliders
        $('.flexslider.flexslider-banner').flexslider({
            controlNav: false
        });
        $('.flexslider').flexslider({
            animation: "slide",
            directionNav: false,
            slideshow: false
        });
    });
</script>
</body>
</html>

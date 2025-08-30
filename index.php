<!DOCTYPE html>
<?php
include("includes/config.php");
$pass = isset($_SESSION['passLogin']) ? $_SESSION['passLogin'] : '';
if ($pass == 'true')
{
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
                          <li><a href="index.php" class="active">Home</a></li>
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
      // Add delay for dropdown hover
      let dropdown = document.querySelector('.dropdown');
      let timer;

      // Show dropdown on hover
      dropdown.addEventListener('mouseover', function () {
          clearTimeout(timer);
          dropdown.querySelector('.dropdown-menu').style.display = 'block';
      });

      // Hide dropdown on mouse leave after a short delay
      dropdown.addEventListener('mouseleave', function () {
          timer = setTimeout(function () {
              dropdown.querySelector('.dropdown-menu').style.display = 'none';
          }, 300); // Adjust the delay (in milliseconds) as needed
      });

  </script>
	
	<!-- Banner -->
	<section class="tm-banner" style="margin-top: 80px">
		<!-- Flexslider -->
		<div class="flexslider flexslider-banner">
		  <ul class="slides">
            <li>
                <div class="tm-banner-inner">
                    <a href="products.php?type=sports&search=football" class="tm-banner-link">Shop now</a>
                </div>
                <img src="img/banners/rugby.jpg" />
            </li>
              <li>
                  <div class="tm-banner-inner">
                      <a href="products.php" class="tm-banner-link" style="margin-bottom: -172px; margin-left: 62px;">Shop now</a>
                  </div>
                  <img src="img/banners/sale.jpg"/>
              </li>
		  </ul>
		</div>			
	</section>
	<section class="container tm-home-section-1" id="more">
		<div class="row">

            <?php
            $sql = "SELECT DISTINCT type FROM `products`";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);


            for ($i = 0; $i < $num; $i++) {
                $result1 = mysqli_fetch_assoc($result);
                $type = $result1["type"];
                $chosenColor = $i % 3;
                $color = '';

                switch ($chosenColor) {
                    case 0:
                        $color = 'red';
                        break;
                    case 1:
                        $color = 'green';
                        break;
                    case 2:
                        $color = 'yellow';
                        break;
                }
            ?>
            <div class="col-lg-4 col-md-4 col-sm-6" style="margin-top: 75px">
                <div class="tm-home-box-1 tm-home-box-1-2 tm-home-box-1-center">
                    <img src="img/products/categories/<?=$type?>.jpg" alt="image" class="img-responsive"
                    style="object-fit: cover; height: 180px; width: 100%;">
                    <a href="products.php?type=<?=$type?>">
                        <div class="tm-<?=$color?>-gradient-bg tm-city-price-container">
                            <span><?= $type ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            }
            ?>
		</div>
	</section>		

	<footer class="tm-black-bg main-footer">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2024 Digital Enigma</p>
			</div>
		</div>		
	</footer>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
  	<script type="text/javascript" src="js/moment.js"></script>							<!-- moment.js -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>	<!-- bootstrap date time picker js, http://eonasdan.github.io/bootstrap-datetimepicker/ -->
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
   	<script type="text/javascript" src="js/templatemo-script.js"></script>      		<!-- Templatemo Script -->
	<script>
		// HTML document is loaded. DOM is ready.
		$(function() {

			$('#hotelCarTabs a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			})

        	$('.date').datetimepicker({
            	format: 'MM/DD/YYYY'
            });
            $('.date-time').datetimepicker();
           
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
		
		// Load Flexslider when everything is loaded.
		$(window).load(function() {	  		
		    $('.flexslider').flexslider({
			    controlNav: false
		    });
	  	});
	</script>
 </body>
 </html>
<?php
}
else
{
    header("Location: login.php");
}
?>
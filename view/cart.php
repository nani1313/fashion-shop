



<?php
session_start();

// var_dump($users);
if (!isset($_GET['id_product'])){
    echo '<script type="text/javascript">
        window.onload = function() {
          alert("You need to choose product first to check out! Click here to shop.");
          window.location.href = "category.php";
        }
      </script>';
	
} 

$errors = [];
$customer = "";
$quantity = "";
$total_price ="";
$payment_method = "";

// Kiểm tra nếu có dữ liệu gửi từ form
if (!empty($_POST)) {
    // Lấy dữ liệu từ form
    $customer = $_SESSION['name'];
    $quantity = $_POST['quantity'];
    $payment_amount = $_POST['payment_amount'];
    $payment_method = $_POST['payment_method'];

    // Lấy ngày hiện tại
    $current_date = date("Y-m-d H:i:s");

    // Chuẩn bị dữ liệu để thêm vào cơ sở dữ liệu
    $customer = trim($customer);
    $customer = htmlspecialchars($customer);

    $quantity = trim($quantity);
    $quantityt = htmlspecialchars($quantity);

    $payment_amount = trim($payment_amount);
    $payment_amount = htmlspecialchars($payment_amount);

    $payment_method = trim($payment_method);
    $payment_method = htmlspecialchars($payment_method);

    // Nếu không có lỗi
    if (empty($errors)) {
        // Kết nối đến cơ sở dữ liệu
        include('../auth/connect.php');

        // Thêm dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO `orders` (`id_order`, `customer`, `order_date`, `total_order_amount`, `payment_date`, `payment_amount`, `payment_method`) 
                VALUES (NULL, '$customer', '$current_date', '$quantity', '$current_date', '$payment_amount', '$payment_method');";
        $result = mysqli_query($conn, $sql);

        // Đóng kết nối
        mysqli_close($conn);

        // Chuyển hướng người dùng sau khi thêm đơn hàng thành công
        header('Location: main.php?message=Created successfully');
        exit(); // Đảm bảo kết thúc quá trình thực thi của script sau khi chuyển hướng
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Fashion shop</title>
	<link rel="icon" href="../img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  

</head>
<body>
  <!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="main.php"><img src="../img/name.png" alt="" style="width:200px;height:45px"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item active"><a class="nav-link" href="main.php">Home</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Shop</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="category.php">Shop Category</a></li>
                  <li class="nav-item"><a class="nav-link" href="single-product.php">Product Details</a></li>
                </ul>
							</li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Blog</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                  <li class="nav-item"><a class="nav-link" href="single-blog.php">Blog Details</a></li>
                </ul>
							</li>
              <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>

            <ul class="nav-shop">
              <li class="nav-item"><button><i class="ti-search"></i></button></li>
              <li class="nav-item"><a class="nav-link active" href="cart.php"><button><i class="ti-shopping-cart"></i></button></a> </li>
              <li><?php
            // Hiển thị thông tin lưu trong Session
            // phải kiểm tra có tồn tại không trước khi hiển thị nó ra
            if (isset($_SESSION['name']))
            {       
                  echo "<li class='nav-item submenu dropdown'>";
                  echo "<a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
        <i class='bi bi-person'></i> " . $_SESSION['name'] . "
      </a>";
                  echo "<ul class='dropdown-menu'>";
                    echo "<li class ='nav-item'><a class ='nav-link' href = '../control/logout.php'>Log out</a></li>";
                    echo '</ul>';
                    echo '</li>';
            } else{

                echo '<li class="nav-item">';
                    echo "<a class='button button-header' href='login.php'>Log in</a></i>";
                    echo '</li>';
            }
            ?></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Shopping Cart</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  

  <!--================Cart Area =================-->
  <form action = "cart.php" method="post">
    <?php
    
if (!isset($_GET['id_product'])){
	header('Location:category.php');
}


$id = $_GET['id_product'];

include('../auth/required-login.php');
include ('../auth/connect.php');

// Kiểm tra xem biến $quantity đã được khởi tạo chưa
if (isset($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']);
} else {
    // Nếu chưa, gán giá trị mặc định là 1
    $quantity = 1;
}
// get all product
$sql = "SELECT * FROM product WHERE id_product = '$id'";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_assoc($result);
// free memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src="<?php echo $products['product_image'];?>" alt="" width="100" height="150">
                                      </div>
                                      <div class="media-body">
                                          <p><?php echo $products['product_name'];?></p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5><?php echo $products['product_price'];?> VND</h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="text" name="quantity" id="sst" maxlength="12" value="<?php echo $quantity; ?>" title="Quantity:"
                                          class="input-text qty">
                                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                          class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;"
                                          class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                  </div>
                              </td>
                              <td name = "payment_amount">
                              <?php
                                 $total_price = $products['product_price'];
                                 ?>
                                <h5><?php echo $total_price;?></h5>
                              </td>
                          </tr>
                        
                          <tr class="bottom_button">
                              <td>
                                  <a class="button" href="#">Update Cart</a>
                              </td>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="cupon_text d-flex align-items-center">
                                      <input type="text" placeholder="Coupon Code">
                                      <a class="primary-btn" href="#">Apply</a>
                                      <a class="button" href="#">Have a Coupon?</a>
                                  </div>
                              </td>
                          </tr>
                          <tr>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Subtotal</h5>
                              </td>
                              <td name = "total_price">
                                  <h5><?php echo $total_price;?></h5>
                              </td>
                          </tr>
                          <tr class="shipping_area">
                              <td class="d-none d-md-block">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Shipping</h5>
                              </td>
                              <td>
                                  <div class="shipping_box">
                                      <ul class="list">
                                          <li class ="active "><a href="#">Free Shipping</a></li>
                                      </ul>
                                      <h6>Payment method<i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                      <select class="shipping_select" value = "<?php echo $payment_method;?>" name = "payment_method">
                                          <option value="Cash">Cash</option>
                                          <option value="Debit/Credit card">Debit/Credit card</option>
                                      </select>
                                      <a class="gray_btn" href="#">Update Details</a>
                                  </div>
                              </td>
                          </tr>
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>
                              <td class="">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-left">
                                  <?php
if (isset($_POST['username']))
{
    // Lưu Session
    $_SESSION['name'] = $_POST['username'];
}




if (!isset($_SESSION['name']))
:
        echo '<div>';
        echo '<button class="btn btn-primary w-100 py-3" type="submit" id = "submit">Check out</button>';
        echo '<script type="text/javascript">
        window.onload = function() {
          alert("You need to Login first to take a reservation! Click here to login.");
          window.location.href = "login.php";
        }
      </script>';
        echo '</div>';

?>
<?php else: ?>
        <button class="btn btn-primary w-100 py-3" type="submit">Check out</button> 

<?php endif ?>





                                </div>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  </form>
  <!--================End Cart Area =================-->



 
  <!--================ Start footer Area  =================-->	
  <footer class="footer">
		<div class="footer-area">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title large_title">Our Mission</h4>
							<p>
              At Fashion Shop, our mission is to empower individuals through fashion by offering stylish, 
              high-quality, and affordable clothing that inspires confidence and self-expression. 
							</p>
							<p>
              We are committed to sustainable practices, fostering a diverse and inclusive community, and providing exceptional customer service.
							</p>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
              <li><a href="main.php">Home</a></li>
								<li><a href="category.php">Shop</a></li>
								<li><a href="blog.php">Blog</a></li>
								<li><a href="single-product.php">Product</a></li>
								<li><a href="confirmation.php">Brand</a></li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget instafeed">
							<h4 class="footer_title">Gallery</h4>
							<ul class="list instafeed d-flex flex-wrap">
								<li><img src="../img/gallery/r1.jpg" alt=""></li>
								<li><img src="../img/gallery/r2.jpg" alt=""></li>
								<li><img src="../img/gallery/r3.jpg" alt=""></li>
								<li><img src="../img/gallery/r5.jpg" alt=""></li>
								<li><img src="../img/gallery/r7.jpg" alt=""></li>
								<li><img src="../img/gallery/r8.jpg" alt=""></li>
							</ul>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Contact Us</h4>
							<div class="ml-40">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>1 Trịnh Văn Bô, Hà Nội</p>
	
								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
									+123 456 7890 <br>
									+123 456 7890
								</p>
	
								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
									Group7@gmail.com <br>
									Fashionshop@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->


  <script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../vendors/skrollr.min.js"></script>
  <script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="../vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="../vendors/jquery.ajaxchimp.min.js"></script>
  <script src="../vendors/mail-script.js"></script>
  <script src="../js/main.js"></script>
</body>
</html>
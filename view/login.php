<?php
session_start(); // <- whenever using session

// initial data
$errors = [];
$username = "";
$password = "";

// check if GET data
if (!empty($_POST)) {
    // get user data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // clean data
    $username = trim($username);
    $username = htmlspecialchars($username);

    $password = trim($password);
    $password = htmlspecialchars($password);

    // validate data
    if (empty($username)) {
        $errors['username'] = 'Username must not be empty';
    }
    // TODO: username already exists?   

    if (empty($password)) {
        $errors['password'] = 'Password must not be empty';
    }


    // if no errors
    if (empty($errors)) {
        /* get user by username */
        // connect db
        include('../auth/connect.php');

        // query
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        // fetch result
        $user = mysqli_fetch_assoc($result);

        // clean
        mysqli_free_result($result);
        // close
        mysqli_close($conn);



        // if not exist
        if($user == null) {
            // error – invalid username
              $errors['username'] = 'Username not exists';
        } else {
            // hash password
           // $hashedPassword = sha1($password);

            // if user password != password
            if ($user['password'] != $password) {
                // error – invalid password
                echo '<script type="text/javascript">
                    window.onload = function() {alert ("Login Fail!");}
                </script>';
                $errors['password'] = 'Incorrect password';
            } else {
                // create session with id
              $_SESSION['_id'] = $user['id'];
              $_SESSION['name'] = $user['username'];
              

//check the role
$role = $user['role'];


if ($role == 'admin') {
  // redirect to view 
  header('Location: ../control/index.php');
} else {
  header('Location: main.php?message=Login Successfully');
  
}
            }
        }
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
              <li class="nav-item"><a class="nav-link" href="main.php">Home</a></li>
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
              <li class="nav-item"><a class="nav-link" href="cart.php"><button><i class="ti-shopping-cart"></i></button></a> </li>
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
					<h1>Login / Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Login/Register</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="register.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="login.php" id="contactForm" method="POST">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="username" name="username" >
                <?php if (isset($errors['username'])): ?>
                <p class="text-danger"><?php echo $errors['username']; ?></p>
            <?php endif; ?>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password">
                <?php if (isset($errors['password'])): ?>
                <p class="text-danger"><?php echo $errors['password']; ?></p>
            <?php endif; ?>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Log In</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->



  <!--================ Start footer Area  =================-->	
	<footer>
		<div class="footer-area footer-only">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets ">
							<h4 class="footer_title large_title">Our Mission</h4>
							<p>
                At Fashion Shop, our mission is to empower individuals through fashion by offering stylish, high-quality, and affordable clothing that inspires confidence and self-expression. 
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
								<li><a href="#">Home</a></li>
								<li><a href="#">Shop</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Product</a></li>
								<li><a href="#">Brand</a></li>
								<li><a href="#">Contact</a></li>
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
								<p>1 Trinh Văn Bô, Hà Nội</p>
	
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
									group7@gmail.com <br>
									fashionshop@gmail.com
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
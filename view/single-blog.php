<?php
session_start();
if (isset($_POST['username']))
{
    // Lưu Session
    $_SESSION['name'] = $_POST['username'];
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
              <li class="nav-item active submenu dropdown">
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
	<section class="blog-banner-area" id="blog">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Blog Details</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->



  <!--================Blog Area =================-->
	<section class="blog_area single-post-area py-80px section-margin--small">
			<div class="container">
					<div class="row">
							<div class="col-lg-8 posts-list">
									<div class="single-post row">
											<div class="col-lg-12">
													<div class="feature-img">
															<img class="img-fluid" src="../img/blog/feature-img1.jpg" alt="">
													</div>
											</div>
											<div class="col-lg-3  col-md-3">
													<div class="blog_info text-right">
															<div class="post_tag">
																	<a href="#">Food,</a>
																	<a class="active" href="#">Technology,</a>
																	<a href="#">Politics,</a>
																	<a href="#">Lifestyle</a>
															</div>
															<ul class="blog_meta list">
																	<li>
																			<a href="#">Mark wiens
																					<i class="lnr lnr-user"></i>
																			</a>
																	</li>
																	<li>
																			<a href="#">12 Dec, 2017
																					<i class="lnr lnr-calendar-full"></i>
																			</a>
																	</li>
																	<li>
																			<a href="#">1.2M Views
																					<i class="lnr lnr-eye"></i>
																			</a>
																	</li>
																	<li>
																			<a href="#">06 Comments
																					<i class="lnr lnr-bubble"></i>
																			</a>
																	</li>
															</ul>
															<ul class="social-links">
																	<li>
																			<a href="#">
																					<i class="fab fa-facebook-f"></i>
																			</a>
																	</li>
																	<li>
																			<a href="#">
																				<i class="fab fa-twitter"></i>																				
																			</a>
																	</li>
																	<li>
																			<a href="#">
																				<i class="fab fa-github"></i>																				
																			</a>
																	</li>
																	<li>
																			<a href="#">
																				<i class="fab fa-behance"></i>																				
																			</a>
																	</li>
															</ul>
													</div>
											</div>
											<div class="col-lg-9 col-md-9 blog_details">
													<h2>Astronomy Binoculars A Great Alternative</h2>
													<p class="excert">
													High fashion is the style of a small group of men and women with a certain taste and authority in the fashion world. 
													People of wealth and position, buyers for major department stores, editors and writers for fashion magazines are all part of Haute Couture ("High Fashion" in French). 
													Some of these expensive and often artistic fashions may triumph and become the fashion for the larger majority. Most stay on the runway.
													</p>
													<p>
													Popular fashions are close to impossible to trace. No one can tell how the short skirts and boots worn by teenagers in England in 1960 made it to the runways of Paris, 
													or how blue jeans became so popular in the U.S., or how hip-hop made it from the streets of the Bronx to the Haute Couture fashion shows of London and Milan.
													</p>
													<p>
													It's easy to see what's popular by watching sit-coms on television: the bare mid-riffs and athletic clothes of 90210, the baggy pants of The Fresh Prince of Bel-Air.
													 But the direction of fashion relies on "plugged-in" individuals to react to events, and trends in music, art and books.
													</p>
											</div>
											<div class="col-lg-12">
													<div class="quotes">
													"In the perspective of costume history, it is plain that the dress of any given period is exactly suited to the actual climate of the time." according to James Laver, a noted English costume historian. 
														How did bell-bottom jeans fade into the designer jeans and boots look of the 1980s into the baggy look of the 1990s? Nobody really knows
													</div>
													<div class="row">
															<div class="col-6">
																	<img class="img-fluid" src="../img/blog/post-img1.jpg" alt="">
															</div>
															<div class="col-6">
																	<img class="img-fluid" src="../img/blog/post-img2.jpg" alt="">
															</div>
															<div class="col-lg-12 mt-4">
																	<p>
																	Back by popular demand! The 2024 spring capsule wardrobe is here! Thank you for being patient while I fine-tuned the selected items. If you've been following me for a while you know I've been creating capsule wardrobes for years. 
																	I started this collage-style format back Fall 2021 (in 2019 I was shooting pictures of me in each look) and over the past few seasons you guys have requested the looks to be photographed on me again. 
																	So I'm kicking off the spring capsule with collage-style ideas AND outfits styled on myself. I will continue to shoot more spring capsule looks from here out and add to my daily looks, LTK, and this post. So make sure you are checking back for updates.

																	</p>
																	<p>
																	Further, since I have been creating these capsules for a few years, by now you all should have a good wardrobe foundation of essentials. Some of the pieces featured in Fall 2021 are still on a weekly rotation for me. Those pieces should be mixed in with the new spring capsule items. Consider those your core items.
																	The capsule pieces are now to be used to sprinkle in and make your closet feel current, updated, and fresh. There are ways to mix in these new pieces with the core items you have in your close that still feel YOU. For example the vest is making a big come back this year and not everyone will style the same. 
																	I'm showing you how I would personally style the vest for spring, but you may want to style it with your fool-proof denim and favorite heels and that's EXACTLY what you should do.
																	At the end of this post you can find last year's spring capsule, which in my opinion, has a lot of great core pieces. I will be working on a master blog post that has all closet essentials (core items) for you to refer back to. Either for building a strong wardrobe or looking to update some items. The goal is for these posts to be a resource for you when it comes to how to get dressed for the spring season, what outfits to pack for spring travel, and how to feel confident in creating updated outfits using pieces you already feel confident in.
																	</p>
															</div>
													</div>
											</div>
									</div>
									
									
									<div class="comments-area">
											<h4>03 Comments</h4>
											<div class="comment-list">
													<div class="single-comment justify-content-between d-flex">
															<div class="user justify-content-between d-flex">
																	<div class="thumb">
																			<img src="../img/blog/c1.jpg" alt="">
																	</div>
																	<div class="desc">
																			<h5>
																					<a href="#">Emilly Blunt</a>
																			</h5>
																			<p class="date">December 4, 2023 at 3:12 pm </p>
																			<p class="comment">
																					It makes me slay everyday!
																			</p>
																	</div>
															</div>
															<div class="reply-btn">
																	<a href="#" class="btn-reply text-uppercase">reply</a>
															</div>
													</div>
											</div>
											<div class="comment-list left-padding">
													<div class="single-comment justify-content-between d-flex">
															<div class="user justify-content-between d-flex">
																	<div class="thumb">
																			<img src="../img/blog/c2.jpg" alt="">
																	</div>
																	<div class="desc">
																			<h5>
																					<a href="#">Elsie Cunningham</a>
																			</h5>
																			<p class="date">December 13, 2023 at 1:12 pm </p>
																			<p class="comment">
																					It's really difficult to match clothes...
																			</p>
																	</div>
															</div>
															<div class="reply-btn">
																	<a href="#" class="btn-reply text-uppercase">reply</a>
															</div>
													</div>
											<div class="comment-list">
													<div class="single-comment justify-content-between d-flex">
															<div class="user justify-content-between d-flex">
																	<div class="thumb">
																			<img src="../img/blog/c4.jpg" alt="">
																	</div>
																	<div class="desc">
																			<h5>
																					<a href="#">Maria Luna</a>
																			</h5>
																			<p class="date">December 4, 2017 at 3:12 pm </p>
																			<p class="comment">
																					Never say goodbye till the end comes!
																			</p>
																	</div>
															</div>
															<div class="reply-btn">
																	<a href="#" class="btn-reply text-uppercase">reply</a>
															</div>
													</div>
											</div>
			
									</div>
									<div class="comment-form">
											<h4>Leave a Reply</h4>
											<form>
													<div class="form-group form-inline">
															<div class="form-group col-lg-6 col-md-6 name">
																	<input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
															</div>
															<div class="form-group col-lg-6 col-md-6 email">
																	<input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
															</div>
													</div>
													<div class="form-group">
															<input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
													</div>
													<div class="form-group">
															<textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"
																	required=""></textarea>
													</div>
													<a href="#" class="button button-postComment button--active">Post Comment</a>
											</form>
									</div>
							</div>
					</div>
			</div>
	</section>
	<!--================Blog Area =================-->
  

  <!--================ Start footer Area  =================-->	
	<footer>
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
								<p>1 Trịnh VĂn Bô, Hà Nội</p>
	
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
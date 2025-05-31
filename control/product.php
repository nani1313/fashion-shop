<?php
session_start();

include('../auth/required-login.php');
include('../auth/required-admin.php');


$product_name = "";

include ('../auth/connect.php');

// get all users
$sql = "SELECT * FROM product";

// filter by username
if (isset($_GET['product_name'])) {
    $product_name = $_GET['product_name'];

    $sql .= " WHERE product_name LIKE '%$product_name%'";
}

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_all($result, MYSQLI_ASSOC);
// var_dump($users);

// free memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>
 
<!-- uc: view all users -->
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
	<link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    	<!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="../view/main.php"><img src="../img/name.png" alt="" style="width:200px;height:45px"></a> 
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button> 
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
            <li class="nav-item" ><a class="nav-link" href="../view/main.php">Home</a></li>
              <li class="nav-item " ><a class="nav-link" href="index.php">User</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Create</a>
                <ul class="dropdown-menu">
                  <li class="nav-item "><a class="nav-link" href="create.php">New user</a></li>
                  <li class="nav-item"><a class="nav-link" href="create_product.php">New product</a></li>
                </ul>
				      </li>
              <li class="nav-item active"><a class="nav-link" href="product.php">Products</a></li>
              <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
            </ul>

            <ul class="nav-shop">
              <li><?php
            // Hiển thị thông tin lưu trong Session
            // phải kiểm tra có tồn tại không trước khi hiển thị nó ra
            if (isset($_SESSION['name']))
            {
              
                    echo '<div class="nav-item d-inline-flex align-items-center">';
                    echo '<i class="bi bi-person-square"></i>';
                     echo "<a class=' nav-link ms-2' >". $_SESSION['name'] ."</a>";
                    echo '</div>';
            } else{

                echo '<div class="nav-item dropdown">';
                    echo "<i  href='#' class='nav-link dropdown-toggle bi bi-person-circle' data-bs-toggle='dropdown'  '></i>";
                    echo '<div class="dropdown-menu m-0">';
                        echo '<a href="signup.php" class="dropdown-item">Sign up</a>';
                        echo '<a href="login.php" class="dropdown-item">Log in</a>   ';
                    echo '</div>';
            }
            ?></li>
              <li class="nav-item"><a class="button button-header" href="logout.php">Log out</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->
 
    <div class="container-xxl py-5">
    <div class="container my-4 py-4">
    <?php if (isset($_GET['message'])): ?>
        <p class="text-success"><?php echo $_GET['message']; ?></h2>
    <?php endif; ?>

    <h1>All products</h1>
    
    

    <br />
    <form action="product.php" method="get" class="row g-3">
    
    <div class="col-auto">
    <input type="text" class="form-control" id="search" placeholder="Search by product name..." value="<?php echo $product_name; ?>" >
    </div>
   
    <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Search</button>
    </div>
   
    </form>
    <br />
    <?php if (empty($product)) : ?>
        <p><em>No data.</em></p>
    <?php else : ?>
        <table class="table table-striped" border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Product name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($product as $all_product) : ?>
                <tr>
                    <td><?php echo $all_product['id_product']; ?></td>
                    <td><?php echo $all_product['product_name']; ?></td>
                    <td><?php echo $all_product['product_description']; ?></td>
                    <td><?php echo $all_product['product_price']; ?></td>
                    <td width="200">
                        <img class="img-fluid" src="<?php echo $all_product['product_image']; ?>">
                    </td>
                    <td><?php echo $all_product['product_category']; ?></td>
                    <td><?php echo $all_product['stock_quantity']; ?></td>
                    <td><?php echo $all_product['product_status']; ?></td>
                    <td>
                        <a href="update_product.php?id_product=<?php echo $all_product['id_product']; ?>">Update</a>

                        <form action="delete_product.php?id_product=<?php echo $all_product['id_product']; ?>" method="post">
                            <button type="submit"
                               onclick = "return confirm('You have just clicked on delete button. Are you sure about that?');"
                            >Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
            </div>
    </div>
</body>
<footer>
<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
				</div>
			</div>
		</div>
	</footer>

</html>
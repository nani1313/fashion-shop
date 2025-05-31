<?php
session_start();

include('../auth/required-login.php');

// Kết nối cơ sở dữ liệu
include('../auth/connect.php');

// Lấy ID người dùng từ URL và kiểm tra tính hợp lệ
$id_product = isset($_GET['id_product']) ? intval($_GET['id_product']) : null;

if ($id_product) {
    // Truy vấn người dùng theo ID
    $sql = "SELECT * FROM product WHERE id_product=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
    $result = $stmt->get_result();
    $all_product = $result->fetch_assoc(); // null nếu không tìm thấy

    // Giải phóng bộ nhớ
    $stmt->free_result(); 
    $stmt->close();

    // Kiểm tra nếu người dùng tồn tại
    if ($all_product) {
        // Dữ liệu ban đầu
        $errors = [];
        $product_name = $all_product['product_name'];
        $product_description = $all_product['product_description']; 
        $product_price = $all_product['product_price'];
        $product_category = $all_product['product_category'];
        $stock_quantity = $all_product['stock_quantity'];
        $product_status = $all_product['product_status'];
        
    } else {
        die("Sản phẩm không tồn tại.");
    }
} else {
    die("ID không hợp lệ.");
}

// Kiểm tra nếu có dữ liệu POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_product']) && isset($_POST['product_name']) && isset($_POST['product_description']) && isset($_POST['product_price']) && isset($_POST['product_category'] ) && isset($_POST['stock_quantity']) && isset($_POST['product_status'])) {
        // Lấy và kiểm tra ID từ POST
        $id_product = intval($_POST['id_product']);
        if ($id_product <= 0) {
            die("ID không hợp lệ.");
        }

        // Dữ liệu người dùng POST
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description']; 
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $stock_quantity = $_POST['stock_quantity'];
    $product_status = $_POST['product_status'];

      // clean data
	$product_name = trim($product_name);
    $product_name = htmlspecialchars($product_name);

    $product_description = trim($product_description);
    $product_description = htmlspecialchars($product_description);

    $product_price = trim($product_price);
    $product_price = htmlspecialchars($product_price);

	$product_category = trim($product_category);
    $product_category = htmlspecialchars($product_category);

    $stock_quantity = trim($stock_quantity);
    $stock_quantity = htmlspecialchars($stock_quantity);

    $product_status = trim($product_status);
    $product_status = htmlspecialchars($product_status);

            // validate data
    $errors = [];
	if (empty($product_name)) {
        $errors['product_name'] = 'Full name must not be empty';
    }

    if (empty($product_description)) {
        $errors['product_description'] = 'Description must not be empty';
    }

	if (empty($product_price)) {
        $errors['product_price'] = 'Price must not be empty';
    }

	if (empty($product_category)) {
        $errors['product_category'] = 'Category must not be empty';
    }

    if (empty($stock_quantity)) {
        $errors['stock_quantity'] = 'Stock quantity must not be empty';
    }

    if (empty($product_status)) {
        $errors['product_status'] = 'Status must not be empty';
    }


       // Kiểm tra lỗi trước khi cập nhật
if (empty($errors)) {
    // Kết nối cơ sở dữ liệu
    include('../auth/connect.php');

    // Cập nhật cơ sở dữ liệu
    $sql = "UPDATE `product` SET `product_name` = ?, `product_description` = ?, `product_price` = ?,  `product_category` = ?, `stock_quantity` = ?, `product_status` = ? WHERE `id_product` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $product_name, $product_description, $product_price, $product_category, $stock_quantity, $product_status, $id_product);

    if ($stmt->execute() === TRUE) {
        // Đóng kết nối
        $stmt->close();
        $conn->close();

        // Chuyển hướng đến trang xem tất cả người dùng
        header('Location: product.php?message=Updated successfully');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}
    } else {
        echo "Thiếu thông tin đầu vào";
    }
}
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
              <li class="nav-item active" ><a class="nav-link" href="index.php">User</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Create</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="create.php">New user</a></li>
                  <li class="nav-item"><a class="nav-link" href="create_product.php">New product</a></li>
                </ul>
				      </li>
              <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
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
    <h1>Update product</h1>

    <form action="" method="POST">
    <input type="hidden" name="id_product" value="<?php echo $id_product; ?>">
        <p>
            <label>Product name</label>
            <input class="form-control" type="text" name="product_name" value="<?php echo $product_name; ?>" />

            <?php if (isset($errors['product_name'])) : ?>
                <em><?php echo $errors['product_name']; ?></em>
            <?php endif; ?>
        </p>
    
        <p>
            <label>Description</label>
            <input class="form-control" type="text" name="product_description" value="<?php echo $product_description; ?>" />

            <?php if (isset($errors['product_description'])) : ?>
                <em><?php echo $errors['product_description']; ?></em>
            <?php endif; ?>
        </p>
        <p>
            <label>Price</label>
            <input  class="form-control" type="text" name="product_price" value="<?php echo $product_price; ?>" />

            <?php if (isset($errors['product_price'])) : ?>
                <em><?php echo $errors['product_price']; ?></em>
            <?php endif; ?>
        </p>
        <p>
            <label>Category</label>
            <select class="form-control" name="product_category">
            <option value="">Select a category</option>
            <option value="Woman" <?php echo ($product_category === 'Woman') ? 'selected' : ''; ?>>Woman</option>
            <option value="Man" <?php echo ($product_category === 'Man') ? 'selected' : ''; ?>>Man</option>
            <option value="Kid" <?php echo ($product_category === 'Kid') ? 'selected' : ''; ?>>Kid</option>
            <option value="Accessories" <?php echo ($product_category === 'Accessories') ? 'selected' : ''; ?>>Accessories</option>
        </select>
        <?php if (isset($errors['product_category'])) : ?>
            <em><?php echo $errors['product_category']; ?></em>
        <?php endif; ?>
        </p>
        <p>
            <label>Stock quantity</label>
            <input class="form-control" type="text" name="stock_quantity" value="<?php echo $stock_quantity; ?>" />

            <?php if (isset($errors['stock_quantity'])) : ?>
                <em><?php echo $errors['stock_quantity']; ?></em>
            <?php endif; ?>
        </p>
        <p>
            <label>Status</label>
            <select class="form-control" name="product_status">
            <option value="">Select a status</option>
            <option value="Available" <?php echo ($product_status === 'Available') ? 'selected' : ''; ?>>Available</option>
            <option value="Unavailable" <?php echo ($product_status === 'Unavailable') ? 'selected' : ''; ?>>Unavailable</option>
        </select>
        <?php if (isset($errors['product_status'])) : ?>
            <em><?php echo $errors['product_status']; ?></em>
        <?php endif; ?>
        </p>

        <p>
            <button class="btn btn-primary mb-3" type="submit">Update</button>
        </p>
    </form>

</body>

</html>
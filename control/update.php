<?php
session_start();

include('../auth/required-login.php');

// Kết nối cơ sở dữ liệu
include('../auth/connect.php');

// Lấy ID người dùng từ URL và kiểm tra tính hợp lệ
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    // Truy vấn người dùng theo ID
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // null nếu không tìm thấy

    // Giải phóng bộ nhớ
    $stmt->free_result();
    $stmt->close();

    // Kiểm tra nếu người dùng tồn tại
    if ($user) { 
        // Dữ liệu ban đầu
        $errors = [];
        $full_name = $user['full_name'];
        $username = $user['username'];
        $password = $user['password'];
        $email = $user['email'];
        $phone_number = $user['phone_number'];
    } else {
        die("Người dùng không tồn tại.");
    }
} else {
    die("ID không hợp lệ.");
}

// Kiểm tra nếu có dữ liệu POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone_number'])) {
        // Lấy và kiểm tra ID từ POST
        $id = intval($_POST['id']);
        if ($id <= 0) {
            die("ID không hợp lệ.");
        }

        // Dữ liệu người dùng POST
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone_number = $_POST['phone_number'];

        // Làm sạch dữ liệu
        $full_name = trim($full_name);
        $full_name = htmlspecialchars($full_name);

        $username = trim($username);
        $username = htmlspecialchars($username);

        $password = trim($password);
        $password = htmlspecialchars($password);

        $email = trim($email);
        $email = htmlspecialchars($email);

        $phone_number = trim($phone_number);
        $phone_number = htmlspecialchars($phone_number);

        // Xác thực dữ liệu
        $errors = [];
        if (empty($full_name)) {
            $errors['full_name'] = 'Full name must not be empty';
        }

        if (empty($username)) {
            $errors['username'] = 'Username must not be empty';
        }

        if (empty($password)) {
            $errors['password'] = 'Password must not be empty';
        }

        if (empty($email)) {
            $errors['email'] = 'Email must not be empty';
        }

        if (empty($phone_number)) {
            $errors['phone_number'] = 'Phone number must not be empty';
        }

        // Kiểm tra lỗi trước khi cập nhật
        if (empty($errors)) {
            // Kết nối cơ sở dữ liệu
            include('../auth/connect.php');

            // Cập nhật cơ sở dữ liệu
            $sql = "UPDATE `users` SET `full_name` = ?, `username` = ?, `password` = ?, `email` = ?, `phone_number` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $full_name, $username, $password, $email, $phone_number, $id);

            if ($stmt->execute() === TRUE) {
                // Đóng kết nối
                $stmt->close();
                $conn->close();

                // Chuyển hướng đến trang xem tất cả người dùng
                header('Location: index.php?message=Updated successfully');
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
    <h1>Update user</h1>

    <form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p>
            <label>Full name</label>
            <input class="form-control" type="text" name="full_name" value="<?php echo $full_name; ?>" />

            <?php if (isset($errors['full_name'])) : ?>
                <em><?php echo $errors['full_name']; ?></em>
            <?php endif; ?>
        </p>
    
        <p>
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" />

            <?php if (isset($errors['username'])) : ?>
                <em><?php echo $errors['username']; ?></em>
            <?php endif; ?>
        </p>
        <p>
            <label>Password</label>
            <input class="form-control" type="text" name="password" value="<?php echo $password; ?>" />

            <?php if (isset($errors['password'])) : ?>
                <em><?php echo $errors['password']; ?></em>
            <?php endif; ?>
        </p>
        
        <p>
            <label>Email</label>
            <input  class="form-control" type="text" name="email" value="<?php echo $email; ?>" />

            <?php if (isset($errors['email'])) : ?>
                <em><?php echo $errors['email']; ?></em>
            <?php endif; ?>
        </p>

        <p>
            <label>Phone number</label>
            <input class="form-control" type="text" name="phone_number" value="<?php echo $phone_number; ?>" />

            <?php if (isset($errors['phone_number'])) : ?>
                <em><?php echo $errors['phone_number']; ?></em>
            <?php endif; ?>
        </p>

        <p>
            <button class="btn btn-primary mb-3" type="submit">Update</button>
        </p>
    </form>

</body>

</html>
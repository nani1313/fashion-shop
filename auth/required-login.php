<?php

// require logged in
if(!isset($_SESSION['_id'])) {
    header('Location: ../view/login.php');

}

/* get user by id */
$loggedInUserId = $_SESSION['_id'];

// connect db
include ('../auth/connect.php');

// query
$sql = "SELECT * FROM users WHERE id='$loggedInUserId'";
$result = mysqli_query($conn, $sql);

// fetch
$loggedInUser = mysqli_fetch_assoc($result);

// clean & close
mysqli_free_result($result);
mysqli_close($conn);
 
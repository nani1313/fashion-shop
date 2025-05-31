<?php
session_start();

include('../auth/required-login.php');

// delete user by id
$id = $_GET['id'];

// connect to database
include('../auth/connect.php');

// update db
$sql = "DELETE FROM users WHERE `users`.`id` = '$id'";
$result = mysqli_query($conn, $sql); 

// close connection
mysqli_close($conn);

// redirect to view all users
header('Location: index.php?message=Deleted successfully');


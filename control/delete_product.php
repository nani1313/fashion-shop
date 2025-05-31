<?php
session_start();

include('../auth/required-login.php');

// Delete product by id
$id_product = $_GET['id_product'];

// Connect to database
include('../auth/connect.php');

// Update db
$sql = "DELETE FROM product WHERE id_product = '$id_product'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Redirect to view all products 
    header('Location: product.php?message=Deleted successfully');
    exit();
} else {
    // Display error message
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

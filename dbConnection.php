<?php
session_start();

//connect to database
$connection = mysqli_connect("rerun.it.uts.edu.au", "potiro", "pcXZb(kL", "poti");


if(mysqli_connect_error())
{
    die("connection has a problem...");
}

$productId = $_REQUEST['productId'];

$query = "select * from products where product_id = $productId";
$result = mysqli_query($connection,$query);


?>
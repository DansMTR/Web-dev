<?php

require_once 'product.php';
$statuse ="";
session_start();

 if ($_SERVER['REQUEST_METHOD'] === 'GET'){
       
    if (isset($_GET['status']) && $_GET['status'] === 'View Order') {
        $Product_Name = $_GET['Product_Name'];
        $Model = $_GET['model'];
        $Price = $_GET['price'];
        $Description = $_GET['description'];
        $Category = $_GET['Category'];
         $date = $_GET['date'];
         $product = new Product($Product_Name, $Price, $Model, $Description,$Category,$date);
        $statuse=$_GET['status'];
    }
   
    }

 if( isset($_SESSION['status'])&&$_SESSION['status']== "write"){
    
   $hostname = "localhost";  // This is the default hostname for a local MySQL server
$usernames = "root";
$passwords = "";
$database = "product";


// Establish a database connection
$mysqli = new mysqli($hostname, $usernames, $passwords, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$product = unserialize($_SESSION['product']);
$user = unserialize($_SESSION['user']);
$haha = $_SESSION['Idlogged'];

$name = $mysqli->real_escape_string($product->name);
$price = $product->price;
$model = $product->model;
$description = $mysqli->real_escape_string($product->description);
$datea = $mysqli->real_escape_string($product->date);
$id = $product->id;
$category = $product->category;

// Insert data into the database
 // Assuming $category contains the category table name
$query = "INSERT INTO products (Name, Price, Model, Description, datea,  idfk,Category) VALUES ('$name', $price, '$model', '$description', '$datea',$haha,'$category ')";




if ($mysqli->query($query) === true) {
    $statuse = "Product Posted Successfully";
} else {
    $statuse = "Error: " . $mysqli->error;
}

$mysqli->close();
$_SESSION['user'] = serialize($user);
unset($_SESSION['product']);
unset($_SESSION['status']);
     }

    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include '../templates/navbar.php';?>
<div class= "row">
     <?php 
     echo '<h3>'.$statuse.'</h3>'; 
  
        echo  '<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $product->name . '</h5>
                        <p class="card-text">
                            Date: ' . $product->date . '<br>
                            Model: ' . $product->model . '<br>
                            Price: ' . $product->price . '<br>
                            Description: ' . $product->description . '<br>
                            Category: ' . $product->category . '<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    ?> 
   </div>
   
</body>
</html>









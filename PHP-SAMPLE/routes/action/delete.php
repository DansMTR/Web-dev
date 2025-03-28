<?php
require_once 'product.php';
session_start();

// Establish a MySQL database connection
  $hostname = "localhost";  // This is the default hostname for a local MySQL server
$username = "root";
$password = "";
$dbname = "product";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['product1'])) {
    if ($_SESSION['status'] == "delete") {
        $product1 = unserialize($_SESSION['product1']);
        $Name = $product1->name;
        $date = $product1->date;
        $category=$product1->category;
          $query = "DELETE FROM products WHERE Name = '$Name' AND Datae = '$date' AND category = '$category'";
        $conn->query($query);
        
        unset($_SESSION['product1']);
        $_SESSION['status'] = "write";
        $redirectUrl = "write.php";
        header("Location: $redirectUrl");
        exit;
    }
} 

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $Name = $_GET['name'];
        $date = $_GET['date'];
        $category=$_GET['category'];
        // Delete the order from the MySQL database
         $query = "DELETE FROM products WHERE Name = '$Name' AND Datae = '$date' AND category = '$category'";
        $conn->query($query);
        
        $redirectUrl = "../../index.php";
        header("Location: $redirectUrl");
        exit;
    }


$conn->close();

?>

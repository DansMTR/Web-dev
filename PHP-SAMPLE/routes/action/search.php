<?php
require_once 'product.php';
require_once '../user/user.php';
session_start();
// Establish a database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "product";
$categoryFilter = isset($_GET['Category']) ? $_GET['Category'] : null;
$mysqli = new mysqli($hostname, $username, $password, $database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


//variables
if(isset($_GET['Product_Name']) )
{
    $Name = $_GET['Product_Name'];
}
if(isset($_SESSION['usertoshow']))
{
    $user_id = $_SESSION['usertoshowid'];
        $user = unserialize($_SESSION['usertoshow']); 
}






if(isset($_GET['status']))
{
    $status=$_GET['status'];
    if($status=="ViewAll")
    {
      //echo"nijja1";
       $query = "SELECT products.*, user.UserName
          FROM products
          JOIN user ON products.idfk = user.IdU"; 
        $result = $mysqli->query($query);
        getproducts($result);
    }
  else if ($status == "Search") {
    $query = "SELECT products.*, user.UserName
              FROM products
              JOIN user ON products.idfk = user.IdU
              WHERE 1"; // Always true to start the WHERE clause
    $params = array(); // To store bind_param parameters dynamically
    if ($Name != "noname") {
        $query .= " AND products.Name = ?";
        $params[] = $Name; // Add Name as a parameter to bind later
    }
    if ($categoryFilter && $categoryFilter != "all") {
        $query .= " AND products.category = ?";
        $params[] = $categoryFilter; // Add category as a parameter to bind later
    }
    $stmt = $mysqli->prepare($query);
    // Dynamically bind parameters if there are any
    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    getproducts($result);
}
    else if($status=="Searchp")
    {
        // echo  $user_id;
        // echo"nijja";
         $query = "SELECT * FROM products WHERE idfk = $user_id";
          if ($categoryFilter && $categoryFilter != "all") {
            $query .= " AND products.category = '$categoryFilter'";
        }
         if($Name!="noname"){
         // echo"here";
            $query .= " AND products.Name = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $Name);
            $stmt->execute();
            $result = $stmt->get_result();
            getproducts($result,$user->username);
            }      
        else{
          // echo"here1";
            $result = $mysqli->query($query);
            getproducts($result,$user->username);
        }
        

    }
       
        
}






function getproducts($result,$akal="defaultt")
{

$productsWithUsername = [];
while ($row = $result->fetch_assoc()) {

    //hayde la chouf barke kenet b chi profile w 3am a3moul search
      if ($akal == "defaultt") {
        $userName = $row['UserName'];
    } else {
        $userName = $akal;
    }

    // Create an array with product information for each row
    $productInfo = [
        'Name' => $row['Name'],
        'Model' => $row['Model'],
        'Description' => $row['Description'],
        'Price' => $row['Price'],
        'datea' => $row['datea'],
        'UserName' => $userName,
        'category' => $row['Category']
    ];

    // Add the product information array to the $productsWithUsername array
    $productsWithUsername[] = $productInfo;
}


// Convert the combined data to JSON
$combinedDataJson = json_encode($productsWithUsername, JSON_PRETTY_PRINT);
echo $combinedDataJson;

 $result->free();

}


$mysqli->close();

?>


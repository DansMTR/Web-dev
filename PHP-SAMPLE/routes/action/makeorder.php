<?php
require_once 'product.php';


if ((isset($_GET['status']) ) && $_GET['status'] == "Edit Order") {
    
        $Product_Name = $_GET['Product_Name'];
        $Model = $_GET['Model'];
        $Price = $_GET['Price'];
        $Description = $_GET['Description'];
        $Category = $_GET['Category'];
         $date = $_GET['date'];
         $product1 = new Product($Product_Name, $Price, $Model, $Description,$Category,$date);
         session_start();
         $_SESSION['product1'] = serialize($product1);
         $_SESSION['status'] ="Pending";
        
          


         
}

//$_SERVER['REQUEST_METHOD'] === 'GET'
 if (isset($_GET["submit"]))
{
   
    // Access individual form field values
    $Product_Name = $_GET['Product_Name'];
    $Model = $_GET['Model'];
    $Price = $_GET['Price'];
    $Description = $_GET['Description'];
    $Category = $_GET['Category'];
    $product = new Product($Product_Name, $Price, $Model, $Description,$Category);
    // Regular expression pattern for validating positive integers
    $positiveIntegerPattern = '/^\d+$/';

   
    $errors = array(
        'Price' => '',
    );
    
    


    // Validate tire quantity (positive integer)
    if (!preg_match($positiveIntegerPattern, $product->price) || $product->price < 0) {
        $errors["Price"] = "Price must be a positive integer.";
    }



    // If there are validation errors, display them to the user
    // Check if any value in the $errors array is not empty
$hasErrors = false;
foreach ($errors as $fieldName => $errorMessage) {
    if ($errorMessage !== '') {
        $hasErrors = true;
        break;
    }
}

 if($hasErrors == false) {
   
     session_start();
    date_default_timezone_set('Asia/Beirut');
    $product->date = date("Y-m-d H:i:s"); // Format the date as desired
    // Redirect to the processing PHP file along with the form data    
     $_SESSION['product'] = serialize($product);
   if((isset($_SESSION['product1'])))
   {
  
      $_SESSION['status'] = "delete";
    $redirectUrl = "delete.php";
    header("Location: $redirectUrl"); 

   }
   else{

   
    $_SESSION['status'] = "write";
    $redirectUrl = "write.php";
    header("Location: $redirectUrl"); 
    }
}
}
    


?>

<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
</head>
<body>
 
  <?php include '..\templates\navbar.php' ?>
  <div class ="row">
    <div class="center-container">
        <div class="container mt-5">
        <h1>New Product</h1>
        <form action="makeorder.php" id="myForm" method="get">
           <div class="mb-3">
    <label for="Category" class="form-label">Category:</label>
    <select class="form-select" id="Category" name="Category" required>
        <option value="" disabled selected>Choose a category...</option>
        <option value="Electronics">Electronics</option>
        <option value="furniture">Furniture</option>
        <option value="Others">Others</option>
    </select>
</div>
            <div class="mb-3">
                <label for="Product_Name" class="form-label">Product Name:</label>
                <input autocomplete="off" type="text" class="form-control" id="Product_Name" name="Product_Name" required value="<?php echo isset($_GET['Product_Name']) ? $_GET['Product_Name'] : ''; ?>">
            </div>
             <div class="mb-3">
                <label for="Model" class="form-label">Model:</label>
                <input type="text" class="form-control" id="Model" name="Model" required value="<?php echo isset($_GET['Model']) ? $_GET['Model'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="Price" class="form-label">Price:</label>
                <input type="text" class="form-control" id="Price" name="Price" required value="<?php echo isset($_GET['Price']) ? $_GET['Price'] : ''; ?>"/>
                <?php if (!empty($errors["Price"])) {
                            echo "<p style='font-size:12px ;color: red;'>{$errors["Price"]}</p>";
                        } ?>
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description:</label>
                <textarea class="form-control" id="Description" name="Description" required></textarea>
            </div>
           
            
            <button name ="submit" type="submit" class="btn btn-primary btn-lg mx-auto">Post</button>

        </form>
    </div>
    </div>
</div>

    
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

   
    <title>Bob autopart</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard/bob/index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    // Check if the variable is set
    if (!isset($_SESSION['statusu']) || $_SESSION['statusu'] !== "Confirmed") {
        echo '<a class="nav-link active" aria-current="page" href="javascript:void(0);" onclick="showAlert()">Order</a>';
    } else {
        echo '<a class="nav-link active" aria-current="page" href="/dashboard/bob/routes/action/makeorder.php">Order</a>';
    }
    ?>
</li>
        <li class="nav-item">
          <!-- <a class="nav-link" href="../bob/processorder.php"></a> -->
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
 


    <form   style="display: flex; align-items: center; justify-content: center;" method="get">
        <input  type="text" class="form-control" style="width: 70%; margin-right: 5px;" placeholder="Search..."> 
        <!-- Set width to 70% and add margin-right --> <!-- Set width to 30% -->
      </form>
 

             <div class="mt-2">
                <?php

                    if (isset($_GET['action']) && $_GET['action'] == "logout") {
            unset($_SESSION['statusu']); 
            unset($_SESSION['user']);
             $redirectUrl = "http://localhost/dashboard/bob/index.php";
    header("Location: $redirectUrl"); 
            exit;
        }
    else if (isset($_SESSION['statusu']) && $_SESSION['statusu']== "Confirmed") {
        
       echo '<div class="btn-group">';
            echo '<button type="button" class="btn btn-light rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 40px; height: 40px;">';
            echo '<i class="fas fa-user" style="color: #1e3050;"></i>';
            echo '</button>';
            echo '<div class="dropdown-menu" style="background-color: #f8f9fa; margin-left: -80px;">';
            echo '<a class="dropdown-item" href="/dashboard/bob/routes/user/profile.php">Profile</a>';
              echo '<a class="dropdown-item" href="?action=logout">Logout</a>';
            echo '</div>';
            echo '</div>';
    } else {
       
        echo '<a href="/dashboard/bob/routes/user/signin.php" id="Signin" class="btn btn-outline-secondary">Sign In</a>';
        echo '<a href="/dashboard/bob/routes/user/signup.php" class="btn btn-outline-success">Sign Up</a>';
    }
    ?>
                </div>

      </div>
    </div>
</nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

   <script >
        const form = document.getElementById('myForm');
    const searchButton = document.getElementById('search-bar-button'); 

        // Define the event listener function
        function handleFormSubmit(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            
            // You can access form elements by their names
            const nameInput = form.elements['Search_Name'];
            const enteredName = nameInput.value;

            // Do something with the entered name
                var httpc = new XMLHttpRequest();
    var status = "Search";
    var queryString = `status=${status}&Customer_Name=${enteredName}`;
     var url = "../bob/edit/search.php?" + queryString;
    httpc.open("GET", url, true);

    httpc.onreadystatechange = function() {
        if (httpc.readyState == 4 && httpc.status == 200) {
                 var responseLinesArray = httpc.responseText.split('\n');
            console.log(httpc.responseText);
           const productLines = httpc.responseText.split('\n').slice(1); // Skip the "All Products" line

 const products = [];
 console.log(productLines[2])
for (const line of productLines) {
  const dataArray = line.split(',');
  const product = new Order(
    parseInt(dataArray[0]),
    dataArray[1],
    parseInt(dataArray[2]),
    parseInt(dataArray[3]),
    parseInt(dataArray[4]),
    parseInt(dataArray[5]),
    parseFloat(dataArray[6]),
    parseFloat(dataArray[7]),
    dataArray[8]
  );
  products.push(product);
}
console.log(products[3]);

            var x= (products.length);
            var h2Element = document.getElementById("myHeading");
            h2Element.textContent = (httpc.responseText.split('\n')[0]) +":"+x;
            var divElement = document.querySelector('.row');
            divElement.innerHTML = '';
            for (var i = 0; i < products.length; i++) {
                var data = products[i];
                var cardHtml = `
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">${data.name}</h5>
                            <p class="card-text">
                                Date: ${data.date}<br>
                                Tire Quantity: ${data.tireqty}<br>
                                Oil Quantity: ${data.oilqty}<br>
                                Spark Quantity: ${data.sparkqty}<br>
                                Total Quantity: ${data.totalQty}<br>
                                Total Amount 0: ${data.priceWithoutTax}$<br>
                                Total Amount 1: ${data.priceWithTax}$<br>
                            </p>
                             <a href="#" class="btn btn-primary view-button">View</a>
                             <a href="#" class="btn btn-primary edit-button">Edit</a>
                             <a href="#" class="btn btn-primary delete-button">Delete</a>
                        </div>
                    </div>
                `;

        divElement.insertAdjacentHTML('beforeend', cardHtml);
                
               // Get buttons from the current card
                var currentCard = divElement.lastElementChild;
                var viewButton = currentCard.querySelector(".view-button");
                var editButton = currentCard.querySelector(".edit-button");
                var deleteButton = currentCard.querySelector(".delete-button");

                viewButton.addEventListener("click", createViewHandler(data));
                editButton.addEventListener("click", createEditHandler(data));
                deleteButton.addEventListener("click", createDeleteHandler(data));
            }
        }
    };

    httpc.send(url);
}
 function showAlert() {
        alert("Please login or sign up to place an order.");
    }
   </script>
  </body>
</html>
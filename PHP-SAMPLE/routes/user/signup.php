<?php
require_once 'user.php';

//$_SERVER['REQUEST_METHOD'] === 'GET'
 //name="firstName" 
 //name="lastName"
 //name="username" 
//name="email" 
//name="password"
session_start();
 if (isset($_GET["submit"]))
{
    
    
    // Access individual form field values
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $username = $_GET['username'];
    $email = $_GET['email'];
     $password = $_GET['password'];
    // Regular expression pattern for validating positive integers
     $user = new User($username, $password, $email, $firstName, $lastName);
    $namePattern = '/^[A-Za-z]+$/';
    $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
//$passwordPattern = '/^(?=.*[A-Z])(?=.*[!@#$%^&*()_\-+=<>?])(?=.*[a-zA-Z]).{7,}$/';


    // Validate the data
    $errors = array(
        'firstName' => '',
        'lastName' => '',
        'username' => '',
        'email' => ''
        // 'password' => '',
    );
    
    // Validate customer name (accept any non-empty value)
   
    if (!preg_match($namePattern, $user->firstName) ) {
        $errors["firstName"] = "First Name must only contain alphabetic letters.";
    }

    if (!preg_match($namePattern, $user->lastName) ) {
        $errors["lastName"] = "Last Name must only contain alphabetic letters.";
    }
     if (!preg_match($emailPattern, $user->email) ) {
        $errors["email"] = "Invalid Email.";
    }
    if (User::existusername($user->username)) {
    $errors["username"] ="UserName already exists.";
} 
if (User::existemail($user->email)) {
    $errors["email"]= "Email already exists.";
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
    
    // Append the current date, total quantity, total amount without tax, and total amount with tax to the query string// Format the date as desired
    // Redirect to the processing PHP file along with the form data      
     $_SESSION['user'] = serialize($user);
  User::addUser($username, $password, $email, $firstName, $lastName);
  $_SESSION['Idlogged']=User::getUserIdByUsername($username);
  
    
   
    $_SESSION['statusu'] = "Confirmed";
    $redirectUrl = "../../index.php";
    header("Location: $redirectUrl"); 
}
}
    


?>























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <style>
       body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-header_text-center {
            background-color: #007bff;
            color: white;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }
        .form-control {
            border-radius: 20px;
            border-color: #d1d3e2;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include '../templates/navbar.php';?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="test">Sign Up</h4>
                </div>
                <div class="card-body">
                    <form method ="get" action="signup.php">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input autocomplete="off" type="text" class="form-control" name="firstName" placeholder="Enter first name" value="<?php echo isset($_GET
            ['firstName']) ? $_GET
            ['firstName'] : ''; ?>"/><?php if (!empty($errors["firstName"])) {
                            echo "<p style=' font-size:12px ;color: red;'>{$errors["firstName"]}</p>";
                        } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input  autocomplete="off" type="text" class="form-control" name="lastName" placeholder="Enter last name"value="<?php echo isset($_GET
            ['lastName']) ? $_GET
            ['lastName'] : ''; ?>"/><?php if (!empty($errors["lastName"])) {
                            echo "<p style=' font-size:12px ;color: red;'>{$errors["lastName"]}</p>";
                        } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input  autocomplete="off" type="text" class="form-control" name="username" placeholder="Enter username" value="<?php echo isset($_GET
            ['username']) ? $_GET
            ['username'] : ''; ?>"/><?php if (!empty($errors["username"])) {
                            echo "<p style=' font-size:12px ;color: red;'>{$errors["username"]}</p>";
                        } ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input autocomplete="off" type="email" class="form-control" name="email" placeholder="Enter email" value="<?php echo isset($_GET
            ['email']) ? $_GET
            ['email'] : ''; ?>"/><?php if (!empty($errors["email"])) {
                            echo "<p style=' font-size:12px ;color: red;'>{$errors["email"]}</p>";
                        } ?>
                        </div>
                         <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input autocomplete="off" type="password" class="form-control" name ="password"id="password" placeholder="Password" value="<?php echo isset($_GET
            ['password']) ? $_GET
            ['password'] : ''; ?>"/><?php if (!empty($errors["password"])) {
                            echo "<p style=' font-size:12px ;color: red;'>{$errors["email"]}</p>";
                        } ?>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (optional) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            const passwordInput = $('#password');
            const passwordType = passwordInput.attr('type');
            
            if (passwordType === 'password') {
                passwordInput.attr('type', 'text');
                $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordInput.attr('type', 'password');
                $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>

</body>
</html>

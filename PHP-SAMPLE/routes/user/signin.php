
<?php
require_once 'user.php';

//$_SERVER['REQUEST_METHOD'] === 'GET'
 //name="firstName" 
 //name="lastName"
 //name="username" 
//name="email" 
//name="password"
function get_user_info_from_db($username) {
    // Replace these database connection details with your own
    $hostname = "localhost";  // This is the default hostname for a local MySQL server
    $usernames = "root";
    $passwords = "";
    $database = "product";

    // Create a new database connection
    $conn = new mysqli($hostname, $usernames, $passwords, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to get the first name, last name, email, and hashed password
    $stmt = $conn->prepare("SELECT FirstName, LastName, email , Password FROM user WHERE UserName=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email, $hashed_password);
    $stmt->fetch();

    // Close the database connection
    $stmt->close();
    $conn->close();

    if ($first_name !== null && $last_name !== null && $email !== null && $hashed_password !== null) {
        // Create a new User object with the retrieved information
        $user = new User($username, $hashed_password,$email,$first_name, $last_name, );
        return $user;
    } else {
        return null;
    }
}

 if (isset($_GET["submit"]))
{
    
    
    // Access individual form field values
    $username = $_GET['username'];
     $password = $_GET['password'];
      $errors = array(
        'username' => '',
         'password' => '',
    );
if (User::userExists($username, $password)) {
    session_start();
    $user=get_user_info_from_db($username);
      $_SESSION['user'] = serialize($user);
    $_SESSION['statusu'] = "Confirmed";
    $_SESSION['Idlogged']=User::getUserIdByUsername($username);
    $redirectUrl = "../../index.php";
    header("Location: $redirectUrl"); 
} else {
      $errors = array(
        'username' => 'Username or Password incorrect.',
         'password' => 'Username or Password incorrect.',
    );
    foreach ($errors as $fieldName => $errorMessage) {
    if ($errorMessage !== '') {
        $hasErrors = true;
        break;
    }
}
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">

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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form> <?php if (!empty($errors["username"])) {
                            echo "<p style=' font-size:12px ;color: red;'>{$errors["username"]}</p>";
                        } ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input autocomplete="off" type="text" class="form-control"name ="username" id="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input autocomplete="off" type="password"  name ="password"class="form-control" id="password" placeholder="Password">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button name ="submit" type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="text-center">
                            <a href="#">Forgot password?</a>
                        </div>
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

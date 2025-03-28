<?php  
require_once 'user.php';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Include the Bootstrap stylesheet -->
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../templates/navbar.php';?>
    <div class="container mt-4">
     
            <div class="col-md-4">
                <!-- Profile Picture -->
                <img src="profile-picture.jpg" class="img-fluid rounded-circle" alt="Profile Picture">
            </div>
            <div class="col-md-8" style="width: 18rem; position: relative; z-index: 1; transform:translateX(200px);">
                <!-- Profile Information --> 

   <?php 
require_once 'user.php';
// Assuming you have already unserialized the user object

if(isset($_GET['Username']))
{

$user = User::getUserInfoByUsername($_GET['Username']);
 $user2 = unserialize($_SESSION['user']);
 if(($user->username)==($user2->username))
 {
  echo '<div id="testing" ></div>';
 }
$_SESSION['usertoshow']=serialize($user);
}
else 
{
  echo '<div id="testing" ></div>';
  $user = unserialize($_SESSION['user']);
$_SESSION['usertoshow']=serialize($user);
}


$_SESSION['usertoshowid']= User::getUserIdByUsername($user->username);
?>
                <h2><?php echo $user->firstName . " " . $user->lastName; ?></h2>
                <p><strong>First Name:</strong> <?php echo $user->firstName; ?></p>
                <p><strong>Last Name:</strong> <?php echo $user->lastName; ?></p>
                 <p><strong>UserName:</strong> <?php echo $user->username; ?></p>
                <p><strong>Email:</strong> <?php echo $user->email; ?></p>
                
            </div>
            <hr style="margin-left: 200px;">

   <?php include '../templates/searchbar.php';?>
        <h3 style="margin-left: 200px;" >Products:</h3>
       <hr style="margin-left: 200px;">


     <div class="row" id="hello">
      <div class="col-md-12">
     
      </div>
    </div>
</div>
      <script src="../../display.js" ></script>
       <script src="../../clickhandlers.js" ></script>
        <script >
          var condition = true;
          status="Searchp";
             const testt = document.querySelector('div#testing');
           if(!testt) condition =false;
            var baseUrl = "<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/dashboard/'; ?>";
      
         window.onload = myFunction("noname","Searchp",selectedCategory);
      function emche(pname,category)
            {
              console.log(pname+category);
                if(pname=="")
              {
                myFunction("noname","Searchp",category);
              }
              else{
                myFunction(pname,"Searchp",category);
              }
            }
       </script>
</body>
</html>

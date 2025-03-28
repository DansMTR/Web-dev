
<!DOCTYPE html>
<html>

   <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <title>Home</title>
      
  </head>
   <body>  <style>
    .btn-group {
      display: flex;
      align-items: center;
    }
  </style>

   <div class="mains">
  <?php include 'routes\templates\navbar.php' ?>
   <?php include 'routes\templates\searchbar.php' ?>
 <!-- Add a horizontal line -->
</div>
  <div class="container">
    <h2 id="myHeading"></h2>
    <div class="row" id="hello">
      <div class="col-md-12">
     
      </div>
    </div>
  </div>
</div>
    <script src="display.js" ></script>
       <script src="clickhandlers.js" ></script>
       <script >

      status="ViewAll";
     var condition =false;
        var baseUrl = "<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/dashboard/'; ?>";
             window.onload = myFunction("noname","ViewAll",selectedCategory);
            function emche(pname,category)
            {
              console.log(pname+category);
              if(pname=="")
              {
                myFunction("noname","Search",category);
              }
              else{
                myFunction(pname,"Search",category);
              }
              
            }
     
       </script>
        </body>
</html>

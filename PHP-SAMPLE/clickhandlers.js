// data-product-name="${data.name}"
//    data-price="${data.price}"
//    data-model="${data.model}"
//    data-description="${data.description}"
//    data-created-by="${data.username}">

   const signInButton = document.querySelector('a#Signin.btn.btn-outline-secondary');
const container = document.querySelector('body');
  container.addEventListener('click', function (e) {
    // But only alert for elements that have an alert-button class
    if (e.target.classList.contains('delete-button')) {
    	 if (signInButton) {
        // Button with the specified class exists
        alert("Please login or sign up to delete an order.");
        // You can perform further actions here if needed
     } 
    else {
      console.log("delete");
    	   var status = "delete";
        var button = e.target;
        var Product_Name = button.getAttribute("data-product-name");
        var price = button.getAttribute("data-price");
        var model= button.getAttribute("data-model");
        var description = button.getAttribute("data-description");
        var date = button.getAttribute("data-date");
var category = button.getAttribute("data-category");
        var queryString = `status=${status}&Product_Name=${encodeURIComponent(Product_Name)}&price=${encodeURIComponent(price)}&model=${encodeURIComponent(model)}&description=${encodeURIComponent(description)}&date=${encodeURIComponent(date)}&Category=${encodeURIComponent(category)}`;
        
        // Define the URL of your PHP file along with the query string
          var url1 =baseUrl + 'bob/routes/action/delete.php?';
        var url = url1 + queryString;

        // Create a new XMLHttpRequest
        var httpc = new XMLHttpRequest();
        httpc.open("GET", url, true);

        // Set the function to handle the response
        httpc.onreadystatechange = function() {
            if (httpc.readyState == 4 && httpc.status == 200) {
                console.log(httpc.responseText);
               // Reload the current page
                location.reload();
               

            }
        };

        // Send the GET request
        httpc.send(url);


    }
    






    }
    if (e.target.classList.contains('edit-button')) {
    	 if (signInButton) {
        // Button with the specified class exists
        alert("Please login or sign up to edit an order.");
        // You can perform further actions here if needed
     } 
else {
     var status = "Edit Order";
        var button = e.target;
        var Product_Name = button.getAttribute("data-product-name");
        var price = button.getAttribute("data-price");
        var model= button.getAttribute("data-model");
        var description = button.getAttribute("data-description");
        var date = button.getAttribute("data-date");

var category = button.getAttribute("data-category");
        var queryString = `status=${status}&Product_Name=${encodeURIComponent(Product_Name)}&Price=${encodeURIComponent(price)}&Model=${encodeURIComponent(model)}&Description=${encodeURIComponent(description)}&date=${encodeURIComponent(date)}&Category=${encodeURIComponent(category)}`;
        console.log(queryString);
        //Define the URL of your PHP file along with the query string
          var url1 =baseUrl + 'bob/routes/action/makeorder.php?';
       window.location = url1+ queryString;





}




    }
    if (e.target.classList.contains('view-button')) {
    console.log("View Order");
        var status = "View Order";
        var button = e.target;
        var Product_Name = button.getAttribute("data-product-name");
        var price = button.getAttribute("data-price");
        var model= button.getAttribute("data-model");
        var description = button.getAttribute("data-description");
        var date = button.getAttribute("data-date");
        var category = button.getAttribute("data-category");
        var queryString = `status=${status}&Product_Name=${encodeURIComponent(Product_Name)}&price=${encodeURIComponent(price)}&model=${encodeURIComponent(model)}&description=${encodeURIComponent(description)}&date=${encodeURIComponent(date)}&Category=${encodeURIComponent(category)}`;
 		    var url1 =baseUrl + 'bob/routes/action/write.php?';
 		window.location = url1+ queryString;
    }
     if (e.target.classList.contains('link_to_user_profile')) {
        var status = "View Profile";
        var button = e.target;
        var Username_p = button.getAttribute("data-username")
        var queryString = `status=${status}&Username=${encodeURIComponent(Username_p)}`;
            var url1 =baseUrl + 'bob/routes/user/profile.php?';
 		window.location = url1+ queryString;
    }

  });
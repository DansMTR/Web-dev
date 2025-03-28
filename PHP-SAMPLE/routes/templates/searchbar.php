<!DOCTYPE html>
<html>

<head>
    <!-- Include Bootstrap CSS -->

</head>
    <style>
        /* Style for the fixed left-side bar */
     .fixed-left-bar {
            position: fixed;
            top: 76px; /* Added padding of 20px to create space */
            left: 0;
            bottom: 0;
            width: 250px; /* Adjust the width as needed */
            background-color: #e0e0e0; /* Slightly darker gray color */
            color: #333; /* Text color */
            padding: 15px;
        }

        /* Style for the search bar */
        .search-bar {
            margin-top: 20px; /* Add some top margin for separation */
        }

        /* Style to offset content area */
        .content-offset {
            margin-left: 260px; /* Adjust the margin-left to match the width of the sidebar + some spacing */
        }
         .sort-buttons {
            margin-top: 20px;
        }
        
        /* Style for icons */
        .icon {
            margin-right: 5px;
        }
         .btn-sort.active {
            background-color: #28a745 !important; /* Change to desired active color */
            color: #fff !important; /* Change to desired text color */
        }
    </style>
</head>
<body>

    <button type="button" class="btn btn-primary" id="toggleSidebar">Toggle Sidebar</button>
 <div class="fixed-left-bar" id="sidebar" style="display: none;">
    <h2>Filter</h2>

    <!-- Search Bar and Search Button -->
    <div class="form-group">
        <form id="myform">
        <div class="search-bar">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" placeholder="Enter your search term">
            <button id="myforms"type="button" class="btn btn-primary mt-2" id="searchButton">Search</button>
        </div>
    </form>
    </div>

    <!-- Category Selection -->
    <div class="form-group">
        <label for="category">Category:</label>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="allCategory" name="category" value="all" checked>
            <label class="form-check-label" for="allCategory">All</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="electronicsCategory" name="category" value="electronics">
            <label class="form-check-label" for="electronicsCategory">Electronics</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="furnitureCategory" name="category" value="furniture">
            <label class="form-check-label" for="furnitureCategory">Furniture</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="othersCategory" name="category" value="others">
            <label class="form-check-label" for="othersCategory">Others</label>
        </div>
        <!-- Add more categories as needed -->
    </div>

  
    <!-- Sort Options -->
    <label for="sort">Sort by:</label>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="noneSort" name="sort" value="none" checked>
        <label class="form-check-label" for="noneSort">None</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="dateSort" name="sort" value="date">
        <label class="form-check-label" for="dateSort">Date</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="priceSort" name="sort" value="price">
        <label class="form-check-label" for="priceSort">Price</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="nameSort" name="sort" value="name">
        <label class="form-check-label" for="nameSort">Name</label>
    </div>

    <!-- Ascending/Descending Options -->
    <label for="order">Order:</label>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="ascOrder" name="order" value="ascending" disabled>
        <label class="form-check-label" for="ascOrder">Ascending</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="descOrder" name="order" value="descending" disabled>
        <label class="form-check-label" for="descOrder">Descending</label>
    </div>
      <!-- Apply Button -->
    <div class="form-group">
        <button type="button" class="btn btn-success" id="applyButton">Apply</button>
    </div>

</div>
    
        
<script>
    var selectedCategory = "all"; // Default selected category
    //var selectedSort = "none";    // Default selected sorting option
 var enteredName="noname";
    const forms = document.getElementById("myform"); // Select the entire sidebar
    const button=document.getElementById("myforms");
    const ha = document.querySelector('.fixed-left-bar');
    // Function to submit the form with selected name, category, and sort
    function submitForm(pname, category) {
        // Modify this function to submit the form as needed
        emche(pname,category);
    }

    // Add an event listener to the radio buttons for category selection
    const categoryRadios = ha.querySelectorAll('input[name="category"]');
    categoryRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            selectedCategory = this.value;
          //  console.log(selectedCategory) ;
            submitForm(enteredName, selectedCategory);// Update the selected category
        });
    });

    // Add an event listener to the radio buttons for sorting options
    // const sortRadios = forms.querySelectorAll('input[name="sort"]');
    // sortRadios.forEach(function(radio) {
    //     radio.addEventListener('change', function() {
    //         selectedSort = this.value; // Update the selected sorting option
    //     });
    // });

    // Add an event listener to the form for form submission
 function handleFormSubmission(event) {
    event.preventDefault(); // Prevent the default form submission
     const nameInput = forms.querySelector('#search');
   enteredName = nameInput.value;
    //console.log(enteredName);
    submitForm(enteredName, selectedCategory);
    // Handle the form submission logic here.
}
     button.addEventListener('click', function(event) {
    handleFormSubmission(event);
});

forms.addEventListener('submit', function(event) {
    handleFormSubmission(event);
});
  $(document).ready(function () {
        $("#toggleSidebar").click(function () {
            $("#sidebar").toggle();
        });
    });
</script>

<script>
    // Get the radio buttons for sorting and order
    const sortRadioButtons = document.getElementsByName("sort");
    const orderRadioButtons = document.getElementsByName("order");
    
    // Disable ascending and descending options by default
    for (const orderRadioButton of orderRadioButtons) {
        orderRadioButton.disabled = true;
    }
    
    // Add event listener to sorting radio buttons
    for (const radioButton of sortRadioButtons) {
        radioButton.addEventListener("change", function () {
            // Check if "None" is selected
            if (this.value === "none") {
                // Disable ascending and descending options
                for (const orderRadioButton of orderRadioButtons) {
                    orderRadioButton.disabled = true;
                }
            } else {
                // Enable ascending and descending options
                for (const orderRadioButton of orderRadioButtons) {
                    orderRadioButton.disabled = false;
                }
            }
        });
    }
</script>
</body>

</html>



















<!-- 
 <script>
        var selectedCategory = "default";
        const forms = document.getElementById('myForm');
        var status = "Search";

        // Function to submit the form with optional name and category
        function submitForm(name, category, status) {
            myFunction(name, status, category); // Submit the form
        }
        // Add an event listener to the select element for category changes
        const categorySelect = document.getElementById('categorySelect');
        categorySelect.addEventListener("change", function () {
            selectedCategory = categorySelect.value;
            const nameInput = forms.elements['Search_Name'];
            const enteredName = nameInput.value;
        });

        // Add an event listener to the form for form submission
        forms.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission
            const nameInput = forms.elements['Search_Name'];
            const enteredName = nameInput.value;
            submitForm(enteredName, selectedCategory);
        });
    </script>
 -->









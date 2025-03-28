 class Product {
  constructor( name, price, model,description, date, category,username) {
    this.name = name;
    this.price= price;
    this.model = model;
    this.description=description;
    this.date = date;
    this.category = category;
    this.username=username;
  }
}

function myFunction(optionalArg="default",status,selectedCategory) {
    var httpc = new XMLHttpRequest();
   console.log(optionalArg +" "+status +" "+selectedCategory); 
 var queryString = `status=${status}&Product_Name=${optionalArg}&Category=${selectedCategory}`;
    var url1 =baseUrl + 'bob/routes/action/search.php?';
     var url = url1+ queryString;
    httpc.open("GET", url, true);

    httpc.onreadystatechange = function() {
        if (httpc.readyState == 4 && httpc.status == 200) {
         console.log(httpc.responseText);
     if ((typeof httpc.responseText === 'string' && httpc.responseText.trim()) === '' || (Array.isArray(httpc.responseText) && httpc.responseText.length === 0)) {
      var divElement =document.getElementById('hello');
            divElement.innerHTML = "";
            heading ="No Results";
            divElement.insertAdjacentHTML('beforeend', heading);
    return false ; // String is empty or contains only whitespace
  }
  else{
const responseJson = JSON.parse(httpc.responseText);
const orders = [];
console.log(responseJson);
    for (const entry of responseJson) {
        const order = new Product(
            entry.Name,
            parseInt(entry.Price),
            entry.Model,
            entry.Description,
            entry.datea,
            entry.category,
            entry.UserName
        );
        orders.push(order);
    }
  
  console.log(orders);
            var divElement =document.getElementById('hello');
            divElement.innerHTML = "";
            var transformValue = `translateX(${(250 / 2)+50}px)`;
            for (var i = 0; i < orders.length; i++) {
                var data = orders[i];
                var cardHtml = `
                    <div class="card" style="width: 18rem; position: relative; z-index: 1; transform: ${transformValue};">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">${data.name}</h5>
                            <p class="card-text">
                                Date: ${data.date}<br>
                                Price: ${data.price}$<br>
                                Model: ${data.model}<br>
                                Description: ${data.description}<br>
                                Category: ${data.category}<br>
                               Created By: <a href=# class="link_to_user_profile" data-username="${data.username}">${data.username}</a>



                            </p>
                           <a href="#" class="btn btn-primary view-button"
   data-product-name="${data.name}"
   data-price="${data.price}"
   data-model="${data.model}"
   data-description="${data.description}"
   data-created-by="${data.username}"
   data-date="${data.date}"
   data-category="${data.category}">
   View
</a>                      ${condition ? `
                             <a href="#" class="btn btn-primary edit-button" data-product-name="${data.name}"
   data-price="${data.price}"
   data-model="${data.model}"
   data-description="${data.description}"
   data-created-by="${data.username}" data-date="${data.date}" data-category="${data.category}">Edit</a>

              
                    <a href="#" class="btn btn-primary delete-button"
                       data-product-name="${data.name}"
   data-price="${data.price}"
   data-model="${data.model}"
   data-description="${data.description}"
   data-created-by="${data.username}" data-date="${data.date}" data-category="${data.category}">
                        Delete
                    </a>
                ` : ''}
                        </div>
                    </div>
                `;
                
                divElement.insertAdjacentHTML('beforeend', cardHtml);
            }
  
         // mn hone w tlou3
}
        }
    };

    httpc.send(url);
}




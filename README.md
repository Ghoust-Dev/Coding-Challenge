# Coding challenge

The project is for manage the products and categories using the Framework Laravel and VueJs.

### Database

Contain 2 tables Product and Category.

### Back-End

I used 2 controllers 'ProductController' and 'CategorieController' to manipulate the code and i used the Repositories and service layer to make a good and fast code and i used the CLI to create and delete the product and categorie from the command ligne.

#### Command line

###### Create product

$ php artisan create:product {name} {description} {price} {image} {categorie_id} {sub_categorie_id?}

* {name} : the name of product.
* {description} : the description of product.
* {price} : the price of product.
* {image} : the name of product image.
* {categorie_id} : the id of categorie for the product.
* {sub_categorie_id?} : the id of sub categorie for the product is optional.

###### Delete product

$ php artisan delete:product {id}

* {id} : the id of the product you need to deleted.

###### Create Categorie

$ php artisan create:categorie {name} {parent_categorie_id?}

* {name} : the name of categorie.
* {parent_categorie_id?} : the id of the parent categorie is optional.

###### Delete product

$ php artisan delete:categorie {id}

* {id} : the id of the categorie you need to deleted.

### Front-End

I used the Vuejs to create the front-end and i used the Axios to receive or send data from the server.

In the folder components we have all components of the project and in the folder routes i create the index.js to manipule the routing of components.

For Styling i used the Bootstrap V4.

### Technologies we used

* Laravel / VueJs
* PHP7 / MySQL
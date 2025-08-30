# Simplikart
#### Video Demo:  https://youtu.be/K0ktX1EmsAg

Simplikart is a simple e-commerce web application that allows users to browse products, add them to a shopping cart, and place orders. The application follows an MVC-like structure and uses PHP, MySQL, and jQuery.

## Features

- **User Authentication**: Register and login functionality
- **Product Browsing**: View and filter products by type, name, and price range
- **Shopping Cart**: Add products to cart, update quantities, and remove items
- **Order Management**: Checkout process and order history tracking
- **Responsive Design**: Mobile-friendly interface using Bootstrap framework

## File Descriptions

### `index.php`
The main landing page of the website. Displays a banner and categories of products. Includes a navigation bar with links to home, products, orders, and logout.

### `products.php`
Displays all products available on the website. Users can filter products by type, search by name, and filter by price range. Includes a navigation bar and a search form.

### `register.php`
The registration page for new users. Includes a form for users to enter their name, email, and password. The form submits data to `processRegister.php`.

### `processRegister.php`
Handles the registration logic. Checks if all fields are filled, verifies if the email already exists, and inserts the new user into the database.

### `login.php`
The login page for existing users. Includes a form for users to enter their email and password. The form submits data to `processLogin.php`.

### `processLogin.php`
Handles the login logic. Verifies the user's email and password against the database and sets session variables upon successful login.

### `logout.php`
Logs the user out by clearing session variables and redirects to the login page.

### `cart.php`
Displays the user's shopping cart. Shows the products added to the cart, their quantities, and the total price. Users can update quantities or remove items from the cart.

### `addToCart.php`
Handles adding products to the user's cart. Checks if the product is already in the cart and updates the quantity or inserts a new entry.

### `removeItem.php`
Handles removing products from the user's cart based on the product ID.

### `updateQty.php`
Handles updating the quantity of a product in the user's cart. If the quantity is set to zero, it removes the product from the cart.

### `checkout.php`
Displays the checkout page with a summary of the cart items and the total price. Users can confirm their order, which submits data to `placeOrder.php`.

### `placeOrder.php`
Handles placing an order. Inserts the order details into the orders table, moves cart items to the order items table, and clears the cart.

### `orders.php`
Displays the user's order history. Lists all orders with their IDs, dates, and total amounts. Users can view individual orders.

### `order.php`
Displays the details of a specific order. Shows the products included in the order, their quantities, and the total price.

### `calculateTotal.php`
Calculates the total price of the items in the user's cart and returns the total amount.

### `getCart.php`
Fetches the current items in the user's cart and displays them in the navigation bar.

### `common.js`
Contains common JavaScript functions used across the website, such as adding items to the cart, updating quantities, and fetching cart details.

### `includes/config.php`
Contains the database connection configuration. It is included in various PHP files to establish a connection to the MySQL database.

## Technologies Used

- PHP
- MySQL
- jQuery
- Bootstrap
- Ajax
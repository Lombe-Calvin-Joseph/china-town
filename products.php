
<?php
require_once 'db.php';
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dynamic_website"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$name = $_POST['name'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$image = $_POST['image'];

// Insert data into the items table
$sql = "INSERT INTO items (name, price, discount, image) 
        VALUES ('$name', '$price', '$discount', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "Product added to cart successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>China Town - Products</title>
    <link rel="stylesheet" href="main.css">

    <style>
        /* Header Styling with Improved Fonts */
        header {
            background-color: #0b0b0b;
            padding: 15px 0;
            color: white;
        }

        .logo {
            font-family: sans-serif; /* Elegant serif font for the logo */
            font-size: 28px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            font-family: 'Roboto', sans-serif; /* Modern sans-serif font for navigation links */
            font-size: 16px;
            font-weight: 500;
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #4ebf63;
        }

        /* Style for the container holding the image and label */
        .image-container {
            position: relative; /* This allows absolute positioning of the label */
            width: 300px; /* Set the width of the image container */
            margin-bottom: 20px; /* Add space between products */
        }

        /* Style for the image */
        .product-image {
            width: 100%; /* Make image fit the container */
            display: block; /* Remove space below the image */
        }

        /* Style for the discount label */
        .discount-label {
            position: absolute;
            top: 10px; /* Position from the top */
            left: 10px; /* Position from the left */
            background-color: red; /* Set background color for the label */
            color: white; /* Set text color */
            padding: 5px 10px; /* Add padding inside the label */
            font-size: 16px; /* Set font size */
            font-weight: bold; /* Make the text bold */
            border-radius: 5px; /* Optional: Add rounded corners */
        }

        /* Product container styling */
        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .product {
            width: 300px; /* Set the width of each product */
            text-align: center;
        }

        .product h3 {
            margin: 10px 0;
        }

        .product p {
            margin: 5px 0;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #218838;
        }

        /* Container for the image */
        .hover-move-container {
            width: 10%;
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        /* Image that moves on hover */
        .hover-move-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.5s ease;
        }

        /* Move the image on hover */
        .hover-move-container:hover .hover-move-image {
            transform: translate(-50%, -50%) translateX(200px); /* Move the image to the right */
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo">China Town UG</a>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="contacts.html">Contact</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="products">
            <div class="container">
                <h2>Available Products</h2>
                <!-- Product 1 -->
                <div class="product">
                    <div class="image-container">
                        <img src="Televison.jpg" alt="Television" class="product-image">
                        <div class="discount-label">20% OFF</div>
                    </div>
                    <h3>Television</h3>
                    <p><strike>$2000</strike> $1600</p>
                    <a href="cart.html">

                    <button onclick="alert('Television added to cart!')">Add to Cart</button>
                    </a>
                </div>

                <!-- Product 2 -->
                <div class="product">
                    <div class="image-container">
                        <img src="Speakers.png" alt="Speakers" class="product-image">
                        <div class="discount-label">15% OFF</div>
                    </div>
                    <h3>Speakers</h3>
                    <p><strike>$1450</strike> $1232.50</p>
                    <button onclick="alert('Speakers added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 3 -->
                <div class="product">
                    <div class="image-container">
                        <img src="smartwatch.jpg" alt="Smart Watch" class="product-image">
                        <div class="discount-label">10% OFF</div>
                    </div>
                    <h3>Smart Watch</h3>
                    <p><strike>$200</strike> $180</p>
                    <button onclick="alert('Smart Watch added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 4 -->
                <div class="product">
                    <div class="image-container">
                        <img src="Hoofers.jpg" alt="Hoofers" class="product-image">
                        <div class="discount-label">25% OFF</div>
                    </div>
                    <h3>Hoofers</h3>
                    <p><strike>$100</strike> $75</p>
                    <button onclick="alert('Hoofers added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 5 -->
                <div class="product">
                    <div class="image-container">
                        <img src="stabex.jpg" alt="Stabex Gas 6kg" class="product-image">
                        <div class="discount-label">15% OFF</div>
                    </div>
                    <h3>Stabex Gas 6kg</h3>
                    <p><strike>$3300</strike> $2805</p>
                    <button onclick="alert('Stabex Gas added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 6 -->
                <div class="product">
                    <div class="image-container">
                        <img src="Refrigirator.jpg" alt="Refrigerator" class="product-image">
                        <div class="discount-label">5% OFF</div>
                    </div>
                    <h3>Refrigerator</h3>
                    <p><strike>$100</strike> $95</p>
                    <button onclick="alert('Refrigerator added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 7 -->
                <div class="product">
                    <div class="image-container">
                        <img src="laptop.jpg" alt="Laptop" class="product-image">
                        <div class="discount-label">30% OFF</div>
                    </div>
                    <h3>Laptop</h3>
                    <p><strike>$13600</strike> $9520</p>
                    <button onclick="alert('Laptop added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 8 -->
                <div class="product">
                    <div class="image-container">
                        <img src="shoes.jpg" alt="Shoes" class="product-image">
                        <div class="discount-label">20% OFF</div>
                    </div>
                    <h3>Shoes</h3>
                    <p><strike>$400</strike> $320</p>
                    <button onclick="alert('Shoes added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 9 -->
                <div class="product">
                    <div class="image-container">
                        <img src="jacket.jpg" alt="Jacket" class="product-image">
                        <div class="discount-label">10% OFF</div>
                    </div>
                    <h3>Jacket</h3>
                    <p><strike>$100</strike> $90</p>
                    <button onclick="alert('Jacket added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 10 -->
                <div class="product">
                    <div class="image-container">
                        <img src="potato.jpg" alt="Potato Crisps" class="product-image">
                        <div class="discount-label">5% OFF</div>
                    </div>
                    <h3>Potato Crisps</h3>
                    <p><strike>$40</strike> $38</p>
                    <button onclick="alert('Potato Crisps added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 11 -->
                <div class="product">
                    <div class="image-container">
                        <img src="toiletpaper.jpg" alt="Toilet Paper" class="product-image">
                        <div class="discount-label">10% OFF</div>
                    </div>
                    <h3>Toilet Paper</h3>
                    <p><strike>$10</strike> $9</p>
                    <button onclick="alert('Toilet Paper added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 12 -->
                <div class="product">
                    <div class="image-container">
                        <img src="bottle.jpg" alt="Water Bottle" class="product-image">
                        <div class="discount-label">15% OFF</div>
                    </div>
                    <h3>Water Bottle</h3>
                    <p><strike>$5</strike> $4.25</p>
                    <button onclick="alert('Water Bottle added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 13 -->
                <div class="product">
                    <div class="image-container">
                        <img src="closet.jpg" alt="Closet" class="product-image">
                        <div class="discount-label">20% OFF</div>
                    </div>
                    <h3>Closet</h3>
                    <p><strike>$500</strike> $400</p>
                    <button onclick="alert('Closet added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 14 -->
                <div class="product">
                    <div class="image-container">
                        <img src="fridge.jpg" alt="Fridge" class="product-image">
                        <div class="discount-label">12% OFF</div>
                    </div>
                    <h3>Fridge</h3>
                    <p><strike>$900</strike> $792</p>
                    <button onclick="alert('Fridge added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 15 -->
                <div class="product">
                    <div class="image-container">
                        <img src="microwave.jpg" alt="Microwave" class="product-image">
                        <div class="discount-label">18% OFF</div>
                    </div>
                    <h3>Microwave</h3>
                    <p><strike>$350</strike> $287</p>
                    <button onclick="alert('Microwave added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 16 -->
                <div class="product">
                    <div class="image-container">
                        <img src="detergent.jpg" alt="detergent" class="product-image">
                        <div class="discount-label">10% OFF</div>
                    </div>
                    <h3>Detergent</h3>
                    <p><strike>$150</strike> $135</p>
                    <button onclick="alert('Detergent has been added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 17 -->
                <div class="product">
                    <div class="image-container">
                        <img src="blender.jpg" alt="Blender" class="product-image">
                        <div class="discount-label">5% OFF</div>
                    </div>
                    <h3>Blender</h3>
                    <p><strike>$80</strike> $76</p>
                    <button onclick="alert('Blender added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 18 -->
                <div class="product">
                    <div class="image-container">
                        <img src="cooker.jpg" alt="Electric Cooker" class="product-image">
                        <div class="discount-label">20% OFF</div>
                    </div>
                    <h3>Electric Cooker</h3>
                    <p><strike>$100</strike> $80</p>
                    <button onclick="alert('Electric Cooker added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 19 -->
                <div class="product">
                    <div class="image-container">
                        <img src="iron.jpg" alt="Iron" class="product-image">
                        <div class="discount-label">15% OFF</div>
                    </div>
                    <h3>Iron</h3>
                    <p><strike>$50</strike> $42.50</p>
                    <button onclick="alert('Iron added to cart!')">Add to Cart</button>
                </div>

                <!-- Product 20 -->
                <div class="product">
                    <div class="image-container">
                        <img src="toaster.jpg" alt="Toaster" class="product-image">
                        <div class="discount-label">10% OFF</div>
                    </div>
                    <h3>Toaster</h3>
                    <p><strike>$30</strike> $27</p>
                    <button onclick="alert('Toaster added to cart!')">Add to Cart</button>
                </div>
                <!-- Product 21 -->
                <div class="product">
                    <div class="image-container">
                        <img src="milk.jpg" alt="mikl" class="product-image">
                        <div class="discount-label">10% OFF</div>
                    </div>
                    <h3>milk</h3>
                    <p><strike>$30</strike> $27</p>
                    <button onclick="alert('Milk added to cart!')">Add to Cart</button>
                </div>

            </div>
        </section>
    </div>
    <style>
        /* Container for the image */
        .hover-move-container {
            width: 10%;
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        /* Image that moves on hover */
        .hover-move-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.5s ease;
        }

        /* Move the image on hover */
        .hover-move-container:hover .hover-move-image {
            transform: translate(-50%, -50%) translateX(200px); /* Move the image to the right */
        }
    </style>
</head>
<body>

    <div class="hover-move-container">
        <div class="category">
            <img src="Phones and tablets.jpg" alt="Logo" class="hover-move-image" width="100">
            <h3>Phones & Tablets</h3>
            <p>66,813 ads</p>
        </div>
    </div>
    <div class="hover-move-container">
        <div class="category">
            <img src="jacket.jpg" alt="Logo" class="hover-move-image" width="100">
            <h3>Fashion</h3>
            <p>66,813 ads</p>
        </div>
        <div class="hover-move-container">
            <div class="category">
                <img src="Grocery.jpg" alt="Logo" class="hover-move-image" width="100">
                <h3>Groceries</h3>
                <p>66,813 ads</p>
            </div>
        </div>
        </main>
    
    </main>

    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 China Town UG. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>


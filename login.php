<?php
// Start the session to store user details
session_start();

// Include database connection
require_once 'db.php'; // Ensure db.php contains your database connection setup

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input data
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Prepare the SQL statement to get the user details
    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password FROM customers WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); // Handle any errors with the query
    }

    // Bind the email parameter
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Bind the result to variables
    $stmt->bind_result($id, $first_name, $last_name, $email_db, $hashed_password);

    // Check if a user with the given email was found
    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set the session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email_db;

            // Redirect to index.php after successful login
            header("Location: index.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that email!";
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the database connection
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - China Town</title>
    <link rel="stylesheet" href="main.css">

    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Apply the imported Google Fonts */
        body {
            font-family: 'Open Sans', sans-serif; /* For body text */
            margin: 0;
            padding: 0; 
            background-size: cover; /* Ensure the image covers the entire screen */
            color: #333;
        }

        /* Optional: Add an overlay to improve text contrast */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Black overlay with transparency */
            z-index: -1; /* Ensure overlay stays behind content */
        }

        header {
            background-color: black; /* Transparent background for header */
            padding: 20px 0;
        }

        header .logo {
            font-family: 'Roboto', sans-serif; /* For logo font */
            font-size: 2em;
            color: #fff;
            text-decoration: none;
            padding-left: 20px;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: right;
        }

        header nav ul li {
            display: inline-block;
            margin-left: 20px;
        }

        header nav ul li a {
            font-family: 'Roboto', sans-serif; /* For navigation links */
            font-weight: 500;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            padding: 10px;
        }

        header nav ul li a:hover {
            color: #f1c40f;
        }

        main {
            background-color:black; /* White background with transparency */
            padding: 50px 0;
        }

        .login-section {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .login-section h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 1.8em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form .form-group label {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 1em;
            display: block;
            color: #555;
        }

        .login-form .form-group input {
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            padding: 12px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 8px;
        }

        .login-form .form-group input:focus {
            outline: none;
            border-color: #28a745;
        }

        .login-btn {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 1em;
            color: #fff;
            background-color: #28a745;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            margin-top: 20px;
        }

        .login-btn:hover {
            background-color: #28a745;
        }

        .register-link, .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .register-link p, .forgot-password p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1em;
            color: #555;
        }

        .register-link a, .forgot-password a {
            color: #28a745;
            text-decoration: none;
        }

        .register-link a:hover, .forgot-password a:hover {
            color: #28a745;
        }

        footer {
            background-color:black;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        footer p {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <!-- Overlay for transparency effect -->
    <div class="overlay"></div>

    <header>
        <div class="container">
            <a href="index.html" class="logo">China Town</a>
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
        <section class="login-section">
            <div class="container">
                <h1>Login to Your Account</h1>

                <form action="insertstaff.php" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </form>

                <div class="register-link">
                    <p>Don't have an account? <a href="register.html">Sign up here</a></p>
                </div>

                <div class="forgot-password">
                    <p><a href="forgot-password.html">Forgot your password?</a></p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 China Town UG. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
<?php 
require_once 'db.php'; // Include the database connection

if (!isset($conn)) {
    die("Database connection failed: Please check your db.php file.");
}

// Form submission logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $staff_number = intval($_POST['staff_number']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $email = htmlspecialchars($_POST['email']);
    $category = htmlspecialchars($_POST['category']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO staffs (staff_number, first_name, last_name, phone_number, email, category) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("isssss", $staff_number, $first_name, $last_name, $phone_number, $email, $category);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to index.html on success
        header("Location: index.html");
        exit(); // Ensure no further code execution
    } else {
        if ($stmt->errno == 1062) { // Handle duplicate entries
            $message = "<p style='color: red; text-align: center;'>Error: Duplicate entry for Staff Number or Email!</p>";
        } else {
            $message = "<p style='color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
        }
    }

    $stmt->close(); // Close statement
}
$conn->close(); // Close connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Details Entry</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(9, 9, 9);
            margin: 0;
            padding: 0;
        }
        .form-container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 { text-align: center; color: #333; }
        label {
            display: block; margin-bottom: 8px; font-weight: bold; color: #555;
        }
        input[type="number"], input[type="text"], input[type="email"], select {
            width: 100%; padding: 10px; margin-bottom: 15px;
            border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        button[type="submit"] {
            width: 100%; padding: 12px; background-color: #28a745; color: #fff;
            border: none; border-radius: 4px; cursor: pointer; font-size: 16px;
        }
        button[type="submit"]:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enter Staff Details</h2>
        <?php if (isset($message)) echo $message; ?>
        <form action="" method="post">
            <label for="staff_number">Staff Number:</label>
            <input type="number" id="staff_number" name="staff_number" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Sales Manager">Sales Manager</option>
                <option value="Seller">Seller</option>
                <option value="Delivery Person">Delivery Person</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

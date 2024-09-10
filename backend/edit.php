<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_description = $_POST['product_description'];

// Prepare and execute the SQL statement
$sql = "UPDATE products SET name=?, price=?, description=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdsi", $product_name, $product_price, $product_description, $product_id);

if ($stmt->execute()) {
    echo "Product updated successfully!";
} else {
    echo "Error updating product: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<?php
session_start();
include 'conn.php';

// Fetch products from database
$sql = "SELECT * FROM products";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['product_name'] . "</h3>";
        echo "<p>Price: $" . $row['price'] . "</p>";
        echo "<p>Stock: " . $row['stock_quantity'] . "</p>";
        echo "<form method='POST' action='cart.php'>";
        echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
        echo "<input type='submit' value='Add to Cart'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "No products available.";
}

$con->close();
?>
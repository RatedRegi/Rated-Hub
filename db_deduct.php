<?php

function deduct(){
// Query to fetch the stock quantity
include 'conn.php';
$sql = "SELECT stock_quantity FROM products WHERE product_id = 1"; // Adjust your query
$result = $con->query($sql);


    if ($result->num_rows > 0) {
        // Fetch the quantity
        $row = $result->fetch_assoc();
        $quantity = $row['stock_quantity']; // Store it in a variable
        echo "Current stock quantity: " . $quantity; // Use the variable as needed
    } else {
        echo "No results found.";
    }
    $con->close();
    
}
deduct();
// Close connection

?>
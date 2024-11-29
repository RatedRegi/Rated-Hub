<?php
session_start();
include 'conn.php'; // Make sure this file correctly establishes the $conn variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conn.php'; // Make sure this file correctly establishes the $conn variable
    // Make sure to sanitize and validate input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Consider hashing passwords

    // Prepare and bind
    if ($stmt = $con->prepare("SELECT * FROM customers WHERE email = ? AND password = ?")) {
        $stmt->bind_param("ss", $email, $password);

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a record was found
        if ($result->num_rows > 0) {
            $_SESSION['user_email'] = $email; // Store user email in session
            // Successful login, redirect to customer.html
            header("Location: index.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "Invalid email or password.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
}

// Close the connection
$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
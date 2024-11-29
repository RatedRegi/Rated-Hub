<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'conn.php';

// Set the default time zone for South Africa
date_default_timezone_set('Africa/Johannesburg');

// Create a DateTime object for South Africa time
$dateTime = new DateTime('now', new DateTimeZone('Africa/Johannesburg'));

// Convert to UTC
$dateTime->setTimezone(new DateTimeZone('UTC'));
$created_at_utc = $dateTime->format('Y-m-d H:i:s');


$firstname = $_POST["first_name"];

$lastname = $_POST["last_name"];

$email = $_POST["email"];

$password = $_POST["password"];


$created_at = date('Y-m-d H:i:s');

$updated_at = date('Y-m-d H:i:s');


$sql = "INSERT INTO customers(first_name,	last_name,	email,	password,	created_at,	updated_at) VALUES('$firstname', '$lastname', '$email', '$password', '$created_at', '$updated_at')";

$result = mysqli_query($con, $sql);

if($result){
    echo "data entered successfully";
}else{
    mysqli_error($con);
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Customer Registration</h2>
<form action="registration.php" method="POST">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Register">
</form>

</body>
</html>
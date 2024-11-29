<?php
$hostname="localhost";
$username ="root";
$password="";
$dbname="alumasters";

$con = mysqli_connect($hostname, $username, $password, $dbname);

if($con){
    echo "connected successfully";
}else{
    die($con);
}
?>
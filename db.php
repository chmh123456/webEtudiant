<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "students_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Database connection failed!");
}
?>

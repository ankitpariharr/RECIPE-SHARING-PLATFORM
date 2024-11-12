<?php
$servername = "localhost";
$username = "recipe_sharing";
$password = "";
$dbname = "recipe_sharing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Establish database connection
$host = "localhost";
$username = "root";
$password = "233444";
$database = "Saurabh";
$connection = new mysqli($host, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get the original URL from the AJAX request
$originalUrl = $_POST["url"];

// Generate a unique short code
$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$shortCode = "";
$codeLength = 6;
for ($i = 0; $i < $codeLength; $i++) {
    $randomIndex = rand(0, strlen($characters) - 1);
    $shortCode .= $characters[$randomIndex];
}

// Insert the original URL and short code into the database
$sql = "INSERT INTO urls (original_url, short_code) VALUES ('$originalUrl', '$shortCode')";
if ($connection->query($sql) === TRUE) {
    $shortenedUrl = "http://localhost/redirect.php?code=$shortCode"; // Replace with your actual domain
    echo json_encode(array("shortenedUrl" => $shortenedUrl));
} else {
    echo json_encode(array("error" => "Error: " . $sql . "<br>" . $connection->error));
}

// Close the database connection
$connection->close();
?>

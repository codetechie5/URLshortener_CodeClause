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

// Get the short code from the query string
$shortCode = $_GET["code"];

// Retrieve the original URL from the database
$sql = "SELECT original_url FROM urls WHERE short_code = '$shortCode'";
$result = $connection->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $originalUrl = $row["original_url"];
    header("Location: $originalUrl");
    exit();
} else {
    echo "Invalid URL";
}

// Close the database connection
$connection->close();
?>

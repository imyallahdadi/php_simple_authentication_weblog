<?php




$db_servername = "localhost"; // Or the server IP
$db_username   = "iman";      // Your MySQL username
$db_password   = "1234";          // Your MySQL password
$db_dbname     = "iman_weblog";   // Your database name

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";

?>

<?php 
// Remember to change the username, password, and database name to actual values
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'restaurantDB');

// Create Connection
$link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check Connection
if ($link->connect_error) {
    // if no connection, kill the connection or terminate execution
    die('Connection Failed: ' . $link->connect_error);
} else {
    echo "Connected successfully";
}
?>

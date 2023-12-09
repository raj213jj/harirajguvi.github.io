<?php
$mysqli = new mysqli("localhost", "root", "", "profile");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else{
    echo 'connection successful';
}

// $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
// $mongoDb = $mongoClient->selectDatabase("your_mongo_database_name");

// $redis = new Redis();
// $redis->connect('127.0.0.1', 6379);
?>


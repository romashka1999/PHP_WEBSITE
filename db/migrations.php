<?php

$config = require  'config.php';

$servername = $config['host'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

$conn = new PDO("mysql:host=$servername", $username, $password);

try {
    $sql = "CREATE DATABASE $database";
    $conn->exec($sql);
    echo "Database created successfully" . "<br>";

    $conn->query("use $database");

    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        name VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        picture VARCHAR(255) NOT NULL,
        verification BIT NOT NULL,
        vkey VARCHAR(255) NOT NULL,
        cristal INT NOT NULL,
        reg_date TIMESTAMP
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table \"users\" created successfully" ."<br>";


    $sql = "CREATE TABLE userposts (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        email VARCHAR(255) NOT NULL,
        post_name VARCHAR(50) NOT NULL,
        post_body VARCHAR(1000) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table \"userposts\" created successfully" ."<br>";

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

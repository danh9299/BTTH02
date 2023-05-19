<?php


try {
    $conn = new PDO("mysql:host=localhost;dbname=btth02", 'root', '');
   
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
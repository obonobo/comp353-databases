<?php
 // $server = 'xuc353.encs.concordia.ca';
 // $username = 'xuc353_1';
 // $password = 'C353proj';
 // $database = 'xuc353_1';

$server = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'tester1';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('connection failed: ' . $e->getMessage());
}

?>

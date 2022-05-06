<?php

$host = 'localhost';
$dbname = 'procedure';
$username = 'root';
$password = '';
$charset = 'utf8mb4';
$collate = 'utf8mb4_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT         => false,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate",
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (Exception $exception) {
    throw new RuntimeException('Error establishing a database connection.');
}
<?php
$dbHost = 'localhost';
$dbName = 'your_database_name';
$dbUser = 'your_database_username';
$dbPass = 'your_database_password';

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

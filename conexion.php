<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'books');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

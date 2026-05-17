<?php
// Configurações de conexão com banco de dados usando PDO
define('DB_HOST', 'localhost');
define('DB_NAME', 'lupiere');
define('DB_USER', 'root');
define('DB_PASS', '');
define('CHARSET', 'utf8mb4');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . CHARSET, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    exit('Erro de conexão com o banco de dados: ' . $e->getMessage());
}
?>
<?php
// Configuração local: não colocar passwords no repositório.
function ligarBD() {
    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $db = getenv('DB_NAME') ?: 'sala_livre';
    $user = getenv('DB_USER') ?: 'root';
    // AMPPS: configurar DB_PASSWORD no ambiente ou em config.local.php (ignorado pelo Git).
    if (is_file(__DIR__ . '/config.local.php')) {
        $local = require __DIR__ . '/config.local.php';
        if (is_array($local)) {
            $host = $local['DB_HOST'] ?? $host;
            $db = $local['DB_NAME'] ?? $db;
            $user = $local['DB_USER'] ?? $user;
        }
    } else {
        $local = [];
    }
    $pass = $local['DB_PASSWORD'] ?? getenv('DB_PASSWORD');
    if ($pass === false) { $pass = ''; }
    
    try {
        return new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
    } catch (PDOException $e) {
        error_log('Falha de ligação à base de dados');
        return null;
    }
}
function consultarBD($sql, $params = []) {
    $conn = ligarBD();

    if (!$conn) { throw new RuntimeException('Base de dados indisponível'); }
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

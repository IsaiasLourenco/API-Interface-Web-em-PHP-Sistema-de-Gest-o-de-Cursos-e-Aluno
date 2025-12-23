<?php
$host = 'localhost';
$dbname = 'escola';
$user = 'root';
$senha = '';
$charset = 'utf8mb4';

$datasetName = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($datasetName, $user, $senha, $options);
} catch (\PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
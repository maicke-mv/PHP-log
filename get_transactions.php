<?php
// get_transactions.php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=Localhost;dbname=usuarios', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM transacoes ORDER BY data DESC');
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($transactions);
} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Erro ao conectar com o banco de dados: ' . $e->getMessage()
    ]);
}
?>
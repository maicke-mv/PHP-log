<?php
// process.php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=Localhost;dbname=usuarios', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo = $_POST['tipo'];
        $descricao = $_POST['descricao'];
        $valor = floatval($_POST['valor']);
        $data = $_POST['data'];

        $stmt = $pdo->prepare('INSERT INTO transacoes (tipo, descricao, valor, data) VALUES (?, ?, ?, ?)');
        $stmt->execute([$tipo, $descricao, $valor, $data]);

        echo json_encode(['success' => true]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao conectar com o banco de dados: ' . $e->getMessage()
    ]);
}
?>
<?php 
    session_start();
    if(!isset($_SESSION['logado'])) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle Financeiro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .transactions {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .receita {
            color: green;
        }
        .despesa {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Controle Financeiro</h1>
    
    <form id="transactionForm" action="process.php" method="POST">
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="receita">Receita</option>
                <option value="despesa">Despesa</option>
            </select>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
        </div>

        <button type="submit">Registrar</button>
    </form>

    <div class="transactions">
        <h2>Registros</h2>
        <table id="transactionsTable">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody id="transactionsBody">
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registro salvo com sucesso!');
                    loadTransactions();
                    this.reset();
                } else {
                    alert('Erro ao salvar registro: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao processar a requisição');
            });
        });

        function loadTransactions() {
            fetch('get_transactions.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('transactionsBody');
                tbody.innerHTML = '';
                
                data.forEach(transaction => {
                    const row = document.createElement('tr');
                    const classType = transaction.tipo === 'receita' ? 'receita' : 'despesa';
                    
                    row.innerHTML = `
                        <td>${transaction.data}</td>
                        <td>${transaction.tipo}</td>
                        <td>${transaction.descricao}</td>
                        <td class="${classType}">R$ ${parseFloat(transaction.valor).toFixed(2)}</td>
                    `;
                    
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Erro:', error));
        }

        // Carrega as transações ao iniciar a página
        loadTransactions();
    </script>
</body>
</html>
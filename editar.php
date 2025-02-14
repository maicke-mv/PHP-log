<?php
    session_start();
    if(!isset($_SESSION['logado'])) {
        header("Location: index.php");
        exit;
    }

    include_once('config.php');

    if(!isset($_GET['id'])) {
        header('Location: test.php');
        exit();
    }

    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM usuarios_sistema WHERE id=$id";
    $result = mysqli_query($conexao, $sqlSelect);

    if($result->num_rows > 0) {
        $user_data = mysqli_fetch_assoc($result);
    } else {
        header('Location: test.php');
        exit();
    }

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sqlUpdate = "UPDATE usuarios_sistema SET email='$email', senha='$senha' WHERE id='$id'";
        
        if(mysqli_query($conexao, $sqlUpdate)) {
            header('Location: test.php');
            exit();
        } else {
            echo "Erro ao atualizar: " . mysqli_error($conexao);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        div {
            margin: auto;
            margin-top: 75px;
            background-color: aquamarine;
            width: fit-content;
            padding: 25px;
            border-radius: 10px;
        }
        .btn-update {
            background-color: #4CAF50;
            margin-top: 10px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Editar Usuário</h1>
    <div>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
            
            <label for="email">Email:</label><br>
            <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required><br>
            
            <label for="senha">Senha:</label><br>
            <input type="text" name="senha" value="<?php echo $user_data['senha']; ?>" required><br>
            
            <input type="submit" name="update" value="Atualizar" class="btn-update">
        </form>
        <button onclick="window.location.href='test.php'">Voltar</button>
    </div>
</body>
</html>
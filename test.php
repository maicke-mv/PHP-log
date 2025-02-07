<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuários</title>
    <style>
        div {
            margin: auto;
            margin-top: 75px;
            background-color: aquamarine;
            width: fit-content;
            padding: 25px;
            border-radius: 10px;
        }
        button.voltar {
            display: flex;
            justify-content: center;
            text-decoration: none;
}
    </style>
</head>
<body>
    
<div>
    <?php
    
        include_once('config.php');
        if(isset($_POST['submit'])){
            include_once('config.php');
            $email = $_POST['email'];
            $senha = $_POST['senha'];
    
            $result = mysqli_query($conexao, "INSERT INTO usuarios_sistema(email, senha) VALUES ('$email', '$senha')");
        }
    
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sqlDelete = "DELETE FROM usuarios_sistema WHERE id='$id'";
            mysqli_query($conexao, $sqlDelete);
            header('Location: test.php');
            exit();
        }
    
        $result = mysqli_query($conexao, 'SELECT * FROM usuarios_sistema');
    
        if(mysqli_num_rows($result) > 0) {
        echo "<ul>";
        while($user_data = mysqli_fetch_assoc($result)) {
            echo "<li>
                Email: " . $user_data['email'] . " -
                Senha: " . $user_data['senha'] . "
                <a href='test.php?id=" . $user_data['id'] . "'>
            <button>Deletar</button>
        </a>
            </li>";
        }
        echo "</ul>";
        } else {
        echo "Nenhum registro encontrado";
        }
    ?>
</div> 

<button class="voltar" onclick="window.location.href='index.php'">Voltar</button>
</body>
</html>
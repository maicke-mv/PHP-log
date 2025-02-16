<?php
session_start(); // Inicia a sessão

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com banco de dados
    
    $conn = mysqli_connect("Localhost", "root", "", "usuarios");

    // Recebe dados do formulário
    $username = $_POST['email'];
    $password = $_POST['senha'];

    // Consulta ao banco
    $query = "SELECT * FROM usuarios_sistema WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Login bem sucedido
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $username;
        header("Location: test.php");
    } else {
        $erro = "Usuário ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <div id="login">

            <h1>Login com PHP e REACT</h1>

            <input type="email" name="email" id="email" required><br>
            <input type="password" name="senha" id="senha"><br>
            <input type="submit" name= "submit" value="submit" id="submit">
        </div>
    </form>  
        <?php if(isset($erro)) { ?>
            <p style="color: red"><?php echo $erro; ?></p>
        <?php } ?>
        <?php 
            /*if(isset($_POST['submit'])){
            print_r($_POST['email']);
           print_r('<br>');
            print_r($_POST['senha']);
        }else{
            echo "DEU ERRO!";
        }*/
        ?>
</body>
</html>
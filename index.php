<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="test.php" method="POST">
        <div id="login">
            <h1>Login</h1>
            <input type="email" name="email" id="email" required><br>
            <input type="password" name="senha" id="senha"><br>
            <input type="submit" name= "submit" value="submit" id="submit">
        </div>
    </form> 
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
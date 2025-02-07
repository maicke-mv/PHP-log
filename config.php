<?php 
    $dbhost = 'Localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = 'usuarios';

    $conexao = new mysqli($dbhost, $dbUsername, $dbpassword, $dbname);

    //if($conexao->connect_errno) {
    //    echo "Erro";
    //} else {
    //    echo "Conexão efetuada com sucesso";
    //}
?>
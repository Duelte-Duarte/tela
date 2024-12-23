<?php

$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "sistema_login";

$conexao = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

if ($conexao->connect_errno) {
    echo 'Erro';
}

// Receber os dados do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = ($_POST['password']);

    // Verificar as credenciais no banco de dados
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login bem-sucedido! <a href='defensores.html'>Acessar</a>";
    } else {
        echo "Usuário ou senha inválidos.";
    }

    $stmt->close();
}

$conexao->close();
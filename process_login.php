<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "sistema_login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber os dados do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = ($_POST['password']);

    // Verificar as credenciais no banco de dados
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login bem-sucedido!";
    } else {
        echo "Usuário ou senha inválidos.";
    }

    $stmt->close();
}

$conn->close();
?>

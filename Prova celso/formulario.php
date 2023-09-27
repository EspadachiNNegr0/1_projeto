<?php

// Configuração do banco de dados

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuario";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recupera os valores enviados pelo formulário
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Prepara a consulta SQL para inserir os dados no banco de dados
  $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

  // Executa a consulta SQL
  if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
  } else {
    echo "Erro ao cadastrar: " . $conn->error;
  }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Redireciona para a página de login após 3 segundos
echo '<meta http-equiv="refresh" content="3;url=Login.html">';
?>

<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuario";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recupera os valores enviados pelo formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Escapa os valores para evitar ataques de SQL Injection
  $email = mysqli_real_escape_string($conn, $email);
  $senha = mysqli_real_escape_string($conn, $senha);

  // Cria a consulta SQL para verificar se o email e a senha são válidos
  $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";

  // Executa a consulta SQL
  $result = $conn->query($sql);

  // Verifica se o resultado da consulta tem pelo menos uma linha
  if ($result->num_rows > 0) {
    // Se o login for bem-sucedido, redireciona o usuário para a página principal
    header("Location: principal.html");
    exit;
  } else {
    // Se o login falhar, exibe uma mensagem de erro
    echo "Email ou senha inválidos!";
  }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
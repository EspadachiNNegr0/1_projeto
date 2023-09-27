<!DOCTYPE html>
<html>
<head>
	<title>Estatísticas de E-mails Cadastrados</title>
	<style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        	 background-color: black;
	
			 
            background-color: rgba(54, 53, 53, 0.9);
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px;
            border-radius: 15px;
            color: white;
        
            
        
            box-shadow: 0 0 15px #641aaa, inset 0 0 15px #aa1a92;
            text-shadow:  0 0 15px #aa1a69;
            transition all: 0.2s ease-in-out;
       
            text-align: center;
            margin-top: 10px;
            margin: 50px;
            padding: 20px;
            background-color: black;
            text-align: center;
            border-radius: 15px;
            border: 20px;
            
        }
        
    </style>
</head>
<body>
    

	<h1>Estatísticas de E-mails Cadastrados</h1>

	<?php

	// Configuração de conexão com o banco de dados
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "usuario";

	// Conexão com o banco de dados
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Verifica se ocorreu um erro de conexão
	if ($conn->connect_error) {
	    die("Falha na conexão: " . $conn->connect_error);
	}

	// Query para buscar o total de e-mails cadastrados na tabela usuario
	$sql_total = "SELECT COUNT(email) AS total FROM usuarios";

	// Executa a query
	$result_total = $conn->query($sql_total);

	// Verifica se a query retornou algum resultado
	if ($result_total->num_rows > 0) {

	    // Exibe o total de e-mails cadastrados
	    while($row_total = $result_total->fetch_assoc()) {
	        echo "<p>Total de e-mails cadastrados: " . $row_total["total"] . "</p>";
	    }

	}

	// Verifica se o formulário foi enviado
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  // Pega o valor do campo de e-mail
	  $email = $_POST["email"];

	  // Query para buscar o valor de contador_envio na tabela usuario
	  $sql_contador = "SELECT contador_envio FROM usuarios WHERE email = '$email'";

	  // Executa a query
	  $result_contador = $conn->query($sql_contador);

	  // Verifica se a query retornou algum resultado
	  if ($result_contador->num_rows > 0) {

	    // Exibe o valor de contador_envio
	    while($row_contador = $result_contador->fetch_assoc()) {
	        echo "<p>O número do e-mail cadastrado  " . $email . " é: " . $row_contador["contador_envio"] . "</p>";
	    }
	  
	  } else {
	    echo "<p>E-mail não encontrado</p>";
	  }

	}

	// Fecha a conexão com o banco de dados
	$conn->close();

	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  E-mail: <input type="text" name="email">
	  <input type="submit" value="Enviar">
	</form>

</body>
</html>

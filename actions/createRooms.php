<?php
// Conecta ao DB
require "connect.php";

// Prepara as variáveis de consulta SQL
$roomName = isset($_POST["roomName"]) ? $_POST["roomName"] : null;

// Define roomState como 1 se não estiver definido
$roomState = isset($_POST["roomState"]) ? $_POST["roomState"] : 1;

// Verifica se o nome da sala é válido (não vazio)
if (empty(trim($roomName))) {
	echo "Erro: Nome de sala inválido.";
	exit();
}

// Cria uma instância de PDO
$dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);

if ($roomName !== null) {
	// Prepara a consulta SQL usando prepared statements
	$stmt = $dbh->prepare("INSERT INTO room (roomName, roomState, roomBirth) VALUES (:roomName, :roomState, NOW())");
	$stmt->bindParam(':roomName', $roomName, PDO::PARAM_STR);
	$stmt->bindParam(':roomState', $roomState, PDO::PARAM_INT); // Alterado para PARAM_INT
	$stmt->execute();

	// Verifica se ocorreu algum erro ao executar a consulta
	if ($stmt->errorCode() != "00000") {
		// Trata o erro aqui
		echo "Erro ao criar sala: " . $stmt->errorInfo()[2];
	} else {
		// Obtém o ID da sala recém-criada
		$newRoomId = $dbh->lastInsertId();

		// Redireciona para a sala recém-criada
		header("Location: ../?roomId=" . $newRoomId);
		exit();
	}
} else {
	header("Location: ../");
	exit();
}

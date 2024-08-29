<?php
require "connect.php";

function redirectWithError($message, $roomId = 1)
{
	header("Location: ../?error=" . urlencode($message) . "&roomId=" . $roomId);
	exit();
}

try {
	// Verifica se os campos essenciais foram enviados
	if (!isset($_POST["username"], $_POST["post"], $_POST["roomId"])) {
		throw new Exception("Parâmetros ausentes. Certifique-se de fornecer username, post e roomId.");
	}

	$user = $_POST["username"];
	$msg = $_POST["post"];
	$roomId = $_POST["roomId"];

	$dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);

	if ($roomId != 1) {
		$stmtCheckRoom = $dbh->prepare("SELECT COUNT(*) FROM room WHERE roomId = :roomId");
		$stmtCheckRoom->bindParam(':roomId', $roomId, PDO::PARAM_INT);
		$stmtCheckRoom->execute();
		$roomExists = $stmtCheckRoom->fetchColumn();

		if (!$roomExists) {
			throw new Exception("Erro: ID de sala inválida.");
		}
	}

	$msg = nl2br($msg);

	$stmt = $dbh->prepare("INSERT INTO chat (roomId, username, post) VALUES (:roomId, :username, :post)");
	$stmt->bindParam(':roomId', $roomId, PDO::PARAM_INT);
	$stmt->bindParam(':username', $user, PDO::PARAM_STR);
	$stmt->bindParam(':post', $msg, PDO::PARAM_STR);
	$stmt->execute();

	if ($stmt->errorCode() != "00000") {
		throw new Exception("Erro ao enviar mensagem.");
	} else {
		// Verifica se a sala ainda existe
		$stmtCheckRoom = $dbh->prepare("SELECT COUNT(*) FROM room WHERE roomId = :roomId");
		$stmtCheckRoom->bindParam(':roomId', $roomId, PDO::PARAM_INT);
		$stmtCheckRoom->execute();
		$roomExists = $stmtCheckRoom->fetchColumn();

		if (!$roomExists) {
			// Se a sala padrão (ID 1) foi destruída, redireciona para a sala padrão
			redirectWithError("Sala destruída. Redirecionando para a sala padrão.", 1);
		} else {
			// Limpa o campo de texto (mensagem) e mantém o campo de nome de usuário preenchido
			header("Location: ../?roomId=" . $roomId . "&username=" . urlencode($user));
			exit();
		}
	}
} catch (Exception $e) {
	redirectWithError("Erro interno: " . $e->getMessage());
}

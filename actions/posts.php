<?php
require "connect.php";

$roomId = filter_input(INPUT_GET, 'roomId', FILTER_VALIDATE_INT);

if ($roomId === null || $roomId === false || $roomId <= 0) {
	echo "Erro: ID de sala inválida.";
	exit();
}

$stmt = $pdo->prepare("SELECT * FROM chat WHERE roomId = :roomId ORDER BY id DESC");
$stmt->bindParam(':roomId', $roomId, PDO::PARAM_INT);
$stmt->execute();

while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
	echo "<fieldset class='border'>";
	if (!empty($data->username)) {
		echo "<legend>" . $data->username . "</legend>";
	}
	echo "<p class='flex gap'>" . $data->post . "</p>";
	echo "</fieldset>";
}

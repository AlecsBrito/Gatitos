<?php
// Conecta ao DB
require "connect.php";

// Cria uma instância de PDO
$dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);

// Prepara a consulta SQL
$stmt = $dbh->prepare("SELECT * FROM chat ORDER BY id DESC");
$stmt->execute();

// Itera pelos resultados usando um loop while
while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
	echo "<fieldset class='border'>";
	if (!empty($data->username)) {
		echo "<legend>" . $data->username . "</legend>";
	}
	echo "<p class='flex gap'>" . $data->post . "</p>";
	echo "</fieldset>";
}

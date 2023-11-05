<?php
// Conecta ao DB
require "connect.php";

// Prepara as variaveis de consulta SQL
$user = $_POST["username"];
$msg = $_POST["post"];

// Cria uma instância de PDO
$dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);

// Converte quebras de linha em tags HTML <br>
$msg = nl2br($_POST["post"]);

// Prepara a consulta SQL usando prepared statements
$stmt = $dbh->prepare("INSERT INTO chat (username, post) VALUES (:username, :post)");
$stmt->bindParam(':username', $user, PDO::PARAM_STR);
$stmt->bindParam(':post', $msg, PDO::PARAM_STR);
$stmt->execute();

// Verifica se ocorreu algum erro ao executar a consulta
if ($stmt->errorCode() != "00000") {
    // Trata o erro aqui
} else {
    // Redireciona para a página principal
    header("Location: ../");
    exit();
}

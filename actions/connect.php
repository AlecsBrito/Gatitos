<?php
// Define as constantes de conexão com o banco de dados
const DB_SERVER = 'SERVER';
const DB_USERNAME = 'USERNAME';
const DB_PASSWORD = 'PASSWORD';
const DB_DATABASE = 'DATABASE';

try {
  // Cria uma nova instância do PDO e conecta ao banco de dados
  $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);

  // Define o modo de erro do PDO como exceção
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Desativa a emulação de prepared statements para evitar ataques de injeção de SQL
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  // Define o conjunto de caracteres a ser usado na conexão com o banco de dados
  $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
  // Em caso de erro na conexão, exibe uma mensagem de erro e encerra a execução do script
  die("Erro de conexão: " . $e->getMessage());
}

<?php
date_default_timezone_set('America/Sao_Paulo');

$servername = "localhost";
$username = "root";
$password = "123456";
$banco = "biblioteca";

try {
  $pdo = new PDO("mysql:dbname=$banco;host=$servername", $username, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Conexão falhou: " . $e->getMessage();
}
?>
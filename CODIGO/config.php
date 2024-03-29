<?php
$host = "localhost";
$port = "5432"; 
$dbname = "UPLOAD";
$user = "seu_user";
$password = "sua_senha";

// Estabelece a conexão
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verifica a conexão
if (!$conn) {
    die("Conexão falhou: " . pg_last_error());
}
?>

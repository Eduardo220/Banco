<?php 

declare (strict_types=1); // Declaração de tipos estritos, forçando o uso de tipos corretos nas funções e métodos

$pdo = require 'connect.php'; // Inclui o arquivo de conexão com o banco de dados e armazena a conexão na variável $pdo
$sql = 'insert into usuario (name, email) values (?, ?)'; // Define a consulta SQL para inserir um novo registro na tabela 'usuario'

$prepare = $pdo->prepare($sql); // Prepara a consulta SQL para execução
$prepare -> bindParam(1, $_POST['name']); // Associa o primeiro parâmetro da consulta ao valor do campo 'name' enviado via GET
$prepare -> bindParam(2, $_POST['email']); // Associa o segundo parâmetro da consulta ao valor do campo 'email' enviado via GET
$prepare -> execute(); // Executa a consulta SQL com os parâmetros associados

echo $prepare->rowCount() . " linha(s) inserida(s)."; // Exibe o número de linhas afetadas pela consulta
echo "<br><a href='list.php'>Voltar</a>"; // Link para voltar à lista de usuários

?>

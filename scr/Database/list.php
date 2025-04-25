<?php 

declare (strict_types=1); // Declaração de tipos estritos, forçando o uso de tipos corretos nas funções e métodos

$pdo = require 'connect.php'; // Inclui o arquivo de conexão com o banco de dados e armazena a conexão na variável $pdo
$sql = 'select * from usuario'; // Define a consulta SQL para selecionar todos os registros da tabela 'produtos'

echo "<h1>Lista de Usuários</h1>"; // Exibe o título da página

foreach ($pdo->query($sql) as $key => $value) #$pdo->query($sql) executa a consulta SQL e retorna um objeto, o loop foreach percorre cada linha retornada pela consulta.
{
    echo 'Id: ' . $value['id'] . '<br> Nome: ' . $value['name'] . '<hr>'; // Exibe o ID do usuário e o nome
}

?>

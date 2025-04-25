<?php 

declare(strict_types=1); // Declaração de tipos estritos, forçando o uso de tipos corretos nas funções e métodos

$pdo = null; // Inicializa a variável $pdo como nula, que será usada para armazenar a conexão com o banco de dados

try {
    // Cria uma nova conexão PDO com o banco de dados MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=banco', 'root', ''); // Substitua os valores conforme necessário
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro para exceções
    echo "Conexão com o banco de dados estabelecida com sucesso!"; // Mensagem de sucesso
} catch (Exception $e) {
    // Captura qualquer outra exceção e exibe uma mensagem de erro
    echo "Erro inesperado: " . $e->getMessage(); // Exibe a mensagem de erro
}
return $pdo; // Retorna a conexão PDO, que pode ser usada em outras partes do código

?>

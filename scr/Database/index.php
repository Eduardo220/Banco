<?php 

require 'Produto.php'; // Inclui a classe Produto

$produto = new Produto(); // Cria uma nova instância da classe Produto

switch ($_GET['operacao']) 
{	
    case 'list':
        echo "<h1>Lista de Produtos</h1>"; // Exibe o título da página

        $produtos = $produto->list(); // Chama o método list() da classe Produto
        if (empty($produtos)) {
            echo "Nenhum produto encontrado."; // Exibe mensagem se não houver produtos
        } else {
            foreach ($produtos as $value) { // Percorre cada produto retornado pela consulta
                echo 'Id: ' . $value['id'] . '<br> Nome: ' . $value['name'] . '<hr>'; // Exibe o ID e o nome do produto
            }
        }
        break; // Encerra o caso 'list'

    case 'insert':
        $status = $produto->insert($_GET['name']); // Chama o método insert() com o nome enviado via GET
        
        if ($status) {
            echo "Produto inserido com sucesso!"; // Mensagem de sucesso
        } else {
            echo "Erro ao inserir o produto."; // Mensagem de erro se a inserção falhar
        }
        echo "<br><a href='list.php'>Voltar</a>"; // Link para voltar à lista de produtos
        break; // Encerra o caso 'insert'
    
    case 'update':
        $status = $produto->update($_GET['id'], $_GET['name']); // Chama o método update() com o ID e o nome enviados via GET
        
        if ($status) {
            echo "Produto atualizado com sucesso!"; // Mensagem de sucesso
        } else {
            echo "Erro ao atualizar o produto."; // Mensagem de erro se a atualização falhar
        }
        echo "<br><a href='list.php'>Voltar</a>"; // Link para voltar à lista de produtos
        break; // Encerra o caso 'update'
        
    case 'delete':
        $status = $produto->delete($_GET['id']); // Chama o método delete() com o ID enviado via GET
        
        if ($status) {
            echo "Produto deletado com sucesso!"; // Mensagem de sucesso
        } else {
            echo "Erro ao deletar o produto."; // Mensagem de erro se a deleção falhar
        }
        echo "<br><a href='list.php'>Voltar</a>"; // Link para voltar à lista de produtos
        break; // Encerra o caso 'delete'
        
    default:
        echo "Ação inválida."; // Mensagem de erro para ação inválida
}

?>
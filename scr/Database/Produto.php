<?php 

declare (strict_types=1); // Declaração de tipos estritos, forçando o uso de tipos corretos nas funções e métodos

class Produto
{
    private $conexao;

    public function __construct()
    {
        try {
            $this->conexao = new PDO('mysql:host=localhost;dbname=banco', 'root', '');
        } catch (Exception $e) {
            echo $e->getMessage(); // Exibe a mensagem de erro
            die(); // Encerra o script em caso de erro na conexão
        }
    }

    public function list(): array
    {
        $sql = 'select * from usuario'; // Define a consulta SQL para selecionar todos os registros da tabela 'produtos'

        $produtos = []; // Inicializa um array vazio para armazenar os produtos

        foreach ($this->conexao->query($sql) as $key => $value) #$pdo->query($sql) executa a consulta SQL e retorna um objeto, o loop foreach percorre cada linha retornada pela consulta.
        {
            array_push($produtos, $value); // Adiciona cada produto ao array de produtos
        }
        
        return $produtos; // Retorna o array de produtos
    }

    public function insert(string $name): string
    {
        $sql = 'insert into usuario (name) values (?)'; // Define a consulta SQL para inserir um novo registro na tabela 'usuario'

        $prepare = $this->conexao->prepare($sql); // Prepara a consulta SQL para execução

        $prepare -> bindParam(1, $name); // Associa o primeiro parâmetro da consulta ao valor do campo 'name' enviado via GET
        $prepare -> execute(); // Executa a consulta SQL com os parâmetros associados

        return $prepare->rowCount() . " linha(s) inserida(s)."; // Exibe o número de linhas afetadas pela consulta
        echo "<br><a href='operacao=list.php'>Voltar</a>"; // Link para voltar à lista de usuários
    }

    public function update(string $name, int $id): string
    {
        $sql = 'update usuario set name = ? where id = ?'; // Define a consulta SQL para atualizar o registro na tabela 'usuario'

        $prepare = $this->conexao->prepare($sql); // Prepara a consulta SQL para execução

        $prepare -> bindParam(1, $name); // Associa o primeiro parâmetro da consulta ao valor do campo 'name' enviado via GET
        $prepare -> bindParam(2, $id); // Associa o segundo parâmetro da consulta ao valor do campo 'id' enviado via GET    

        $prepare -> execute(); // Executa a consulta SQL com os parâmetros associados

        return $prepare->rowCount() . " linha(s) atualizada(s)."; // Exibe o número de linhas afetadas pela consulta
        echo "<br><a href='list.php'>Voltar</a>"; // Link para voltar à lista de usuários
    }

    public function delete(int $id): string
    {
        $sql = 'delete from usuario where id = ?'; // Define a consulta SQL para deletar um registro na tabela 'usuario'

        $prepare = $this->conexao->prepare($sql); // Prepara a consulta SQL para execução
        $prepare -> bindParam(1, $id); // Associa o primeiro parâmetro da consulta ao valor do campo 'id' enviado via GET
        $prepare -> execute(); // Executa a consulta SQL com os parâmetros associados

        return $prepare->rowCount() . " linha(s) deletada(s)."; // Exibe o número de linhas afetadas pela consulta
        echo "<br><a href='list.php'>Voltar</a>"; // Link para voltar à lista de usuários       
    }
}

?>
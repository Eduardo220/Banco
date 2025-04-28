<?php 

declare(strict_types=1); // Declaração de tipos estritos

class Usuario 
{
    private $conexao;

    public function __construct()
    {
        try {
            $this->conexao = new PDO('mysql:host=localhost;dbname=banco', 'root', ''); // Conexão com o banco de dados
        } catch (Exception $e) {
            echo $e->getMessage(); // Exibe a mensagem de erro
            die(); // Encerra o script em caso de erro
        }
    }

    // Função de login
    public function login(string $name, string $password): bool
    {
        $sql = 'SELECT * FROM usuario WHERE name = ?'; // Consulta SQL para buscar o usuário pelo nome

        $prepare = $this->conexao->prepare($sql); // Prepara a consulta
        $prepare->bindParam(1, $name); // Associa o nome do usuário
        $prepare->execute(); // Executa a consulta

        $usuario = $prepare->fetch(PDO::FETCH_ASSOC); // Obtém o usuário

        // Verifica se o usuário foi encontrado e se a senha corresponde
        if ($usuario && password_verify($password, $usuario['password'])) {
            return true; // Login bem-sucedido
        }

        return false; // Senha ou usuário incorretos
    }

    // Função para registrar um novo usuário
    public function register(string $name, string $password): string
    {
        // Hash da senha para segurança
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO usuario (name, password) VALUES (?, ?)'; // SQL para inserir um novo usuário

        $prepare = $this->conexao->prepare($sql); // Prepara a consulta
        $prepare->bindParam(1, $name); // Associa o nome do usuário
        $prepare->bindParam(2, $hashedPassword); // Associa a senha hash

        $prepare->execute(); // Executa a consulta

        return "Usuário registrado com sucesso!";
    }
}

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
        echo "Usuário ou senha inválidos."; // Mensagem de erro
    }

    public function register(string $name, string $email, string $gender, string $birth_date, string $password): string

    {
        // Verificar se todos os campos estão preenchidos
        if (empty($name) || empty($email) || empty($gender) || empty($birth_date) || empty($password)) {
            return "Preencha todos os campos obrigatórios.";
        }

        // Verificar se o email é válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "E-mail inválido.";
        }

        // Verificar se a senha tem pelo menos 6 caracteres
        if (strlen($password) < 6) {
            return "A senha deve ter pelo menos 6 caracteres.";
        }

        // Verificar se a data de nascimento é válida
        $date = DateTime::createFromFormat('Y-m-d', $birth_date);
        if (!$date || $date->format('Y-m-d') !== $birth_date) {
            return "Data de nascimento inválida.";
        }

        // Verificar se o gênero é válido
        $validGenders = ['Masculino', 'Feminino', 'Outro'];
        if (!in_array($gender, $validGenders)) {
            return "Gênero inválido.";
        }

        // Verificar se o nome tem pelo menos 3 caracteres
        if (strlen($name) < 3) {
            return "O nome deve ter pelo menos 3 caracteres.";
        }

        // Verificar se o email já existe
        $sql = 'SELECT * FROM usuario WHERE email = ?';
        $prepare = $this->conexao->prepare($sql);
        $prepare->bindParam(1, $email);
        $prepare->execute();
        if ($prepare->fetch()) {
            return "E-mail já cadastrado.";
        }

        // Hash da senha para segurança
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuario (name, email, gender, birth_date, password) VALUES (?, ?, ?, ?, ?)';

        $prepare = $this->conexao->prepare($sql);
        $prepare->bindParam(1, $name);
        $prepare->bindParam(2, $email);
        $prepare->bindParam(3, $gender);
        $prepare->bindParam(4, $birth_date);
        $prepare->bindParam(5, $hashedPassword);

        $prepare->execute();

        return "Usuário registrado com sucesso!";
    }
}

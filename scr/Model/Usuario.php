<?php

declare(strict_types=1);

class Usuario
{
    private PDO $conexao;

    public function __construct()
    {
        try {
            $this->conexao = new PDO('mysql:host=localhost;dbname=banco', 'root', '');
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Erro na conexão com o banco: " . $e->getMessage());
        }
    }

    public function register(string $name, string $email, string $gender, string $birth_date, string $password): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "E-mail inválido.";
        }

        if (!in_array($gender, ['male', 'female', 'other'])) {
            return "Gênero inválido.";
        }

        $dateObj = DateTime::createFromFormat('Y-m-d', $birth_date);
        if (!$dateObj || $dateObj > new DateTime()) {
            return "Data de nascimento inválida.";
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = 'INSERT INTO usuario (name, email, gender, birth_date, password) VALUES (?, ?, ?, ?, ?)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute([$name, $email, $gender, $birth_date, $hash]);
            return "Usuário cadastrado com sucesso!" . "<br><a href='../View/Login.html'>Clique aqui para fazer login</a>";
            
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                return "E-mail já está cadastrado.";
            }
            return "Erro ao cadastrar: " . $e->getMessage();
        }
    }

    public function login(string $email, string $password): bool
    {
        $stmt = $this->conexao->prepare('SELECT password FROM usuario WHERE email = ?');
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user && password_verify($password, $user['password']);
    }
}

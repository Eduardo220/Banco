<?php
require 'Usuario.php';

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $birth_date = trim($_POST['birth_date'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Verificar se todos os campos estão preenchidos
    if (empty($name) || empty($email) || empty($gender) || empty($birth_date) || empty($password) || empty($confirm_password)) {
        echo "Preencha todos os campos obrigatórios.";
        exit;
    }

    // Verificar se as senhas coincidem
    if ($password !== $confirm_password) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Aqui você poderia também validar o formato do e-mail, a data de nascimento, etc.

    // Registrar usuário (por enquanto só usando nome e senha, porque sua classe atual não grava e-mail, gênero e nascimento)
    echo $usuario->register($name, $password);
}

?>

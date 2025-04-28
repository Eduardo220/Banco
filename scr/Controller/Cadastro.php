<?php
require_once __DIR__ . '/../Model/Usuario.php';

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

    echo $usuario->register($name, $email, $gender, $birth_date, $password);
}

?>

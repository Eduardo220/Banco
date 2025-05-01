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
// Verificações básicas
    if (empty($name) || empty($email) || empty($gender) || empty($birth_date) || empty($password) || empty($confirm_password)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "As senhas não coincidem.";
        exit;
    }

    if (strlen($password) < 6) {
        echo "A senha deve conter no mínimo 6 caracteres.";
        exit;
    }

    // Converter data se necessário (vindo em d-m-Y)
    $dateObj = DateTime::createFromFormat('Y-m-d', $birth_date) ?: DateTime::createFromFormat('d-m-Y', $birth_date);
    if (!$dateObj || $dateObj > new DateTime()) {
        echo "Data de nascimento inválida.";
        exit;
    }

    $birth_date = $dateObj->format('Y-m-d');
    echo $usuario->register($name, $email, $gender, $birth_date, $password);
} else {
// Se não for uma requisição POST, redireciona para a página de cadastro
    header('Location: ../View/Cadastro.html');
    exit;
}

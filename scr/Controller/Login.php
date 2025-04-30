<?php
require_once __DIR__ . '/../Model/Usuario.php';

session_start();

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido.";
        exit;
    }

    if ($usuario->login($email, $password)) {
        $_SESSION['user'] = $email;
        header('Location: ../View/Painel.php');
        exit;
    } else {
        echo "Usuário ou senha inválidos.";
    }
}

?>

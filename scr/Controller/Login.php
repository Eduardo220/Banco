<?php
require_once __DIR__ . '/../Model/Usuario.php';
session_start();

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Preencha todos os campos.";
        exit;
    }

    if ($usuario->login($username, $password)) {
        session_start();
        $_SESSION['user'] = $username; // Armazenar o nome de usuário na sessão
        echo "Login realizado com sucesso!"; 
        header('Location: painel.php'); // Redirecionar para uma página protegida
        exit;
    } else {
        echo "Usuário ou senha inválidos.";
    }
}
?>

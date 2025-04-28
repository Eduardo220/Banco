<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: Login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    <a href="../View/Logout.php">Sair</a>
</body>
</html>

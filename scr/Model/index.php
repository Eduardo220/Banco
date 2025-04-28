<?php 

require 'Usuario.php'; // Inclui a classe Usuario (novo nome)

$usuario = new Usuario(); // Cria uma nova instância da classe Usuario

// Verifica se o parâmetro 'operacao' foi enviado
$operacao = $_GET['operacao'] ?? null;

if (!$operacao) {
    echo "Nenhuma operação selecionada.";
    exit;
}

switch ($operacao) 
{
    case 'register':
        if (!isset($_GET['name']) || !isset($_GET['password'])) {
            echo "Nome e senha são obrigatórios para registro.";
            exit;
        }

        $name = $_GET['name'];
        $password = $_GET['password'];

        $status = $usuario->register($name, $email, $gender, $birth_date, $password);

        echo $status;
        echo "<br><a href='?operacao=list'>Ver usuários</a>";
        break;

    case 'login':
        if (!isset($_GET['name']) || !isset($_GET['password'])) {
            echo "Nome e senha são obrigatórios para login.";
            exit;
        }

        $name = $_GET['name'];
        $password = $_GET['password'];

        if ($usuario->login($name, $password)) {
            echo "Login realizado com sucesso!";
        } else {
            echo "Nome de usuário ou senha incorretos.";
        }
        break;

    default:
        echo "Ação inválida.";
}

?>

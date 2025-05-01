<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    if (empty($email)) {
        echo "Preencha o e-mail.";
        exit;
    }

    echo "Se o e-mail estiver cadastrado, você receberá um link de recuperação.";
}

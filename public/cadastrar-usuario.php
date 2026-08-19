<?php
include "../infra/conexao.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nome === '' || $email === '') {
        die('Dados incompletos.');
    }

    $sql = "INSERT INTO usuario (nome, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        die('Erro na preparação da query: ' . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, "ss", $nome, $email);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../index.php');
        exit;
    }

    die('Erro ao cadastrar usuário: ' . mysqli_stmt_error($stmt));
}

if (isset($conexao)) {
    mysqli_close($conexao);
}
?>

<?php
include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_POST['id_usuario'] ?? null;
    $nome = $_POST['nome_prato'] ?? $_POST['nome'] ?? '';
    $descricao = $_POST['descricao_prato'] ?? $_POST['descricao'] ?? '';
    $preco = $_POST['preco_prato'] ?? $_POST['preco'] ?? null;
    $categoria = $_POST['categoria_prato'] ?? $_POST['categoria'] ?? '';

    if (!$id_usuario || $nome === '' || $descricao === '' || $preco === null || $categoria === '') {
        die('Dados incompletos.');
    }

    $sql = "INSERT INTO prato (id_usuario, nome, descricao, preco, categoria) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        die('Erro na preparação da query: ' . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, "issds", $id_usuario, $nome, $descricao, $preco, $categoria);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../index.php');
        exit;
    }

    die('Erro ao cadastrar prato: ' . mysqli_stmt_error($stmt));
}

if (isset($conexao)) {
    mysqli_close($conexao);
}
?>

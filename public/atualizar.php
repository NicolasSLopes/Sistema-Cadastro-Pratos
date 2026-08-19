<?php

include "../infra/conexao.php";

$id_prato = $_POST["id_prato"] ?? null;
$nome = $_POST["nome"] ?? "";
$descricao = $_POST["descricao"] ?? "";
$preco = $_POST["preco"] ?? null;
$categoria = $_POST["categoria"] ?? "";
$id_usuario = $_POST["id_usuario"] ?? null;

if ($id_prato === null || $nome === "" || $descricao === "" || $preco === null || $categoria === "" || $id_usuario === null) {
    die("Todos os dados do prato são obrigatórios.");
}

$sql = "UPDATE prato
        SET nome = ?, descricao = ?, preco = ?, categoria = ?, id_usuario = ?
        WHERE id_prato = ?";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt === false) {
    die("Erro ao preparar a query: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "ssdsii", $nome, $descricao, $preco, $categoria, $id_usuario, $id_prato);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../index.php");
    exit;
}

die("Erro ao atualizar prato: " . mysqli_error($conexao));
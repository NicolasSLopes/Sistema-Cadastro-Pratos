<?php

include "../infra/conexao.php";

$id_prato = $_GET["id_prato"] ?? null;

if ($id_prato === null) {
    die("Prato não informado.");
}

$sql = "DELETE FROM prato WHERE id_prato = ?";
$stmt = mysqli_prepare($conexao, $sql);

if ($stmt === false) {
    die("Erro ao preparar a query: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "i", $id_prato);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../index.php");
    exit;
}

die("Erro ao excluir prato: " . mysqli_error($conexao));

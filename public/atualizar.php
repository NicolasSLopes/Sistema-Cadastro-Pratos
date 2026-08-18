<?php

include "../infra/conexao.php";

$id_prato = $_POST["id"];
$descricao = $_POST["descricao_prato"];
$preco = $_POST["preco_prato"];
$categoria = $_POST["categoria_prato"];
$id_usuario = $_POST["id_usuario"];


$sql = "UPDATE prato SET  WHERE id = '$id_prato' "; 

mysqli_query($conexao, $sql);
header("Location: ../index.php");
<?php

include "../infra/conexao.php";

$id_prato = $_GET["id_prato"] ?? null;

if ($id_prato === null) {
    die("Prato não informado.");
}

$sql = "SELECT id_prato, nome, descricao, preco, categoria, id_usuario
        FROM prato
        WHERE id_prato = ?";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt === false) {
    die("Erro ao preparar a query: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "i", $id_prato);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$prato = mysqli_fetch_assoc($result);

if (!$prato) {
    die("Prato não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prato</title>
</head>
<body>
    <h1>Editar Prato</h1>

    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id_prato" value="<?php echo htmlspecialchars($prato['id_prato']); ?>">

        <label for="nome">Nome do Prato:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($prato['nome']); ?>" required>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="<?php echo htmlspecialchars($prato['descricao']); ?>" required>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" value="<?php echo htmlspecialchars($prato['preco']); ?>" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="principal" <?php echo ($prato['categoria'] === 'principal') ? 'selected' : ''; ?>>Principal</option>
            <option value="acompanhamento" <?php echo ($prato['categoria'] === 'acompanhamento') ? 'selected' : ''; ?>>Acompanhamento</option>
            <option value="sobremesa" <?php echo ($prato['categoria'] === 'sobremesa') ? 'selected' : ''; ?>>Sobremesa</option>
        </select>

        <label for="id_usuario">Usuário:</label>
        <select id="id_usuario" name="id_usuario" required>
            <?php
                $usuarios = mysqli_query($conexao, "SELECT * FROM usuario ORDER BY nome");
                while ($usuario = mysqli_fetch_assoc($usuarios)) {
                    $selecionado = ($usuario['id_usuario'] == $prato['id_usuario']) ? 'selected' : '';
                    echo "<option value='{$usuario['id_usuario']}' {$selecionado}>{$usuario['nome']}</option>";
                }
            ?>
        </select>

        <button type="submit">Salvar Alterações</button>
        <a href="../index.php">Cancelar</a>
    </form>
</body>
</html>

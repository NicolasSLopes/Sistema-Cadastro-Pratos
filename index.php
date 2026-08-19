<?php

include "infra/conexao.php"; 
$prato = mysqli_query($conexao, "SELECT * FROM prato");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pratos</title>
</head>

<body>
    <header>
        <h1>Cadastro de Pratos</h1>    
    </header>
    <main>
        <section>
            <h2>Cadastro de Usuário</h2>
            <form action="cadastro_usuario.php" method="POST">
                <label for="nome">Nome:</label>>
                <input type="text" id="nome" name="nome" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Cadastrar Usuário</button>
            </form>
        </section>

        <section>
            <h2>Cadastro de Prato</h2>
            <form action="cadastro_prato.php" method="POST">
                <label for="nome_prato">Nome do Prato:</label>
                <input type="text" id="nome_prato" name="nome_prato" required>
                <label for="descricao_prato">Descrição do Prato:</label>
                <input type="text" id="descricao_prato" name="descricao_prato" required>
                <label for="preco_prato">Preço do Prato:</label>
                <input type="number" id="preco_prato" name="preco_prato" step="0.01" required>
                <label for="categoria_prato">Categoria do Prato:</label>
                <select id="categoria_prato" name="categoria_prato" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="principal">Principal</option>
                    <option value="acomp">Acompanhamento</option>
                    <option value="sobremesa">Sobremesa</option>
                </select>
                <label for="id_usuario">Usuário:</label>
                <select id="id_usuario" name="id_usuario" required>
                    <option value="">Selecione um usuário</option>
                    <?php
                        $usuarios = mysqli_query($conexao, "SELECT * FROM usuario");
                        while ($usuario = mysqli_fetch_assoc($usuarios)) {
                            echo "<option value='{$usuario['id_usuario']}'>{$usuario['nome']}</option>";
                        }
                    ?>
                </select>
                <button type="submit">Cadastrar Prato</button>
            </form>
        </section>

        <section>
            <h2>Listagem de Pratos</h2>
            <?php
                $query = "SELECT prato.id_prato, prato.nome AS nome_prato, usuario.nome AS nome_usuario 
                          FROM prato 
                          LEFT JOIN usuario ON prato.id_usuario = usuario.id_usuario";
                $result = mysqli_query($conexao, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table border='1'>
                            <tr>
                                <th>ID do Prato</th>
                                <th>Nome do Prato</th>
                                <th>Nome do Usuário</th>
                            </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id_prato']}</td>
                                <td>{$row['nome_prato']}</td>
                                <td>{$row['nome_usuario']}</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Nenhum prato cadastrado.";
                }
            ?>
        </section>

</body>
</html>
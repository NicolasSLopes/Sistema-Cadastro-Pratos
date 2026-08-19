<?php

include "infra/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Cadastro de Pratos</title>
</head>
<body>
    <header>
        <h1>Cadastro de Pratos</h1>
    </header>

    <main>
        <section>
            <h2>Cadastro de Usuário</h2>
            <form action="public/cadastrar-usuario.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Cadastrar Usuário</button>
            </form>
        </section>

        <section>
            <h2>Cadastro de Prato</h2>
            <form action="public/cadastrar-prato.php" method="POST">
                <label for="nome">Nome do Prato:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="descricao">Descrição do Prato:</label>
                <input type="text" id="descricao" name="descricao" required>

                <label for="preco">Preço do Prato:</label>
                <input type="number" id="preco" name="preco" step="0.01" required>

                <label for="categoria">Categoria do Prato:</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="principal">Principal</option>
                    <option value="acompanhamento">Acompanhamento</option>
                    <option value="sobremesa">Sobremesa</option>
                </select>

                <label for="id_usuario">Usuário:</label>
                <select id="id_usuario" name="id_usuario" required>
                    <option value="">Selecione um usuário</option>
                    <?php
                        $usuarios = mysqli_query($conexao, "SELECT * FROM usuario ORDER BY nome");
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
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Usuário</th>
                                <th>Ações</th>
                            </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                            <tr>
                                <td>' . $row['id_prato'] . '</td>
                                <td>' . $row['nome'] . '</td>
                                <td>' . $row['descricao'] . '</td>
                                <td>R$ ' . number_format($row['preco'], 2, ',', '.') . '</td>
                                <td>' . $row['categoria'] . '</td>
                                <td>' . $row['nome_usuario'] . '</td>
                                <td>
                                    <a href="public/editar.php?id_prato=' . $row['id_prato'] . '">Editar</a>
                                    |
                                    <a href="public/excluir.php?id_prato=' . $row['id_prato'] . '" onclick="return confirm(\'Deseja excluir este prato?\');">Excluir</a>
                                </td>
                            </tr>
                        ';
                    }

                    echo "</table>";
                } else {
                    echo "Nenhum prato cadastrado.";
                }
            ?>
        </section>
    </main>
</body>
</html>
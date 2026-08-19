<?php
include "infra/conexao.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuario (nome, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $nome, $email);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Usuário cadastrado com sucesso!');
                    window.location.href = 'index.php'; // Troque por nome_do_seu_arquivo.php se for diferente
                  </script>";
        } else {
            echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação do banco: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
?>

<?php
include "infra/conexao.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_usuario = $_POST['id_usuario'];
    $nome       = $_POST['nome_prato'];
    $descricao  = $_POST['descricao_prato'];
    $preco      = $_POST['preco_prato'];
    $categoria  = $_POST['categoria_prato'];

=    $sql = "INSERT INTO prato (id_usuario, nome, descricao, preco, categoria) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conexao, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isssd", $id_usuario, $nome, $descricao, $categoria, $preco);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Prato cadastrado com sucesso!');
                    window.location.href = 'index.php'; 
                  </script>";
        } else {
            echo "Erro ao executar o cadastro do prato: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar o banco de dados: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
?>

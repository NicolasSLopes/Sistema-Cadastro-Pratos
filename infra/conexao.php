<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "sistema_prato";
    $porta = "3306";

    $conexao = mysqli_connect($host, $user, $password, $database, $porta);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $conexao->set_charset("utf8");
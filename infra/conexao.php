<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "sistema_prato";
    $porta = "3306";

    $conexao = nem mysqli($host, $user, $password, $database, $porta);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $conexao->set_charset("utf8");

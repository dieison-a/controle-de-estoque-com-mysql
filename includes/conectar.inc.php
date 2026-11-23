<?php

include 'dadosConexao.inc.php';

$conexao = new mysqli($servidor, $usuario, $senha);

if ($conexao->connect_error) {
    die('Erro de conexão: ' . $conexao->connect_error);
}

$conexao->set_charset('utf8mb4');

<?php

$sql = 'CREATE DATABASE IF NOT EXISTS supermercado_ex5_3';

if (!$conexao->query($sql)) {
    die('Erro ao criar o banco de dados: ' . $conexao->error);
}

if (!$conexao->select_db('supermercado_ex5_3')) {
    die('Erro ao selecionar o banco de dados: ' . $conexao->error);
}

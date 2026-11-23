<?php

$sql = 'CREATE TABLE IF NOT EXISTS produtos (
    id VARCHAR(20) PRIMARY KEY,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL
)';

if (!$conexao->query($sql)) {
    die('Erro ao criar a tabela: ' . $conexao->error);
}

$sql = "INSERT IGNORE INTO produtos (id, preco, quantidade) VALUES
    ('ARROZ', 25.90, 40),
    ('CAFE', 18.50, 30),
    ('FEIJAO', 8.49, 25),
    ('LEITE', 5.79, 18),
    ('MACARRAO', 4.29, 50)";

if (!$conexao->query($sql)) {
    die('Erro ao cadastrar os produtos iniciais: ' . $conexao->error);
}

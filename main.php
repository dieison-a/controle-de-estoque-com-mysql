<?php

include 'includes/conectar.inc.php';
include 'includes/criarBase.inc.php';
include 'includes/criarTabela.inc.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'];

    if ($acao == 'cadastrar') {
        $id = $_POST['id'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];

        $sql = 'INSERT INTO produtos (id, preco, quantidade) VALUES (?, ?, ?)';
        $comando = $conexao->prepare($sql);
        $comando->bind_param('sdi', $id, $preco, $quantidade);

        if (!$comando->execute()) {
            die('Erro ao cadastrar o produto. Verifique se o ID já existe.');
        }

        $mensagem = 'Produto cadastrado com sucesso.';
        $comando->close();
    } elseif ($acao == 'alterar') {
        $id = $_POST['id'];
        $preco = $_POST['preco'];

        $sql = 'SELECT id FROM produtos WHERE id = ?';
        $comando = $conexao->prepare($sql);
        $comando->bind_param('s', $id);

        if (!$comando->execute()) {
            die('Erro ao pesquisar o produto.');
        }

        $produto = $comando->get_result()->fetch_assoc();
        $comando->close();

        if ($produto) {
            $sql = 'UPDATE produtos SET preco = ? WHERE id = ?';
            $comando = $conexao->prepare($sql);
            $comando->bind_param('ds', $preco, $id);

            if (!$comando->execute()) {
                die('Erro ao alterar o preço.');
            }

            $mensagem = 'Preço unitário alterado com sucesso.';
            $comando->close();
        } else {
            $mensagem = 'Não foi encontrado produto com esse ID.';
        }
    } elseif ($acao == 'excluir') {
        $quantidadeMinima = $_POST['quantidadeMinima'];

        $sql = 'DELETE FROM produtos WHERE quantidade < ?';
        $comando = $conexao->prepare($sql);
        $comando->bind_param('i', $quantidadeMinima);

        if (!$comando->execute()) {
            die('Erro ao excluir os produtos.');
        }

        $mensagem = 'Produtos excluídos: ' . $comando->affected_rows . '.';
        $comando->close();
    }
}

$sql = 'SELECT id, preco, quantidade FROM produtos ORDER BY id';
$resultado = $conexao->query($sql);
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produtos cadastrados</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <main class="cartao tabela">
        <h1>Produtos cadastrados</h1>

        <?php if ($mensagem != ''): ?>
            <p class="mensagem sucesso"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <div class="rolagem-tabela">
            <table>
                <tr>
                    <th>ID do produto</th>
                    <th>Preço</th>
                    <th>Quantidade em estoque</th>
                </tr>
                <?php while ($produto = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['id']); ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['quantidade']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <a href="index.php">Voltar às operações</a>
    </main>
</body>

</html>
<?php
$conexao->close();

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Controle de estoque</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <main class="cartao">
        <h1>Controle de estoque</h1>

        <section>
            <h2>Cadastrar produto</h2>
            <form action="main.php" method="post">
                <input type="hidden" name="acao" value="cadastrar" />

                <label for="idCadastro">ID do produto:</label>
                <input type="text" name="id" id="idCadastro" maxlength="20" pattern="[A-Za-z0-9]+" required />

                <label for="precoCadastro">Preço unitário:</label>
                <input type="number" name="preco" id="precoCadastro" min="0" step="0.01" required />

                <label for="quantidadeCadastro">Quantidade em estoque:</label>
                <input type="number" name="quantidade" id="quantidadeCadastro" min="0" step="1" required />

                <button type="submit">Cadastrar produto</button>
            </form>
        </section>

        <section>
            <h2>Alterar preço</h2>
            <form action="main.php" method="post">
                <input type="hidden" name="acao" value="alterar" />

                <label for="idAlteracao">ID do produto:</label>
                <input type="text" name="id" id="idAlteracao" maxlength="20" pattern="[A-Za-z0-9]+" required />

                <label for="precoAlteracao">Novo preço unitário:</label>
                <input type="number" name="preco" id="precoAlteracao" min="0" step="0.01" required />

                <button type="submit">Alterar preço</button>
            </form>
        </section>

        <section>
            <h2>Excluir produtos com estoque abaixo do valor informado</h2>
            <form action="main.php" method="post">
                <input type="hidden" name="acao" value="excluir" />

                <label for="quantidadeMinima">Quantidade mínima:</label>
                <input type="number" name="quantidadeMinima" id="quantidadeMinima" min="0" step="1" required />

                <button type="submit" class="botao-excluir">Excluir produtos</button>
            </form>
        </section>

        <a href="main.php">Ver produtos cadastrados</a>
    </main>
</body>

</html>

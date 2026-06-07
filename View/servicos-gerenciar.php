<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Serviços - EasyCut</title>
    <link rel="stylesheet" href="/EasyCut/public/main.css">
</head>
<body>
    <div class="container">
        <h2>Gerenciamento de Serviços</h2>
        
        <a href="/EasyCut/index.php?action=novo" class="btn-novo">Add Novo Serviço</a>
        <br><br>

        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Duração</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($servicos)): ?>
                    <?php foreach ($servicos as $servico): ?>
                        <tr>
                            <td><?= $servico['id'] ?></td>
                            <td><?= htmlspecialchars($servico['nome']) ?></td>
                            <td><?= htmlspecialchars($servico['descricao']) ?></td>
                            <td><?= $servico['duracao_minutos'] ?> min</td>
                            <td>R$ <?= number_format($servico['preco'], 2, ',', '.') ?></td>
                            <td>
                                <a href="/EasyCut/index.php?action=excluir&id=<?= $servico['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" align="center">Nenhum serviço cadastrado ainda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
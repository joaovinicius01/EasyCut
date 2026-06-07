<!-- View/servicos-gerenciar.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Serviços — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="dashboard-wrapper">

    <div class="section-header" style="margin-bottom: 32px;">
        <p class="section-title">Menu</p>
        <div class="acoes-cell">
            <a href="index.php?p=agendamentos-admin" class="btn-tabela-editar">Agendamentos</a>
            <a href="index.php?p=barbeiros" class="btn-tabela-editar">Barbeiros</a>
            <a href="index.php?p=servicos" class="btn-tabela-editar">Serviços</a>
            <a href="index.php?p=sair" class="btn-tabela-excluir">Sair</a>
        </div>
    </div>

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="dashboard-welcome">
        <h2>Controle de <span>Serviços</span></h2>
        <div class="dashboard-divider"></div>
        <p>Gerencie o catálogo de procedimentos oferecidos pela barbearia.</p>
    </div>

    <div class="section-header">
        <p class="section-title">Procedimentos Ativos</p>
        <div class="acoes-cell">
            <a href="index.php?p=cadastrar-servico" class="btn-tabela-editar" style="background: #cca96a; color: #121214; font-weight: bold;">+ Novo Serviço</a>
        </div>
    </div>

    <div class="tabela-card">
        <table class="tabela-barber">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Serviço</th>
                    <th>Descrição</th>
                    <th>Duração</th>
                    <th>Preço de Venda</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($servicos)): ?>
                    <tr class="tabela-empty">
                        <td colspan="6">Nenhum serviço disponível no banco de dados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($servicos as $servico): ?>
                        <tr>
                            <td><?= $servico['id'] ?></td>
                            <td><strong><?= htmlspecialchars($servico['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($servico['descricao'] ?? 'Sem descrição cadastrada') ?></td>
                            <td><?= $servico['duracao_minutos'] ?> minutos</td>
                            <td style="color: #cca96a; font-weight: bold;">R$ <?= number_format($servico['preco'], 2, ',', '.') ?></td>
                            <td>
                                <div class="acoes-cell">
                                    <a href="index.php?p=excluir-servico&id=<?= $servico['id'] ?>" 
                                       class="btn-tabela-excluir" 
                                       onclick="return confirm('Tem certeza que deseja remover este serviço?')">
                                       Remover
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</main>

</body>
</html>
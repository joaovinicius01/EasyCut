<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbeiros — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="dashboard-wrapper">

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="dashboard-welcome">
        <h2>Nossos <span>Profissionais</span></h2>
        <div class="dashboard-divider"></div>
        <p>Gerencie os barbeiros cadastrados no sistema.</p>
    </div>

    <div class="section-header">
        <p class="section-title">Barbeiros Cadastrados</p>
        <a href="?p=cadastrar-barbeiro" class="btn-novo-agendamento-painel">Novo Barbeiro</a>
    </div>

    <div class="tabela-card">
        <table class="tabela-barber">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($barbeiros)): ?>
                    <tr class="tabela-empty">
                        <td colspan="3">
                            <span class="tabela-empty-icon">✂</span>
                            Nenhum barbeiro cadastrado ainda.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($barbeiros as $b): ?>
                        <tr>
                            <td><?= htmlspecialchars($b['nome']) ?></td>
                            <td><?= htmlspecialchars($b['especialidade']) ?></td>
                            <td>
                                <div class="acoes-cell">
                                    <a href="?p=editar-barbeiro&id=<?= $b['id'] ?>" class="btn-tabela-editar">Editar</a>

                                    <form action="?p=excluir-barbeiro" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este barbeiro?');">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                                        <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                        <button type="submit" class="btn-tabela-excluir">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="?p=dashboard" class="link-voltar">Voltar para o Painel</a>
    </div>

</main>

</body>
</html>

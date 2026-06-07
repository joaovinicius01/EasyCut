<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="dashboard-wrapper">

    <div class="section-header" style="margin-bottom: 32px;">
        <p class="section-title">Menu</p>
        <div class="acoes-cell">
            <?php if (($_SESSION['usuario']['tipo'] ?? '') == 'admin'): ?>
                <a href="index.php?p=agendamentos-admin" class="btn-tabela-editar">Todos Agendamentos</a>
                <a href="index.php?p=barbeiros" class="btn-tabela-editar">Barbeiros</a>
            <?php endif; ?>
            <a href="index.php?p=novo-agendamento" class="btn-tabela-editar">Novo Agendamento</a>
            <a href="index.php?p=sair" class="btn-tabela-excluir">Sair</a>
        </div>
    </div>

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="dashboard-welcome">
        <h2>Bem-vindo de <span>volta!</span></h2>
        <div class="dashboard-divider"></div>
        <p>Gerencie seus horários e agende novos serviços.</p>
    </div>

    <div class="section-header">
        <p class="section-title">Meus Agendamentos</p>
        <a href="index.php?p=novo-agendamento" class="btn-novo-agendamento-painel">Novo Agendamento</a>
    </div>

    <div class="tabela-card">
        <table class="tabela-barber">
            <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($agendamentos)): ?>
                    <tr class="tabela-empty">
                        <td colspan="5">
                            <span class="tabela-empty-icon">✂</span>
                            Você ainda não possui horários agendados.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($agendamentos as $ag): ?>
                        <?php
                            $status = strtolower($ag['status']);
                            $badgeClass = match($status) {
                                'confirmado' => 'badge-confirmado',
                                'pendente'   => 'badge-pendente',
                                'cancelado'  => 'badge-cancelado',
                                default      => 'badge-pendente',
                            };
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ag['servico_nome']) ?></td>
                            <td><?= date('d/m/Y', strtotime($ag['data_agendamento'])) ?></td>
                            <td><?= substr($ag['horario'], 0, 5) ?></td>
                            <td>
                                <span class="badge-status <?= $badgeClass ?>">
                                    <?= ucfirst($ag['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="acoes-cell">
                                    <a href="?p=editar-agendamento&id=<?= $ag['id'] ?>" class="btn-tabela-editar">Editar</a>

                                    <form action="?p=excluir-agendamento" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja desmarcar?');">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                                        <input type="hidden" name="id" value="<?= $ag['id'] ?>">
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

</main>

</body>
</html>
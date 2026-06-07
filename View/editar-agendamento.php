<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="scheduling-wrapper">

    <!-- Back link -->
    <div class="mb-4">
        <a href="?p=dashboard" class="link-voltar">Voltar para o Painel</a>
    </div>

    <!-- Brand badge -->
    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <!-- Heading -->
    <div class="page-heading">
        <h1>Editar <span>Agendamento</span></h1>
        <div class="heading-divider"></div>
        <p>Altere o serviço, a data ou o horário do seu agendamento.</p>
    </div>

    <?php if (!isset($agendamento) || !isset($servicos)): ?>

        <!-- Erro -->
        <div class="card-main" style="padding: 40px; text-align: center;">
            <span style="font-size:2rem; display:block; margin-bottom:16px; opacity:0.3;">⚠</span>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 24px;">
                Dados do agendamento não foram carregados pelo sistema.
            </p>
            <a href="?p=dashboard" class="btn-tabela-editar">Voltar para o Painel</a>
        </div>

    <?php else: ?>

        <div class="card-main">
            <div class="card-inner">

                <!-- ── Coluna do formulário ── -->
                <div class="card-form">
                    <form action="?p=atualizar-agendamento" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                        <input type="hidden" name="id" value="<?= $agendamento['id'] ?>">

                        <!-- Step 1 — Serviço -->
                        <div class="step-label">
                            <div class="step-num">1</div>
                            <span class="step-title">Serviço</span>
                        </div>

                        <div class="field-group">
                            <label for="servico" class="field-label">Serviço selecionado</label>
                            <div class="field-select-wrap">
                                <select name="servico_id" id="servico" class="field-select" required>
                                    <?php foreach ($servicos as $s): ?>
                                        <option value="<?= $s['id'] ?>" <?= $s['id'] == $agendamento['servico_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($s['nome']) ?> — R$ <?= number_format($s['preco'], 2, ',', '.') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <hr class="section-sep">

                        <!-- Step 2 — Data e Hora -->
                        <div class="step-label">
                            <div class="step-num">2</div>
                            <span class="step-title">Nova data e horário</span>
                        </div>

                        <div class="datetime-row field-group">
                            <div>
                                <label for="data" class="field-label">Data</label>
                                <input type="date"
                                       name="data_agendamento"
                                       id="data"
                                       class="field-input"
                                       required
                                       min="<?= date('Y-m-d') ?>"
                                       value="<?= $agendamento['data_agendamento'] ?>">
                            </div>
                            <div>
                                <label for="hora" class="field-label">Hora</label>
                                <input type="time"
                                       name="horario"
                                       id="hora"
                                       class="field-input"
                                       required
                                       value="<?= substr($agendamento['horario'], 0, 5) ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn-finalizar">Salvar Alterações</button>
                    </form>
                </div>

                <!-- ── Aside decorativo ── -->
                <div class="card-aside">
                    <div class="aside-content">
                        <span class="aside-icon">✦</span>
                        <p class="aside-headline">Mudou de <em>ideia?</em></p>
                        <p class="aside-desc">Altere seu horário sem burocracia. Suas preferências são atualizadas na hora.</p>
                        <ul class="aside-perks">
                            <li><span class="perk-dot"></span>Atualização imediata</li>
                            <li><span class="perk-dot"></span>Sem taxa de alteração</li>
                            <li><span class="perk-dot"></span>Histórico preservado</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    <?php endif; ?>

</main>

</body>
</html>
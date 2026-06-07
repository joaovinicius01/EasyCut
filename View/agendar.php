<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento — EasyCut</title>
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
        <h1>Novo <span>Agendamento</span></h1>
        <div class="heading-divider"></div>
        <p>Escolha o serviço, a data e o profissional de sua preferência.</p>
    </div>

    <!-- Main card -->
    <div class="card-main">
        <div class="card-inner">

            
            <div class="card-form">

                <?php if (isset($erro)): ?>
                <div class="alert-box"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>

                <form action="?p=salvar-agendamento" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    
                    <div class="step-label">
                        <div class="step-num">1</div>
                        <span class="step-title">Escolha o serviço</span>
                    </div>

                    <div class="field-group">
                        <label for="servico" class="field-label">Serviço</label>
                        <div class="field-select-wrap">
                            <select name="servico_id" id="servico" class="field-select" required>
                                <option value="">Selecione um serviço...</option>
                                <?php if (isset($servicos) && !empty($servicos)): ?>
                                    <?php foreach ($servicos as $s): ?>
                                        <?php
                                            $selected = '';
                                            if (isset($_POST['servico_id']) && $_POST['servico_id'] == $s['id']) {
                                                $selected = 'selected';
                                            } elseif (isset($_GET['servico_id']) && $_GET['servico_id'] == $s['id']) {
                                                $selected = 'selected';
                                            }
                                        ?>
                                        <option value="<?= $s['id'] ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($s['nome']) ?> — R$ <?= number_format($s['preco'], 2, ',', '.') ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <hr class="section-sep">

                  
                    <div class="step-label">
                        <div class="step-num">2</div>
                        <span class="step-title">Escolha data e horário</span>
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
                                   value="<?= htmlspecialchars($_POST['data_agendamento'] ?? '') ?>">
                        </div>
                        <div>
                            <label for="hora" class="field-label">Hora</label>
                            <input type="time"
                                   name="horario"
                                   id="hora"
                                   class="field-input"
                                   required
                                   value="<?= htmlspecialchars($_POST['horario'] ?? '') ?>">
                        </div>
                    </div>

                    <hr class="section-sep">

                    
                    <div class="step-label">
                        <div class="step-num">3</div>
                        <span class="step-title">Escolha o profissional</span>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Barbeiro</label>
                        <div class="barbers-row">
                            <?php if (!empty($barbeiros)): ?>
                                <?php foreach ($barbeiros as $index => $b): ?>
                                    <label class="barber-label">
                                        <input type="radio"
                                               name="barbeiro_id"
                                               value="<?= $b['id'] ?>"
                                               <?= ($index === 0 ? 'required' : '') ?>
                                               <?= ((isset($_POST['barbeiro_id']) && $_POST['barbeiro_id'] == $b['id']) ? 'checked' : '') ?>>
                                        <div class="barber-avatar"><?= htmlspecialchars(mb_substr($b['nome'], 0, 1)) ?></div>
                                        <span class="barber-name"><?= htmlspecialchars($b['nome']) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Nenhum barbeiro cadastrado.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn-finalizar">Finalizar Agendamento</button>
                </form>
            </div>

            <!-- ── Aside decorativo ── -->
            <div class="card-aside">
                <div class="aside-content">
                    <span class="aside-icon">✦</span>
                    <p class="aside-headline">Experiência <em>premium</em> na cadeira certa.</p>
                    <p class="aside-desc">Agende em segundos, sem complicações. Escolha seu profissional favorito e garanta seu horário.</p>
                    <ul class="aside-perks">
                        <li><span class="perk-dot"></span>Confirmação imediata</li>
                        <li><span class="perk-dot"></span>Sem taxa de reserva</li>
                        <li><span class="perk-dot"></span>Cancele quando quiser</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</main>

</body>
</html>
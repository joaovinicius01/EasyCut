<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Barbeiro — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="scheduling-wrapper">

    <div class="mb-4">
        <a href="?p=barbeiros" class="link-voltar">Voltar para Barbeiros</a>
    </div>

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="page-heading">
        <h1>Novo <span>Barbeiro</span></h1>
        <div class="heading-divider"></div>
        <p>Preencha os dados do profissional.</p>
    </div>

    <div class="card-main">
        <div class="card-inner">
            <div class="card-form">

                <?php if (isset($_GET['erro'])): ?>
                    <div class="alert-box">Preencha todos os campos obrigatórios.</div>
                <?php endif; ?>

                <form action="?p=salvar-barbeiro" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="field-group">
                        <label for="nome" class="field-label">Nome</label>
                        <input type="text"
                               name="nome"
                               id="nome"
                               class="field-input"
                               placeholder="Ex: Carlos Silva"
                               required
                               value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                    </div>

                    <div class="field-group">
                        <label for="especialidade" class="field-label">Especialidade</label>
                        <input type="text"
                               name="especialidade"
                               id="especialidade"
                               class="field-input"
                               placeholder="Ex: Corte degradê, barba"
                               required
                               value="<?= htmlspecialchars($_POST['especialidade'] ?? '') ?>">
                    </div>

                    <button type="submit" class="btn-finalizar">Cadastrar Barbeiro</button>
                </form>

            </div>

            <div class="card-aside">
                <div class="aside-content">
                    <span class="aside-icon">✦</span>
                    <p class="aside-headline">Equipe de <em>qualidade</em>.</p>
                    <p class="aside-desc">Adicione os profissionais da barbearia para que os clientes possam escolher seu favorito.</p>
                </div>
            </div>

        </div>
    </div>

</main>

</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Barbeiro — EasyCut</title>
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
        <h1>Editar <span>Barbeiro</span></h1>
        <div class="heading-divider"></div>
        <p>Atualize os dados do profissional.</p>
    </div>

    <div class="card-main">
        <div class="card-inner">

            <div class="card-form">
                <form action="?p=atualizar-barbeiro" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="id" value="<?= $barbeiro['id'] ?>">

                    <div class="field-group">
                        <label for="nome" class="field-label">Nome</label>
                        <input type="text"
                               name="nome"
                               id="nome"
                               class="field-input"
                               required
                               value="<?= htmlspecialchars($barbeiro['nome']) ?>">
                    </div>

                    <div class="field-group">
                        <label for="especialidade" class="field-label">Especialidade</label>
                        <input type="text"
                               name="especialidade"
                               id="especialidade"
                               class="field-input"
                               required
                               value="<?= htmlspecialchars($barbeiro['especialidade']) ?>">
                    </div>

                    <button type="submit" class="btn-finalizar">Salvar Alterações</button>
                </form>
            </div>

            <div class="card-aside">
                <div class="aside-content">
                    <span class="aside-icon">✦</span>
                    <p class="aside-headline">Equipe de <em>qualidade</em>.</p>
                    <p class="aside-desc">Mantenha os dados da equipe sempre atualizados.</p>
                </div>
            </div>

        </div>
    </div>

</main>

</body>
</html>

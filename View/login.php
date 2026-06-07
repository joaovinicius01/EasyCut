<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="scheduling-wrapper">

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="page-heading">
        <h1>Bem-vindo de <span>volta</span></h1>
        <div class="heading-divider"></div>
        <p>Acesse sua conta para gerenciar seus agendamentos.</p>
    </div>

    <div class="card-main">
        <div class="card-inner">
            <div class="card-form">

                <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert-box">Conta criada com sucesso! Faça login para continuar.</div>
                <?php endif; ?>

                <?php if (isset($_GET['erro'])): ?>
                <div class="alert-box">E-mail ou senha incorretos.</div>
                <?php endif; ?>

                <form action="?p=entrar" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="field-group">
                        <label for="email" class="field-label">E-mail</label>
                        <input type="email" name="email" id="email" class="field-input" placeholder="seu@email.com" required>
                    </div>

                    <div class="field-group">
                        <label for="senha" class="field-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="field-input" placeholder="Sua senha" required>
                    </div>

                    <button type="submit" class="btn-finalizar">Entrar</button>
                </form>

                <p style="margin-top: 28px; text-align: center; color: #5a5f72; font-size: 0.85rem;">
                    Ainda não tem conta?
                    <a href="?p=cadastro" style="color: #c9a84c; text-decoration: none; font-weight: 600;">Cadastre-se</a>
                </p>
            </div>

            <div class="card-aside">
                <div class="aside-content">
                    <span class="aside-icon">✦</span>
                    <p class="aside-headline">Seu estilo, <em>seu horário</em>.</p>
                    <p class="aside-desc">Entre na sua conta e agende cortes, barbas e muito mais com praticidade.</p>
                </div>
            </div>
        </div>
    </div>

</main>

</body>
</html>

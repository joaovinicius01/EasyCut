<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="scheduling-wrapper">

    <div class="mb-4">
        <a href="?p=login" class="link-voltar">Voltar para o Login</a>
    </div>

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="page-heading">
        <h1>Criar <span>conta</span></h1>
        <div class="heading-divider"></div>
        <p>Preencha seus dados para começar a agendar.</p>
    </div>

    <div class="card-main">
        <div class="card-inner">
            <div class="card-form">

                <?php if (isset($_GET['erro'])): ?>
                <div class="alert-box">Não foi possível cadastrar. Verifique os dados e tente novamente.</div>
                <?php endif; ?>

                <form action="?p=registrar" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="field-group">
                        <label for="nome" class="field-label">Nome completo</label>
                        <input type="text" name="nome" id="nome" class="field-input" placeholder="Seu nome" required>
                    </div>

                    <div class="field-group">
                        <label for="email" class="field-label">E-mail</label>
                        <input type="email" name="email" id="email" class="field-input" placeholder="seu@email.com" required>
                    </div>

                    <div class="datetime-row field-group">
                        <div>
                            <label for="cpf" class="field-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="field-input" placeholder="000.000.000-00" required>
                        </div>
                        <div>
                            <label for="data_nascimento" class="field-label">Data de nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="field-input" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="telefone" class="field-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="field-input" placeholder="(00) 00000-0000">
                    </div>

                    <div class="datetime-row field-group">
                        <div>
                            <label for="senha" class="field-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="field-input" placeholder="Sua senha" required>
                        </div>
                        <div>
                            <label for="confirmar_senha" class="field-label">Confirmar senha</label>
                            <input type="password" name="confirmar_senha" id="confirmar_senha" class="field-input" placeholder="Repita a senha" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-finalizar">Criar conta</button>
                </form>

                <p style="margin-top: 28px; text-align: center; color: #5a5f72; font-size: 0.85rem;">
                    Já tem conta?
                    <a href="?p=login" style="color: #c9a84c; text-decoration: none; font-weight: 600;">Faça login</a>
                </p>
            </div>

            <div class="card-aside">
                <div class="aside-content">
                    <span class="aside-icon">✦</span>
                    <p class="aside-headline">Cadastro <em>rápido</em> e seguro.</p>
                    <p class="aside-desc">Seus dados ficam protegidos e você pode agendar em poucos cliques.</p>
                </div>
            </div>
        </div>
    </div>

</main>

</body>
</html>

<!-- View/servico-form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Serviço — EasyCut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>

<main class="scheduling-wrapper">

    <div class="mb-4">
        <a href="index.php?p=servicos" class="link-voltar">Voltar para a Listagem</a>
    </div>

    <div class="brand-badge">
        <div class="brand-icon">✂</div>
        <span class="brand-name">EasyCut</span>
    </div>

    <div class="page-heading">
        <h1>Adicionar <span>Serviço</span></h1>
        <div class="heading-divider"></div>
        <p>Preencha as informações do novo procedimento do catálogo.</p>
    </div>

    <div class="card-main" style="max-width: 600px; margin: 0 auto;">
        <div class="card-inner">
            <div class="card-form" style="width: 100%;">
                
                <form action="index.php?p=salvar-servico" method="POST" autocomplete="off">
                    
                    <div class="field-group mb-3">
                        <label class="field-label">Nome do Serviço *</label>
                        <input type="text" name="nome" class="field-input" placeholder="Ex: Corte Degradê Premium" required>
                    </div>

                    <div class="field-group mb-3">
                        <label class="field-label">Descrição Informativa</label>
                        <textarea name="descricao" class="field-input" rows="3" placeholder="Detalhes sobre o procedimento..."></textarea>
                    </div>

                    <div class="field-group mb-4">
                        <label class="field-label">Tempo Estimado (Minutos) *</label>
                        <input type="number" name="duracao_minutos" min="1" class="field-input" placeholder="Ex: 45" required>
                    </div>

                    <div class="field-group mb-4">
                        <label class="field-label">Preço Cobrado (R$) *</label>
                        <input type="text" name="preco" class="field-input" placeholder="Ex: 50.00" required>
                    </div>

                    <button type="submit" class="btn-finalizar" style="width: 100%;">Salvar Novo Serviço</button>
                </form>

            </div>
        </div>
    </div>

</main>

</body>
</html>
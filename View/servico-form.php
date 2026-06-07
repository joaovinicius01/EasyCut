<!-- View/servico-form.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Serviço - EasyCut</title>
    <link rel="stylesheet" href="/EasyCut/public/main.css">
</head>
<body>
    <div class="container" style="padding: 20px; max-width: 500px; margin: 0 auto;">
        <h2><?= isset($servico) ? 'Editar Serviço' : 'Novo Serviço' ?></h2>
        <br>

       <form action="/EasyCut/index.php?action=salvar" method="POST">
            
           <input type="hidden" name="id" value="<?= isset($servico) ? $servico['id'] : '' ?>">
            
            <div style="margin-bottom: 15px;">
                <label for="nome" style="display:block; margin-bottom:5px;">Nome do Serviço *</label>
                <input type="text" name="nome" id="nome" style="width:100%; padding:8px;" value="<?= isset($servico) ? htmlspecialchars($servico['nome']) : '' ?>" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="descricao" style="display:block; margin-bottom:5px;">Descrição (Opcional)</label>
                <textarea name="descricao" id="descricao" rows="4" style="width:100%; padding:8px;"><?= isset($servico) ? htmlspecialchars($servico['descricao']) : '' ?></textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="duracao_minutos" style="display:block; margin-bottom:5px;">Duração (em minutos) *</label>
                <input type="number" name="duracao_minutos" id="duracao_minutos" min="1" style="width:100%; padding:8px;" value="<?= isset($servico) ? $servico['duracao_minutos'] : '' ?>" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="preco" style="display:block; margin-bottom:5px;">Preço (R$) *</label>
                <input type="text" name="preco" id="preco" placeholder="0.00" style="width:100%; padding:8px;" value="<?= isset($servico) ? $servico['preco'] : '' ?>" required>
            </div>

            <button type="submit" style="padding: 10px 20px; background:#28a745; color:white; border:none; cursor:pointer;">Salvar Serviço</button>
            <a href="/EasyCut/index.php?action=gerenciar" style="margin-left:10px; text-decoration:none; color:#6c757d;">Cancelar</a>
        </form>
    </div>
</body>
</html>
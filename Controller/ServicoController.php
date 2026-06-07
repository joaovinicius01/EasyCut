<?php

class ServicoController {
    private $servicoModel;

    public function __construct($db) {
        $this->servicoModel = new Servico($db);
    }

    public function index() {
        $servicos = $this->servicoModel->listarTodos();
        require_once "views/servicos-publico.php";
    }

public function gerenciar() {
    $servicos = $this->servicoModel->listarTodos();
   require_once "View/servicos-gerenciar.php"; 
}

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) && !empty($_POST['id']) ? intval($_POST['id']) : null;
            $nome = trim($_POST['nome']);
            $descricao = trim($_POST['descricao']);
            $duracao_minutos = intval($_POST['duracao_minutos']);

            $preco = str_replace(',', '.', trim($_POST['preco'])); 

         
            if (empty($nome) || empty($duracao_minutos) || empty($preco)) {
                die("Por favor, preencha todos os campos obrigatórios (Nome, Duração e Preço).");
            }

            if ($id) {
                $this->servicoModel->atualizar($id, $nome, $descricao, $duracao_minutos, $preco);
            } else {
                $this->servicoModel->criar($nome, $descricao, $duracao_minutos, $preco);
            }

            header("Location: /easycut/servicos/gerenciar");
            exit;
        }
    }
    public function excluir($id) {
        if ($id) {
            $this->servicoModel->deletar($id);
        }
        header("Location: /easycut/servicos/gerenciar");
        exit;
    }
}
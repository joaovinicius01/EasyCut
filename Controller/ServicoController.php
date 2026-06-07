<?php
require_once __DIR__ . "/../Model/Servicos.php";

class ServicoController {

    private static function verificarAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']['email']) || $_SESSION['usuario']['email'] !== 'admin@easycut.com') {
            die("Acesso Negado: Esta área é restrita para o usuário admin@easycut.com.");
        }
    }

    public static function listarServicos() {
        self::verificarAdmin();
        $servicos = Servicos::listarTodos();
        require_once __DIR__ . "/../View/servicos-gerenciar.php";
    }

    public static function formularioCadastrar() {
        self::verificarAdmin();
        require_once __DIR__ . "/../View/servico-form.php";
    }

    public static function cadastrarServico() {
        self::verificarAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $descricao = trim($_POST['descricao']);
            $duracao_minutos = intval($_POST['duracao_minutos']);
            $preco = str_replace(',', '.', trim($_POST['preco']));

            if (!empty($nome) && $duracao_minutos > 0 && !empty($preco)) {
                Servicos::criar($nome, $descricao, $duracao_minutos, $preco);
            }
        }
        header("Location: index.php?p=servicos");
        exit;
    }

    public static function apagarServico() {
        self::verificarAdmin();
        
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($id) {
            Servicos::deletar($id);
        }
        header("Location: index.php?p=servicos");
        exit;
    }
}
?>
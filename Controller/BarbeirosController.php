<?php

require_once __DIR__ . "/../Model/Barbeiro.php";

class BarbeirosController {

    public static function listarBarbeiros(): void {
        $barbeiros = Barbeiro::listarBarbeiros();
        require __DIR__ . "/../View/BarbeiroView.php";
    }

    public static function formularioCadastrar(): void {
        require __DIR__ . "/../View/cadastrar-barbeiro.php";
    }

    public static function cadastrarBarbeiro(): void {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $nome          = $_POST['nome'];
            $especialidade = $_POST['especialidade'];

            if ($nome && $especialidade) {
                Barbeiro::inserirBarbeiro($nome, $especialidade);
                header('Location: ?p=barbeiros');
                exit;
            } else {
                header('Location: ?p=cadastrar-barbeiro&erro=1');
                exit;
            }
        }
    }

    public static function editarBarbeiro(): void {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $barbeiro = Barbeiro::buscarPorId($id);
            if ($barbeiro) {
                require __DIR__ . "/../View/editar-barbeiro.php";
            } else {
                header('Location: ?p=barbeiros');
                exit;
            }
        }
    }

    public static function atualizarBarbeiro(): void {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $id            = $_POST['id'];
            $nome          = $_POST['nome'];
            $especialidade = $_POST['especialidade'];

            if ($id && $nome && $especialidade) {
                Barbeiro::atualizarBarbeiro($id, $nome, $especialidade);
                header('Location: ?p=barbeiros');
                exit;
            }
        }
    }

    public static function apagarBarbeiro(): void {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $id = $_POST['id'] ?? null;
            if ($id) {
                Barbeiro::apagarBarbeiro($id);
            }
            header('Location: ?p=barbeiros');
            exit;
        }
    }
}

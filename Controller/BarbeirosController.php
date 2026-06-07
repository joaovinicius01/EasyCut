<?php

require_once __DIR__ . "/../Model/Barbeiro.php";

class BarbeirosController {

    public static function listarBarbeiros(): void {
        $barbeiros = Barbeiro::listarBarbeiros();
        require __DIR__ . "/../View/BarbeiroView.php";
    }

    public static function formularioCadastrar(): void {
        self::verificarAutenticacao();
        require __DIR__ . "/../View/cadastrar-barbeiro.php";
    }

    public static function cadastrarBarbeiro(): void {
        self::verificarAutenticacao();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $nome = trim($_POST['nome'] ?? '');
            $especialidade = trim($_POST['especialidade'] ?? '');

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

    private static function verificarAutenticacao(): void {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ?p=login');
            exit;
        }
    }
}

<?php

require_once __DIR__ . "/../Model/Agendamento.php";

class AgendamentosController {

    private static function verificarAutenticacao(): void {
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['usuario'] = [
                'id' => 1,
                'nome' => 'João Vinicius'
            ];
        }
    }

    public static function index(): void {
        self::verificarAutenticacao();
        $id = $_SESSION['usuario']['id'];
        $agendamentos = Agendamento::listarTodos($id);
        require __DIR__ . "/../View/meus-agendamentos.php";
    }

    public static function formularioCriar(): void {
        self::verificarAutenticacao();

        $servicos = Agendamento::listarServicos();

        require __DIR__ . "/../View/agendar.php";
    }

    public static function addAgendamento(): void {
        self::verificarAutenticacao();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $id_usuario       = $_SESSION['usuario']['id'];
            $servico_id       = $_POST['servico_id'];
            $data_agendamento = $_POST['data_agendamento'];
            $horario          = $_POST['horario'];
            $barbeiro         = $_POST['barbeiro']; 

            if ($servico_id && $data_agendamento && $horario && $barbeiro) {
                Agendamento::inserir($id_usuario, $servico_id, $data_agendamento, $horario, $barbeiro);
                header('Location: ?p=dashboard');
                exit;
            } else {
                header('Location: ?p=novo-agendamento&erro=1');
                exit;
            }
        }
    }

    public static function editarAgendamento(): void {
        self::verificarAutenticacao();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $agendamento = Agendamento::buscarPorId($id);
            if (!$agendamento || $agendamento['usuario_id'] != $_SESSION['usuario']['id']) {
                header('Location: ?p=dashboard');
                exit;
            }

            $servicos = Agendamento::listarServicos();
            require __DIR__ . "/../View/editar-agendamento.php";
        }
    }

    public static function atualizarAgendamento(): void {
        self::verificarAutenticacao();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $id               = $_POST['id'];
            $servico_id       = $_POST['servico_id'];
            $data_agendamento = $_POST['data_agendamento'];
            $horario          = $_POST['horario'];
            $barbeiro         = $_POST['barbeiro'];

            if ($id && $servico_id && $data_agendamento && $horario && $barbeiro) {
                Agendamento::atualizar($id, $servico_id, $data_agendamento, $horario, $barbeiro);
                header('Location: ?p=dashboard');
                exit;
            }
        }
    }

    public static function apagarAgendamento(): void {
        self::verificarAutenticacao();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $id = $_POST['id'] ?? null;
            if ($id) {
                Agendamento::apagar($id);
            }
            header('Location: ?p=dashboard');
            exit;
        }
    }
}
?>
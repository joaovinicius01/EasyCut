<?php

require_once __DIR__ . "/../Model/Agendamento.php";
require_once __DIR__ . "/../Model/Barbeiro.php";

class AgendamentosController {

    private static function verificarAutenticacao(): void {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ?p=login');
            exit;
        }
    }

    private static function verificarAdmin(): void {
        self::verificarAutenticacao();
        if ($_SESSION['usuario']['tipo'] != 'admin') {
            header('Location: ?p=dashboard');
            exit;
        }
    }

    public static function index(): void {
        self::verificarAutenticacao();
        $id = $_SESSION['usuario']['id'];
        $agendamentos = Agendamento::listarTodos($id);
        require __DIR__ . "/../View/meus-agendamentos.php";
    }

    public static function listarAdmin(): void {
        self::verificarAdmin();
        $agendamentos = Agendamento::listarTodosAdmin();
        require __DIR__ . "/../View/agendamentos-admin.php";
    }

    public static function formularioCriar(): void {
        self::verificarAutenticacao();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $servicos  = Agendamento::listarServicos();
        $barbeiros = Barbeiro::listarBarbeiros();

        require __DIR__ . "/../View/agendar.php";
    }

    public static function addAgendamento(): void {
        self::verificarAutenticacao();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("Erro de segurança: token inválido.");
            }

            $id_usuario       = $_SESSION['usuario']['id'];
            $servico_id       = $_POST['servico_id']       ?? '';
            $data_agendamento = $_POST['data_agendamento'] ?? '';
            $horario          = $_POST['horario']          ?? '';
            $barbeiro_id      = $_POST['barbeiro_id']      ?? '';

            if (Agendamento::horarioOcupado($barbeiro_id, $data_agendamento, $horario)) {
                $erro      = "Este profissional já está ocupado nesse horário. Escolha outro horário ou barbeiro.";
                $servicos  = Agendamento::listarServicos();
                $barbeiros = Barbeiro::listarBarbeiros();
                require __DIR__ . "/../View/agendar.php";
                return;
            }

            Agendamento::inserir(
                $id_usuario,
                $servico_id,
                $data_agendamento,
                $horario,
                $barbeiro_id
            );

            header('Location: ?p=dashboard');
            exit;
        }
    }

    public static function editarAgendamento(): void {
        self::verificarAutenticacao();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ?p=dashboard');
            exit;
        }

        $agendamento = Agendamento::buscarPorId($id);

        if (!$agendamento || $agendamento['usuario_id'] != $_SESSION['usuario']['id']) {
            header('Location: ?p=dashboard');
            exit;
        }

        $servicos  = Agendamento::listarServicos();
        $barbeiros = Barbeiro::listarBarbeiros();

        require __DIR__ . "/../View/editar-agendamento.php";
    }

    public static function atualizarAgendamento(): void {
        self::verificarAutenticacao();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("Erro de segurança: token inválido.");
            }

            $id               = $_POST['id']               ?? null;
            $servico_id       = $_POST['servico_id']       ?? null;
            $data_agendamento = $_POST['data_agendamento'] ?? null;
            $horario          = $_POST['horario']          ?? null;
            $barbeiro_id      = $_POST['barbeiro_id']      ?? null;

            if ($id && $servico_id && $data_agendamento && $horario && $barbeiro_id) {

                if (Agendamento::horarioOcupado($barbeiro_id, $data_agendamento, $horario, $id)) {
                    $erro        = "Este profissional já está ocupado nesse horário. Escolha outro horário ou barbeiro.";
                    $agendamento = Agendamento::buscarPorId($id);
                    $servicos    = Agendamento::listarServicos();
                    $barbeiros   = Barbeiro::listarBarbeiros();
                    require __DIR__ . "/../View/editar-agendamento.php";
                    return;
                }

                Agendamento::atualizar($id, $servico_id, $data_agendamento, $horario, $barbeiro_id);
            }

            header('Location: ?p=dashboard');
            exit;
        }
    }

    public static function apagarAgendamento(): void {
        self::verificarAutenticacao();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("Erro de segurança: token inválido.");
            }

            $id = $_POST['id'] ?? null;

            if ($id) {
                Agendamento::apagar($id);
            }

            if ($_SESSION['usuario']['tipo'] == 'admin') {
                header('Location: ?p=agendamentos-admin');
            } else {
                header('Location: ?p=dashboard');
            }
            exit;
        }
    }
}
?>
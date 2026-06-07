<?php
// Model/Agendamento.php

require_once __DIR__ . "/../Config/banco1.php";

class Agendamento {

    // Método que a sua Controller vai chamar para alimentar o Select de serviços
    public static function listarServicos(): array {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT id, nome, preco FROM servicos");
        if (!$result) {
            die("ERRO AO BUSCAR SERVIÇOS: " . $conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function listarTodos($id_usuario): array {
        $conn = Banco::getConn();
        $result = $conn->query(
            "SELECT a.*, s.nome as servico_nome, b.nome as barbeiro_nome
             FROM agendamentos a
             JOIN servicos s ON a.servico_id = s.id
             JOIN barbeiros b ON a.barbeiro_id = b.id
             WHERE a.usuario_id = $id_usuario
             ORDER BY a.data_agendamento ASC, a.horario ASC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function buscarPorId($id) {
        $conn = Banco::getConn();
        $result = $conn->query(
            "SELECT a.*, b.nome as barbeiro_nome
             FROM agendamentos a
             JOIN barbeiros b ON a.barbeiro_id = b.id
             WHERE a.id = $id LIMIT 1"
        );
        return $result->fetch_assoc();
    }

    public static function inserir($id_usuario, $id_servico, $data, $hora, $barbeiro_id) {
        $conn = Banco::getConn();
        return $conn->query(
            "INSERT INTO agendamentos (usuario_id, servico_id, data_agendamento, horario, barbeiro_id, status)
             VALUES ($id_usuario, $id_servico, '$data', '$hora', $barbeiro_id, 'confirmado')"
        );
    }

    public static function atualizar($id, $id_servico, $data, $hora, $barbeiro_id) {
        $conn = Banco::getConn();
        return $conn->query(
            "UPDATE agendamentos
             SET servico_id = $id_servico, data_agendamento = '$data', horario = '$hora', barbeiro_id = $barbeiro_id
             WHERE id = $id"
        );
    }

    public static function apagar($id) {
        $conn = Banco::getConn();
        return $conn->query("DELETE FROM agendamentos WHERE id = $id");
    }
}
?>
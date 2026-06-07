<?php
// Model/Agendamento.php

require_once __DIR__ . "/../Config/banco1.php";

class Agendamento {

    public static function listarServicos(): array {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT id, nome, preco FROM servicos ORDER BY nome ASC");
        if (!$result) {
            die("ERRO AO BUSCAR SERVIÇOS: " . $conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function listarTodos($id_usuario): array {
        $conn = Banco::getConn();
        
        $sql = "SELECT 
                    a.id, 
                    a.usuario_id, 
                    a.servico_id, 
                    a.data_agendamento, 
                    a.horario, 
                    a.barbeiro_id, 
                    a.status, 
                    s.nome as servico_nome, 
                    b.nome as barbeiro_nome 
                FROM agendamentos a 
                JOIN servicos s ON a.servico_id = s.id 
                JOIN barbeiros b ON a.barbeiro_id = b.id
                WHERE a.usuario_id = $id_usuario 
                ORDER BY a.data_agendamento ASC, a.horario ASC";
        
        $result = $conn->query($sql);
        if (!$result) {
            die("ERRO AO LISTAR AGENDAMENTOS: " . $conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function buscarPorId($id) {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT * FROM agendamentos WHERE id = $id LIMIT 1");
        return $result->fetch_assoc();
    }

    public static function inserir($id_usuario, $id_servico, $data, $hora, $barbeiro_id) {
        $conn = Banco::getConn();
        $sql = "INSERT INTO agendamentos (usuario_id, servico_id, data_agendamento, horario, barbeiro_id, status) 
                VALUES ($id_usuario, $id_servico, '$data', '$hora', $barbeiro_id, 'confirmado')";
        
        return $conn->query($sql);
    }

    
    public static function atualizar($id, $id_servico, $data, $hora, $barbeiro_id) {
        $conn = Banco::getConn();
        $sql = "UPDATE agendamentos 
                SET servico_id = $id_servico, data_agendamento = '$data', horario = '$hora', barbeiro_id = $barbeiro_id 
                WHERE id = $id";
        
        return $conn->query($sql);
    }

    public static function apagar($id) {
        $conn = Banco::getConn();
        return $conn->query("DELETE FROM agendamentos WHERE id = $id");
    }
}
?>
<?php
// Model/Servicos.php
require_once __DIR__ . "/../Config/banco1.php";

class Servicos {

    public static function listarTodos() {
        $db = Banco::getConn();
        $result = $db->query("SELECT * FROM servicos ORDER BY nome ASC");
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public static function criar($nome, $descricao, $duracao_minutos, $preco) {
        $db = Banco::getConn();
        $stmt = $db->prepare("INSERT INTO servicos (nome, descricao, duracao_minutos, preco) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssid", $nome, $descricao, $duracao_minutos, $preco);
        return $stmt->execute();
    }

    public static function deletar($id) {
        $db = Banco::getConn();
        $stmt = $db->prepare("DELETE FROM servicos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
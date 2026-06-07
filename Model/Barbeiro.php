<?php

require_once __DIR__ . "/../Config/banco1.php";

class Barbeiro {

    public static function listarBarbeiros(): array {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT id, nome, especialidade FROM barbeiros ORDER BY nome ASC");
        if (!$result) {
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function buscarPorId($id) {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT * FROM barbeiros WHERE id = $id LIMIT 1");
        return $result->fetch_assoc();
    }

    public static function inserirBarbeiro(string $nome, string $especialidade): void {
        $conn = Banco::getConn();
        $conn->query("INSERT INTO barbeiros (nome, especialidade) VALUES ('$nome', '$especialidade')");
    }

    public static function atualizarBarbeiro($id, string $nome, string $especialidade): void {
        $conn = Banco::getConn();
        $conn->query("UPDATE barbeiros SET nome = '$nome', especialidade = '$especialidade' WHERE id = $id");
    }

    public static function apagarBarbeiro($id): void {
        $conn = Banco::getConn();
        $conn->query("DELETE FROM barbeiros WHERE id = $id");
    }
}

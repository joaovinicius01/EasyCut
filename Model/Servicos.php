<?php
// models/Servico.php

class Servico {
    private $conn;
    private $table = "servicos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $descricao, $duracao_minutos, $preco) {
        $query = "INSERT INTO " . $this->table . " (nome, descricao, duracao_minutos, preco) 
                  VALUES (:nome, :descricao, :duracao_minutos, :preco)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":duracao_minutos", $duracao_minutos, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $preco);
        
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $descricao, $duracao_minutos, $preco) {
        $query = "UPDATE " . $this->table . " 
                  SET nome = :nome, descricao = :descricao, duracao_minutos = :duracao_minutos, preco = :preco 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":duracao_minutos", $duracao_minutos, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $preco);
        
        return $stmt->execute();
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
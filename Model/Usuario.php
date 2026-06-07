<?php

require_once __DIR__ . "/../Config/banco1.php";

class Usuario {

    public static function buscarPorEmail($email) {
        $conn = Banco::getConn();
        $result = $conn->query("SELECT * FROM usuarios WHERE email = '$email' LIMIT 1");
        return $result->fetch_assoc();
    }

    public static function cadastrar($nome, $email, $senha, $cpf, $data_nascimento, $telefone) {
        $conn = Banco::getConn();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        return $conn->query(
            "INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento, telefone, tipo) 
             VALUES ('$nome', '$email', '$senhaHash', '$cpf', '$data_nascimento', '$telefone', 'cliente')"
        );
    }

    public static function cadastrarAdmin($nome, $email, $senha, $cpf, $data_nascimento, $telefone) {
        $conn = Banco::getConn();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        return $conn->query(
            "INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento, telefone, tipo) 
             VALUES ('$nome', '$email', '$senhaHash', '$cpf', '$data_nascimento', '$telefone', 'admin')"
        );
    }

    public static function autenticar($email, $senha) {
        $usuario = self::buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }
}
?>

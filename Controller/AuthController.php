<?php
// Controller/AuthController.php

require_once __DIR__ . "/../Model/Usuario.php"; // Aqui o ../ está correto!

class AuthController {

    public static function exibirLogin() {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['usuario']['tipo'] == 'admin') {
                header('Location: ?p=barbeiros');
            } else {
                header('Location: ?p=dashboard');
            }
            exit;
        }

        require __DIR__ . "/../View/login.php";
    }

    public static function exibirCadastro() {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['usuario']['tipo'] == 'admin') {
                header('Location: ?p=barbeiros');
            } else {
                header('Location: ?p=dashboard');
            }
            exit;
        }

        require __DIR__ . "/../View/cadastro.php";
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuario = Usuario::autenticar($email, $senha);

            if ($usuario) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'tipo' => $usuario['tipo'],
                    'email' => $email 
                ];

                if ($usuario['tipo'] == 'admin') {
                    header('Location: ?p=barbeiros');
                } else {
                    header('Location: ?p=dashboard');
                }
                exit;
            } else {
                header('Location: ?p=login&erro=1');
                exit;
            }
        }
    }

    public static function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
                die("ERRO DE SEGURANÇA: Token CSRF inválido.");
            }

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confirmar_senha = $_POST['confirmar_senha'];
            $cpf = $_POST['cpf'];
            $data_nascimento = $_POST['data_nascimento'];
            $telefone = $_POST['telefone'];

            if ($nome && $email && $senha && $cpf && $data_nascimento) {
                if ($senha == $confirmar_senha) {
                    $usuarioExistente = Usuario::buscarPorEmail($email);

                    if (!$usuarioExistente) {
                        $resultado = Usuario::cadastrar($nome, $email, $senha, $cpf, $data_nascimento, $telefone);

                        if ($resultado) {
                            header('Location: ?p=login&sucesso=1');
                            exit;
                        }
                    }
                }
            }

            header('Location: ?p=cadastro&erro=1');
            exit;
        }
    }

    public static function logout() {
        unset($_SESSION['usuario']);
        header('Location: ?p=login');
        exit;
    }
}
?>
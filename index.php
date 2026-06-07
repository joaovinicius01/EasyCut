<?php 
// index.php
session_start(); 

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = "token_seguro_easycut_123"; 
}

require_once __DIR__ . "/Config/banco1.php";
$url = $_GET['p'] ?? null;
require_once __DIR__ . "/Controller/AuthController.php";
require_once __DIR__ . "/Controller/AgendamentosController.php";
require_once __DIR__ . "/Controller/BarbeirosController.php";

if ($url == 'login') {
    AuthController::exibirLogin();
}
else if ($url == 'cadastro') {
    AuthController::exibirCadastro();
}
else if ($url == 'entrar') {
    AuthController::login();
}
else if ($url == 'registrar') {
    AuthController::cadastrar();
}
else if ($url == 'sair') {
    AuthController::logout();
}
else if ($url == 'dashboard') {
    AgendamentosController::index();
}
else if ($url == 'agendamentos-admin') {
    AgendamentosController::listarAdmin();
} 
else if ($url == 'novo-agendamento') {
    AgendamentosController::formularioCriar();
}
else if ($url == 'salvar-agendamento') {
    AgendamentosController::addAgendamento(); 
}
else if ($url == 'editar-agendamento') {
    AgendamentosController::editarAgendamento();
}
else if ($url == 'atualizar-agendamento') {
    AgendamentosController::atualizarAgendamento();
}
else if ($url == 'excluir-agendamento') {
    AgendamentosController::apagarAgendamento();
}
else if ($url == 'barbeiros') {
    BarbeirosController::listarBarbeiros();
}
else if ($url == 'cadastrar-barbeiro') {
    BarbeirosController::formularioCadastrar();
}
else if ($url == 'salvar-barbeiro') {
    BarbeirosController::cadastrarBarbeiro();
}
else if ($url == 'editar-barbeiro') {
    BarbeirosController::editarBarbeiro();
}
else if ($url == 'atualizar-barbeiro') {
    BarbeirosController::atualizarBarbeiro();
}
else if ($url == 'excluir-barbeiro') {
    BarbeirosController::apagarBarbeiro();
}
else {
    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario']['tipo'] == 'admin') {
            header('Location: ?p=barbeiros');
        } else {
            header('Location: ?p=dashboard');
        }
    } else {
        header('Location: ?p=login');
    }
    exit;
}
?>
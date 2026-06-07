<?php 
// index.php
session_start(); 

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = "token_seguro_easycut_123"; 
}

require_once __DIR__ . "/Config/banco1.php";
$url = $_GET['p'] ?? null;
require_once __DIR__ . "/Controller/AgendamentosController.php";

if ($url == 'dashboard') {
    AgendamentosController::index();
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
else {
    AgendamentosController::index();
}
?>
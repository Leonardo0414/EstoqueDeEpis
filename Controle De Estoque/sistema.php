<?php 
//CONTROLE DE SESSAO
session_start();
if (!isset($_SESSION['logado'])) { 
    header('LOCATION: index.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de EPIs</title>
    <link href="assets/css/sistema.css" rel="stylesheet"> <!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><!-- BOOTSTRAT PARA LAYOUT E BOTOES -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"><!-- BOOTSTRAP PARA ICONES -->
</head>

<body>
     <!-- ABERTURA DA DIV PARA ITENS NA BARRA SUPERIOR ORGANIZACAO NAS CLASSES VALORES ID PARA CHAMAR FUNCOES-->
    <div class="top-bar d-flex justify-content-between align-items-center px-3">

    <!--REOLOGIO E DATA-->
        <div class="clock d-flex align-items-center">
            <span id="date" class="me-2"></span>
            <span id="time"></span>
        </div>

          <!-- CHAMA A FUNCAO TEMA NO JS-->
        <div>
            <button onclick="tema()" class="btn btn-sm btn-light toggle-theme">🌙 Modo Escuro</button>
            <button class="btn btn-sm btn-danger" onclick="Sair()">Sair</button>
        </div>
    </div>

    <div class="dashboard-container mt-4"><!--ABERTURA DE DIV E CLASSE PARA ORGANIZACAO CONTAINER(BOO)-->
        <!--CRIACAO DE 4 CARD PARA ACESSAR AS VIEWS BOOTSTRAP E CSS PERSONALIZADO-->
        <div class="card">
            <i class="bi bi-person-plus-fill display-4"></i>
            <h5>Cadastro de Usuários</h5>
            <p>Crie novos usuários para o sistema</p>
            <a href="src/views/Usuarios/index.php" class="btn btn-primary">Acessar</a>
        </div>

        <div class="card">
            <i class="bi bi-people-fill display-4"></i>
            <h5>Cadastro de Colaboradores</h5>
            <p>Gerencie os colaboradores que utilizam EPIs</p>
            <a href="src/views/Colaboradores/index.php" class="btn btn-primary">Acessar</a>
        </div>

        <div class="card">
            <i class="bi bi-shield-fill-check display-4"></i>
            <h5>Cadastro de EPIs</h5>
            <p>Gerencie e cadastre novos EPIs</p>
            <a href="src/views/Equipamentos/index.php" class="btn btn-primary">Acessar</a>
        </div>

        <div class="card">
            <i class="bi bi-cart-check-fill display-4"></i>
            <h5>Empréstimo de EPIs</h5>
            <p>Gerencie o empréstimo de EPIs</p>
            <a href="src/views/Emprestimos/index.php" class="btn btn-primary">Acessar</a>
        </div>
    </div>
        <!--RODAPE-->
        <footer class="footer-bar">
           <p class="m-0">Sistema: Versão 1.0.0</p>
         </footer>

    <script src="assets/js/sistema.js"></script><!--IMPORTACAO DO JS PARA O SISTEMA-->
    <script src="assets/js/index.js"></script><!--IMPORTA O USUARIO PARA DESLOGAR NO SAIR-->
</body>
</html>

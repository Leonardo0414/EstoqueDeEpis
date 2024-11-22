<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">   <!--BIBLIOTECA DO BOOTSTRAP-->
    <link href="../../../assets/css/views.css" rel="stylesheet">  <!--CHAMA O CSS PERSONALIADO-->
</head>

<body>
    <div class="container"><!--CONTAINER BOOTSTRAP-->
        <h1 class="text-center">Gerenciamento dos Usuários</h1>
        <!-- BARRA DE PESQUISA -->
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Pesquise Nome ou ID">
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
          <!--TABELA DOS USUARIOS IMPRIMIR TABELA 1° PARA NAO SOBRE POR-->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody  id="tabela-usuarios" ></tbody><!--RECEBE OS VALORE DAS TABELA EM POSICOES E PASSA PARA UM ID FECHAMENTO DA TABELA EMBAIXO-->
            </table>
        </div>
    </div>

    <!-- JQUERY E AS FUNCOES-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Usuarios/cadastrados.js"></script>
</body>
</html>

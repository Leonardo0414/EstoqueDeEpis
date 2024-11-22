<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Colaboradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/views.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Gerenciamento de Colaboradores</h1>
        <!--CAMPO PESQUISA-->
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Pesquise Por Nome Ou CPF">
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
        <!--TABELA-->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Nascimento</th>
                    </tr>
                </thead>
                <tbody id="tabela-colaborador"></tbody><!--VALORES IMPRESSOS NA TABELA-->
            </table>
        </div>
    </div>
    <!--CSS JQUERY-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Colaboradores/cadastrados.js"></script>
</body>
</html>

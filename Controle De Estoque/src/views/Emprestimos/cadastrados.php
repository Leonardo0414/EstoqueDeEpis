<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Gerenciamento de Empréstimos</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--CSS-->
    <link href="../../../assets/css/views.css" rel="stylesheet"> <!--BOOTSTRAT-->
</head>

<body>
    <div class="container"> 
        <h1 class="text-center">Gerenciamento de Empréstimos</h1> 
        <!--CAMPO DE PESQUISA-->
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Pesquise por EPI ou Fabricante...">
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </div>
        <!--TABELA-->
        <div class="table-container">
            <table class="table"> 
                <thead> 
                    <tr>
                        <th>ID</th> 
                        <th>EPI</th> 
                        <th>DATA RETIRADA</th> 
                        <th>DATA DEVOLUÇÃO</th>
                        <th>NOME DO COLABORADOR</th> 
                        <th>QUANTIDADE</th>
                        <th>SITUAÇÃO</th> 
                    </tr>
                </thead>
                <tbody id="tabela-Emprestimos"></tbody><!--VALORES IMPRESSOS-->
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Emprestimos/cadastrados.js"></script>
   
</body>
</html>

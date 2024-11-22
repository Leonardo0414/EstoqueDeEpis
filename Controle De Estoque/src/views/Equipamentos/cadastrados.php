<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Gerenciamento de EPIs</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--BOOTSTRAP-->
    <link href="../../../assets/css/views.css" rel="stylesheet"> <!--CSS-->
</head>
<body>
    <div class="container"> 
        <h1 class="text-center">Gerenciamento de Equipamentos</h1> 
        <!--BARRA DE PESQUISA-->
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
                        <th>DESCRIÇÃO</th> 
                        <th>COD BARRAS</th> 
                        <th>FOTO</th>
                        <th>QUANTIDADE</th> 
                        <th>AÇÕES</th> 
                    </tr>
                </thead>
                <tbody id="tabela-equipamentos"></tbody><!--IMPRESSAO DOS VALORES RECEBIDOS-->
            </table>
        </div>
    </div>
    <!--ABERTURA DE MODAL-->
    <div class="modal fade" id="imagemModal" tabindex="-1" aria-labelledby="imagemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagemModalLabel">Visualização de Imagens</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- VISUALIZACAO CODIGO DE BARRAS-->
                <div class="modal-body">
                    <h6>Código de Barras</h6>
                    <img id="modalCodBarras" src="" class="img-fluid mb-3" alt="Código de Barras">
                    <!--VISUALAIZACAO DO EQUIPAMENTO-->
                    <h6>Foto do EPI</h6>
                    <img id="modalFotoEpi" src="" class="img-fluid" alt="Foto do EPI">
                </div>
            </div>
        </div>
    </div>

    <!--BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--JS  E JQUERY-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Equipamentos/cadastrados.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de EPIs - Sistema de Controle</title>
    <link href="../../../assets/css/views.css" rel="stylesheet"><!--CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><!--BOOTSTRAP-->
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastro de Equipamentos</h1>
        <form id="form-equipamentos" onsubmit="Salvar(); return false;" enctype="multipart/form-data">

        <!--CAMPO DO ID COM BOTAO DE CODIGO DDE BARRAS LIMITE ID PARA EVITAR PROBLEMA SQL-->
            <div class="mb-3 input-group">
                <label for="txt_idEquipamento" class="form-label w-100">ID Produto</label>
                <input type="text" id="txt_idEquipamento" class="form-control" aria-label="ID do Produto" required maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                <button type="button" class="btn btn-primary" onclick="GerarBarras()">Gerar Código de Barras</button>
            </div>
            <div class="mb-3">
                <img id="img_barras" src="" alt="Gerar o Codigo de Barras" style="max-width: 150px; max-height: 50px;">
            </div>
            <!--CAMPO DA DESCRICAO-->
            <div class="row">
                <div class="col-md-6">
                    <label for="txt_descricao" class="form-label">Descrição</label>
                    <input type="text" id="txt_descricao" class="form-control" placeholder="Ex: Bota" required>
                </div>
                <!--CAMPO DE UPLOAD DE IMAGEN-->
                <div class="col-md-6">
                    <label for="img_foto" class="form-label">Imagem</label>
                    <input type="file" class="form-control" id="img_foto" name="imgfoto">
                </div>
                <!-- CAMPO DE QUATIDADE-->
                <div class="col-md-6">
                    <label for="txt_quantidade" class="form-label">Quantidade a Registrar</label>
                    <input type="text" id="txt_quantidade" class="form-control" placeholder="Ex: 50 unidades" required maxlength="20" oninput="this.value = this.value.replace(/[^0-9]/g, '')"> 
                </div>
            </div>
        <br><!--ESPACO PARA OS BOTOES-->
            <!-- BOTÕES PARA AÇÕES DO FORMULARIOR -->
            <div class="text-center">
                <button class="btn btn-success" onclick="Salvar()">Salvar EPI</button>
                <a href="cadastrados.php" class="btn btn-primary" type="reset">Ver EPIs Cadastrados</a>
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <a href="../../../sistema.php" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

      <!-- JQUERY E FUNCOES JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/Equipamentos/index.js"></script>
</body>
</html>

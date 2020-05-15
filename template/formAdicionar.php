<?php $v->layout("__theme"); ?>
    <div class="list">
        <h1 class="list-text">Cadastrar veiculo</h1>
        <a class="btn btn-primary" href="<?= url() ?>">voltar</a>
    </div>
    <form method="POST" action="adicionar" class="form">
        <div class="alert " id="alert" style="display: none;" role="alert">
        </div>
        <input type="hidden" name="_method" value="POST" />
        <label for="modelo">Modelo <span class="form-required">*</span></label>
        <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ex: Corsa, Gol, Uno">
        <span id="modeloHelp" class="form-text text-muted"></span>
        <label for="marca">Marca <span class="form-required">*<span></label>
        <input type="text" id="marca" name="marca" class="form-control" placeholder="Ex: GM, Volkswagen, FIAT">
        <span id="marcaHelp" class="form-text text-muted"></span>
        <label for="placa">Placa <span class="form-required">*<span></label>
        <input type="text" id="placa" name="placa" class="form-control" placeholder="Ex: XXX-0000">
        <span id="placaHelp" class="form-text text-muted"></span>
        
        <p><span class="form-required">*</span> Campo obrigatorio.</p>
        <input type="submit" id="btn-adicionar" value="Cadastrar novo veiculo" class="btn btn-outline-primary btn-form">
    </form>
    <?php $v->start("script"); ?>
    <script src="<?= url()?>/template/assets/js/formAdicionar.js"></script>
    <?php $v->stop(); ?>
<?php $v->layout("__theme");?>
    <div class="list">
        <h1 class="list-text">Editar veiculo</h1>
        <a class="btn btn-primary" href="<?= url(); ?>">voltar</a>
    </div>
    <?php if($veiculo):?>
    <form method="POST" action="editar" class="form">
        <input type="hidden" name="_method" value="POST" />
        <input type="hidden" name="id" id="id" value="<?= $veiculo->id?>" />
        <div class="alert " id="alert" style="display: none;" role="alert">
        </div>
        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" value="<?= $veiculo->modelo?>" class="form-control" placeholder="Ex: Corsa, Gol, Uno">
        <spam id="modeloHelp" class="form-text text-muted"></spam>
        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="<?= $veiculo->marca?>" class="form-control" placeholder="Ex: GM, Volkswagen, FIAT">
        <spam id="marcaHelp" class="form-text text-muted"></spam>
        <label for="placa">Placa</label>
        <input type="text" id="placa" name="placa" value="<?= $veiculo->placa?>" class="form-control" placeholder="Ex: XXX-0000">
        <spam id="placaHelp" class="form-text text-muted"></spam>

        <input type="submit" id="btn-editar" value="Editar veiculo" class="btn btn-outline-primary btn-form">
    </form>
    <?php else:?>
        <h1 class="text-center text-danger">Veiculo não encotrado.</h1>
    <?php endif;?>
    <?php $v->start("script"); ?>
    <script src="<?=url()?>/template/assets/js/formEditar.js"></script>
    <?php $v->stop(); ?>
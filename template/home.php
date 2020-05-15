<?php $v->layout("__theme");?>
    <div class="list">
        <h1 class="list-text">Listagem de veiculos</h1>
    </div>
    <div class="list-pesquisa form-inline">
        <input type="radio" checked class="form-check-input" name="modo" id="placa"><label for="placa">Placa</label>
        <input type="radio" class="form-check-input" name="modo" id="marcaModelo"><label for="marcaModelo">Marca e Modelo</label> 
        <a href="<?= url();?>" class="btn-resetar">Resetar</a>
        <input type="search" name="pesquisa" id="pesquisa" class="form-control" value="" placeholder="Buscar"/>
        <a href="" class="btn btn-primary btn-pesquisar" id="btn-pesquisar">Pesquisar</a>
        <a class="btn btn-primary btn-adicionar" href="adicionar">Cadastrar novo veiculo</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>Data de Cadastro</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody id="table-body">
            <?php foreach ($veiculos as $veiculo):?>
                <tr id="tr-<?=$veiculo->getId()?>">
                    <td><?= $veiculo->getModelo()?></td>
                    <td><?= $veiculo->getMarca()?></td>
                    <td><?= $veiculo->getPlaca()?></td>
                    <td><?= date("d/m/yy", strtotime($veiculo->getDataCadastro()));?></td>
                    <td><a  class="table-link" href="editar/<?=$veiculo->getId()?>"><i class="icon-pencil2"></i></a></td>
                    <td><a href="" class="excluir table-link" id="<?= $veiculo->getId() ?>"><i class="icon-bin"></i></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php $v->start("script")?>
        <script src="<?= url()?>/template/assets/js/sweet.min.js"></script>
        <script src="<?= url()?>/template/assets/js/home.js"></script>
        <?php $v->stop(); ?>
    </div>

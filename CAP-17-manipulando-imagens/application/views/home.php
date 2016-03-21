<?php $this->load->view('commons/header'); ?>

<div class="container">
  <div class="page-header">
    <h1>Capítulo 17 - Manipulação de Imagens</h1>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php if(isset($info)){?>
      <div class="alert alert-info">
        <?=$info?>
      </div>
      <?php  } ?>
      <form action="<?=base_url('base/upload')?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>Selecione uma imagem</label>
          <input type="file" name="image" />
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="thumbnail"> Criar thumbnail
          </label>
        </div>
        <div class="form-group">
          <label>Largura da Imagem após redimensionar (em pixels)</label>
          <input type="number" name="width" class="form-control"/>
        </div>
        <div class="form-group">
          <label>Altura da Imagem após redimensionar (em pixels)</label>
          <input type="number" name="height" class="form-control" />
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="ratio"> Manter proporção
          </label>
        </div>
        <div class="form-group">
          <label>Girar Imagem?</label>
          <select name="rotation" class="form-control">
            <option value="">Não girar</option>
            <option value="90">90 graus</option>
            <option value="180">180 graus</option>
            <option value="270">270 graus</option>
            <option value="hor">Na Horizontal</option>
            <option value="vrt">Na vertical</option>
          </select>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="crop"> Recortar imagem?
          </label>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="watermark"> Inserir marca d'água
          </label>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-success pull-right" value="Processar" />
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('commons/footer'); ?>

<?php $this->load->view('commons/header')?>

<div class="container">
  <div class="page-header">
    <h1>Encurte e compartilhe</h1>
    <p>URL menor, TEXTO maior.</p>
  </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <?php
        if($error){
      ?>
      <div class="alert alert-danger" role="alert"><?=$error?></div>
      <?php
        }
      ?>

      <form action="<?=base_url()?>" method="POST">
        <label class="col-md-8 col-md-offset-2">
          <input type="text" class="form-control" placeholder="URL" name="address"/>
        </label>
        <label class="col-md-2"><input type="submit" class="btn btn-success" value="Encurtar"/></label>
      </form>
    </div>
    <div class="col-md-8 col-md-offset-2 col-sm-12">
      <?php
        if($short_url){
      ?>
      <p class="text-center"><a href="<?=$short_url?>" target="_blank"><?=$short_url?></a></p>
      <?php
        }
      ?>
    </div>
  </div>
</div>

<?php $this->load->view('commons/footer')?>

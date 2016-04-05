<?php $this->load->view('commons/header')?>

<div class="container">
  <div class="col-md-4 col-md-offset-4">
    <h2 class="col-md-12">Alterar Senha</h2>
    <form action="<?=base_url('alterar-senha')?>" method="POST">
      <label class="col-md-12">
        <?=$user->email?>
      </label>
      <label class="col-md-12">
        <input type="password" class="form-control" placeholder="Nova Senha" name="passw" required/>
      </label>
      <label class="col-md-12"><input type="submit" class="btn btn-success" value="Alterar"/></label>
    </form>
  </div>
  <div class="col-md-4 col-md-offset-4">
    <?php
      if($error){
    ?>
    <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?php
      }
    ?>

    <?php
      if($success){
    ?>
    <div class="alert alert-success" role="alert"><?=$success?></div>
    <?php
      }
    ?>
  </div>
</div>

<?php $this->load->view('commons/footer')?>

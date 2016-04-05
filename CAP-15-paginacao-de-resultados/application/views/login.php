<?php $this->load->view('commons/header')?>

<div class="container">

  <?php
    if($error){
  ?>
  <div class="alert alert-danger" role="alert"><?=$error?></div>
  <?php
    }
  ?>
  <div class="col-md-4 col-md-offset-1">
    <h2 class="col-md-12">Login</h2>
    <form action="<?=base_url('login')?>" method="POST">
      <label class="col-md-12">
        <input type="text" class="form-control" placeholder="Email" name="email" required/>
      </label>
      <label class="col-md-12">
        <input type="password" class="form-control" placeholder="Senha" name="passw" required/>
      </label>
      <label class="col-md-12"><input type="submit" class="btn btn-success" value="Entrar"/></label>
    </form>
  </div>
  <div class="col-md-4 col-md-offset-1">
    <h2 class="col-md-12">Cadastre-se</h2>
    <form action="<?=base_url('user/register')?>" method="POST">
      <label class="col-md-12">
        <input type="text" class="form-control" placeholder="Nome (opcional)" name="name"/>
      </label>
      <label class="col-md-12">
        <input type="text" class="form-control" placeholder="Email" name="email" required/>
      </label>
      <label class="col-md-12">
        <input type="password" class="form-control" placeholder="Senha" name="passw" required/>
      </label>
      <label class="col-md-12"><input type="submit" class="btn btn-success" value="Cadastrar"/></label>
    </form>
  </div>

</div>

<?php $this->load->view('commons/footer')?>

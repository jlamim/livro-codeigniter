<?php $this->load->view('commons/header'); ?>

<div class="container">
  <div class="page-header">
    <h1>Fale Conosco</h1>
  </div>
  <div class="row">
    <div class="col-md-8">
      <?php if($formErrors){?>
        <div class="alert alert-danger">
          <?=$formErrors?>
        </div>
      <?php }else{
         if($this->session->flashdata('success_msg')) {?>
        <div class="alert alert-success">
          <?=$this->session->flashdata('success_msg')?>
        </div>
      <?php } } ?>
      <form class="form-horizontal" method="POST" action="<?=base_url('fale-conosco')?>">

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label" for="nome">Nome</label>
          <div class="col-md-8">
            <input id="nome" name="nome" placeholder="Nome" class="form-control input-md" required="" type="text" value="<?=set_value('nome')?>">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label" for="email">Email</label>
          <div class="col-md-8">
            <input id="email" name="email" placeholder="Email" class="form-control input-md" required="" type="text" value="<?=set_value('email')?>">
            <span class="help-block">Ex.: email@example.com</span>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label" for="assunto">Assunto</label>
          <div class="col-md-8">
            <input id="assunto" name="assunto" placeholder="Assunto" class="form-control input-md" required="" type="text" value="<?=set_value('assunto')?>">

          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-2 control-label" for="mensagem">Mensagem</label>
          <div class="col-md-8">
            <textarea class="form-control" id="mensagem" name="mensagem" rows="10"><?=set_value('mensagem')?></textarea>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <div class="col-md-10">
            <input type="submit" value="Enviar" class="btn btn-default pull-right"/>
          </div>
        </div>

      </form>

    </div>
    <div class="col-md-4">
      <h4>Telefones</h4>
      <p>+55 99 9999-9999 | +55 88 8888-8888</p>
      <hr/>
      <h4>E-mail</h4>
      <p>contato@empresa.com.br</p>
      <hr/>
      <h4>Endereço</h4>
      <p>R. Quinze de Novembro - Praia da Costa, Vila Velha - ES </p>
      <hr/>
      <div class="embed-responsive embed-responsive-4by3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3741.1532158870327!2d-40.286650485399!3d-20.335288186378026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xb8163812c6b305%3A0xe71db7e3d9c94285!2sR.+Quinze+de+Novembro+-+Praia+da+Costa%2C+Vila+Velha+-+ES!5e0!3m2!1spt-BR!2sbr!4v1449523768427" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('commons/footer'); ?>

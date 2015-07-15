<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="login"></div>
<div class="container">
  <div class="page-login row-products-filter">
    <div class="page-header">
      <ol class="breadcrumb pull-left">
        <li><a href="<?= base_url () ?>">Ana Angulo</a></li>
        <? if($this->Data->idUser): ?><li><a href="<?= base_url () ?>cart">Cesta</a></li><? endif ?>
        <li class="active">Identificación</li>
      </ol>
    </div>
    <div class="clearfix"></div>
    <? if($this->Data->idUser): ?>
    <ul class="checkout-steps">
      <li class="ok"><a href="<?= base_url()?>mi-cuenta">Identificación</a></li>
      <li><a class="disabled">Envío</a></li>
      <li><a class="disabled">Pago</a></li>
      
    </ul>
  <? endif ?>
    <div class="row">
      <div class="col-sm-6">
        <div class="panel-body">
        <div>
          <form id="login-form" action="<?= base_url() ?>mi-cuenta/login" role="form" method="post">
            <div class="col-xs-offset-3 col-xs-9 no-padding">
              <div class="form-title">Soy Cliente</div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label for="email">*E-mail</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="mail" value="<?= $this->input->post('mail') ?>" id="email" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label for="password">*Contraseña</label>
              </div>
              <div class="col-xs-9">
                <input type="password" name="password" value="<?= $this->input->post('password') ?>" id="password" tabindex="2" class="form-control">
              </div>
            </div>
            <div class="col-xs-offset-3 col-xs-9">
              <small>*Campos obligatorios</small>
            </div>
            <div class="clearfix"></div>
            <?php if(isset($error)):
            $errorArr['fields'] = 'Debes completar todos los campos';
            $errorArr['mail'] = 'El correo electrónico ingresado es inválido';
            $errorArr['noexists'] = 'El correo electrónico ingresado no se encuentra registrado';
            $errorArr['state'] = 'La cuenta se encuentra suspendida';
            $errorArr['password'] = 'La contraseña ingresada es incorrecta';
            ?>
            <div class="col-xs-offset-3 col-xs-9">
              <p class="info-box-error"><?php echo $errorArr[$error] ?></p>
            </div>
            <? endif ?>
            <?/*
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <div class="text-center">
                    <a href="/recover" tabindex="5" class="forgot-password">> No recuerdo mi contraseña</a>
                  </div>
                </div>
              </div>
            </div>
            */?>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" id="login-submit" tabindex="3" class="form-primary btn btn-block btn-default" value="Iniciar sesion">
                </div>
              </div>
            </div>
          </form>
        </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel-body panel-body-first-time">
          <div class="row">
            
            <div class="form-title col-md-offset-3 col-md-6 col-xs-offset-1 col-xs-10 no-padding">Primera vez que compro</div>
          </div>
          
          <p class="text-center text-sign-up">            
          Crear una cuenta para poder procesar tu pedido y recibir información sobre el estado del envió.
          </p>


          <form id="login-form" action="<?= base_url() ?>mi-cuenta/registro" role="form" method="post">
            <input type="hidden" name="action" value="2" />
            <div class="form-group">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <input type="submit" name="login-submit" id="login-submit" tabindex="2" class="form-primary btn btn-block btn-default" value="Continuar">
                </div>
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>  
</div>
<?php $this->load->view('common/footer') ?>

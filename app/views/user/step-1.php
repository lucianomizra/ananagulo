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
      <div class="info-menu info-menu-mobile">
        <h3><a class="arr-left" href="javascript:window.history.back()"><span class="glyphicon glyphicon-triangle-left"></span></a><span class="app-bold">Identificación</span> > Envío > Pago</h3>
       </div>

    <ul class="checkout-steps step-1ch">
      <li class="ok fok"><a href="<?= base_url()?>mi-cuenta">Identificación</a></li>
      <li><a class="disabled">Envío</a></li>
      <li><a class="disabled">Pago</a></li>
      
    </ul>
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
                <input type="text" placeholder="*E-mail" name="mail" value="<?= $this->input->post('mail') ?>" id="email" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label for="password">*Contraseña</label>
              </div>
              <div class="col-xs-9">
                <input type="password" placeholder="*Contraseña" name="password" value="<?= $this->input->post('password') ?>" id="password" tabindex="2" class="form-control">
              </div>
            </div>
            <div class="col-xs-offset-3 col-xs-9">
              <small>*Campos obligatorios</small>
            </div>
            <div class="clearfix"></div>
            <?php if(isset($errorLo)):
            $errorArr['fields'] = 'Debes completar todos los campos';
            $errorArr['mail'] = 'El correo electrónico ingresado es inválido';
            $errorArr['noexists'] = 'El correo electrónico ingresado no se encuentra registrado';
            $errorArr['state'] = 'La cuenta se encuentra suspendida';
            $errorArr['password'] = 'La contraseña ingresada es incorrecta';
            ?>
            <div class="col-xs-offset-3 col-xs-9">
              <p class="info-box-error"><?php echo $errorArr[$errorLo] ?></p>
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
            
            <div class="form-title col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10 no-padding">Mi primera vez</div>
          </div>

          <form id="login-form" action="<?= base_url() ?>mi-cuenta/registro" role="form" method="post">
 						<div class="form-group row">
              <div class="col-xs-3">
                <label for="name">*Nombre</label>
              </div>
              <div class="col-xs-9">
                <input type="text" placeholder="*Nombre" name="name" value="<?= $this->input->post('name') ?>" id="name" tabindex="1" class="form-control">
              </div>
            </div>
 						<div class="form-group row">
              <div class="col-xs-3">
                <label for="lastname">*Apellido</label>
              </div>
              <div class="col-xs-9">
                <input type="text" placeholder="*Apellido" name="lastname" value="<?= $this->input->post('lastname') ?>" id="lastname" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label for="email">*E-mail</label>
              </div>
              <div class="col-xs-9">
                <input type="text" placeholder="*E-mail" name="mail" value="<?= $this->input->post('mail') ?>" id="email" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label for="password">*Contraseña</label>
              </div>
              <div class="col-xs-9">
                <input type="password" placeholder="*Contraseña" name="password" value="<?= $this->input->post('password') ?>" id="password" tabindex="2" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label for="password2">*Repetir contraseña</label>
              </div>
              <div class="col-xs-9">
                <input type="password" placeholder="*Repetir contraseña" name="password2" value="<?= $this->input->post('password2') ?>" id="password2" tabindex="2" class="form-control">
              </div>
            </div>
            <div class="clearfix"></div>
            <?php if(isset($error)):

                $errorArr['fields'] = 'Debes completar todos los campos';
                $errorArr['privacy'] = 'Debes aceptar las políticas de privacidad';
                $errorArr['mail'] = 'El correo electrónico ingresado es inválido';
                $errorArr['mail2'] = 'El correo electrónico ingresado ya ha sido registrado';
                $errorArr['password'] = 'La confirmación de la contraseña es incorrecta';
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
                  <input type="submit" id="registro-submit" tabindex="3" class="form-primary btn btn-block btn-default" value="Continuar">
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

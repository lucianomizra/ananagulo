<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="login"></div>
<div class="container">
  <div class="page-login row-products-filter">
    <div class="page-header">
      <ol class="breadcrumb pull-left">
        <li><a href="<?= base_url () ?>">Ana Angulo</a></li>
        <li><a href="<?= base_url () ?>cart">Cesta</a></li>
        <li class="active">Identificación</li>
      </ol>
    </div>
    <div class="clearfix"></div>

    <ul class="checkout-steps">
      <li class="ok"><a href="<?= base_url()?>mi-cuenta">Identificación</a></li>
      <li><a class="disabled">Envío</a></li>
      <li><a class="disabled">Pago</a></li>
      
    </ul>
    <form id="login-form" action="<?= base_url() ?>mi-cuenta/step-2" role="form" method="post">
    <input type="hidden" name="level" value="2" />
    <div class="row">
      <div class="col-sm-6">
        <div class="panel-body">
        <div>
            <div class="col-xs-offset-3 col-xs-9 no-padding">
              <div class="form-title">Datos de facturación</div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Nombre</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="name" value="<?= $fdata['name'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Apellido</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="lastname" value="<?= $fdata['lastname'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*E-Mail</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="mail" value="<?= $fdata['mail'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*CIF/NIF</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="dni" value="<?= $fdata['dni'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <? if(!$this->Data->idUser): ?>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Contraseña</label>
              </div>
              <div class="col-xs-9">
                <input type="password" name="password" value="<?= $fdata['password'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Confirmar contraseña</label>
              </div>
              <div class="col-xs-9">
                <input type="password" name="password2" value="<?= $fdata['password2'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <? endif ?>
            <div class="clearfix"></div>
        </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel-body">
        <div>
            <div class="col-xs-offset-3 col-xs-9 no-padding">
              <div class="form-title">Datos de envío</div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Dirección</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="dir1" value="<?= $fdata['dir1'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Código postal</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="cp" value="<?= $fdata['cp'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Localidad</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="city" value="<?= $fdata['city'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-3">
                <label>*Telf. de contacto</label>
              </div>
              <div class="col-xs-9">
                <input type="text" name="cel" value="<?= $fdata['cel'] ?>" tabindex="1" class="form-control">
              </div>
            </div>
            <div class="col-xs-offset-3 col-xs-9">
              <small>*Campos obligatorios</small>
            </div>
            <div class="clearfix"></div>
        </div>
        </div>
      </div>

    </div>
          <div class="form-group">
            <div class="margin-bottomx30">
            <div class="row">
              <div class="col-sm-12 text-center">
              <?php if(isset($error)):
                $errorArr['fields'] = 'Debes completar todos los campos';
                $errorArr['privacy'] = 'Debes aceptar las políticas de privacidad';
                $errorArr['mail'] = 'El correo electrónico ingresado es inválido';
                $errorArr['mail2'] = 'El correo electrónico ingresado ya ha sido registrado';
                $errorArr['password'] = 'La confirmación de la contraseña es incorrecta';
              ?>
              <div class="margin-bottomx30">
                <p class="info-box-error"><?php echo $errorArr[$error] ?></p>
              </div>
              <? endif ?>
                 <a href="<?= base_url() ?>mi-cuenta/step-1" class="btn btn-default" style="margin-right:10px">Atrás</a>
                <input type="submit" id="login-submit" tabindex="3" class="form-primary btn btn-default" value="Continuar">
              </div>
            </div>
            </div>
          </div>
    </form>
  </div>  
</div>
<?php $this->load->view('common/footer') ?>
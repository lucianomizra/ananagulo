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
          <div class="register-social">
          <div class="row">
            <div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10 no-padding">
            <p class="text1">Acceder con una cuenta de red social es más rápido que hacerlo con una de email.</p>
            <div class="buttons">
              <p><a style="cursor:pointer" id='fb-login'><img style="width:100%;max-width:314px" src="<?= layout('imgs/login.png') ?>" /></a></p>
              <p><a style="cursor:pointer" id='gplus-login'><img style="width:100%;max-width:314px" src="<?= layout('imgs/login2.png') ?>" /></a></p>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-3 col-md-9 col-xs-offset-1 col-xs-10 no-padding">
            <p class="text2">O bien rellenando los siguientes datos:</p>
            </div>
          </div>
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
                $errorArr['privacy'] = 'Debes aceptar nuestros Términos y condiciones';
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
            <div class="form-group row text-left">
              <div class="col-sm-1 col-sm-offset-3">
                <input id="newsletter" <? if($this->input->post('newsletter') || !$this->input->post()): ?> checked="checked"<? endif ?> type="checkbox" name="newsletter" value="1">
              </div>
              <div style="margin-left:-10px; padding: 5px 0 0;" class="col-sm-8">
                <label class="dd" for="newsletter">Quiero recibir descuentos exclusivos y noticias de moda Ana Angulo por email, correo y mensages de texto.</label>
              </div>
            </div>
            <?/*
            <div class="form-group row text-left">
              <div class="col-sm-1 col-sm-offset-3">
                <input id="newsletter2" <? if($this->input->post('newsletter2')): ?> checked="checked"<? endif ?> type="checkbox" name="newsletter2" value="1">
              </div>
              <div style="margin-left:-10px; padding: 5px 0 0;" class="col-sm-8">
                <label class="dd" for="newsletter2">De acuerdo, enviadme noticias de otras marcas asociadas a Ana Angulo por email, correo o mensajes de texto. <a target="_blank" style="text-decoration:underline" href="<?= base_url() ?>informacion/terminos-y-condiciones">Política de privacidad</a>.</label>
              </div>
            </div>*/?>
            <div class="form-group row text-left">
              <div class="col-sm-1 col-sm-offset-3">
                <input id="privacy" <? if($this->input->post('privacy')): ?> checked="checked"<? endif ?> type="checkbox" name="privacy" value="1">
              </div>
              <div style="margin-left:-10px; padding: 5px 0 0;" class="col-sm-8">
                <label class="dd" for="privacy">Al crear tu cuenta, aceptas nuestros <a target="_blank" href="<?= base_url() ?>informacion/politica-de-datos" style="text-decoration:underline">Términos y condiciones</a>.</label>
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>  
</div>
<script>
var clientId = '114132691237-p0cnj30qsiqqht9cf78nddg5b0q5h166.apps.googleusercontent.com';
var apiKey = 'AIzaSyDvVz8-Lrzq004La3aFJUXpaSk7R8QlIMk';
var scopes = 'https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email';
function handleClientLoad() {
  gapi.client.setApiKey(apiKey);
  window.setTimeout(checkAuth,1);
}
function checkAuth() {
gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, function(){});
}
$('#gplus-login').click(function(event) {
  gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
});
function handleAuthResult(authResult) {
if (authResult && !authResult.error) {
  makeApiCall();
}
}
function makeApiCall() {
        gapi.client.load('plus', 'v1', function() {
          var request = gapi.client.plus.people.get({
            'userId': 'me'
          });
          request.execute(function(response) {
           $('#login-form input[name="name"]').val(response.name.givenName);
           $('#login-form input[name="lastname"]').val(response.name.familyName);
           $('#login-form input[name="mail"]').val(response.emails[0].value);
           $('#login-form input[name="password"]').focus();
          });
        });
}
$(document).ready(function() {
  var loginFB = false;
  var fnFBAPI = function(){
    FB.api('/me', function(response) {
     $('#login-form input[name="name"]').val(response.first_name);
     $('#login-form input[name="lastname"]').val(response.last_name);
     $('#login-form input[name="mail"]').val(response.email);
     $('#login-form input[name="password"]').focus();
   });
  }
  $('#fb-login').click(function(event) {
    if(loginFB)
      return fnFBAPI();
     FB.login(function(response) {
       if (response.authResponse) {
         loginFB = true;
         fnFBAPI();
       } else {
         console.log('User cancelled login or did not fully authorize.');
       }
    });  
  });

});
</script>
<script src="//apis.google.com/js/client.js?onload=handleClientLoad"></script>

<?php $this->load->view('common/footer') ?>

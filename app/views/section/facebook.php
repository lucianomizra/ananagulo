<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-language" content="es" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <title>Ana Angulo</title>
  <link rel="icon" href="<?= layout() ?>favicon.png" type="image/x-icon" />
  <link rel="shortcut icon" href="<?= layout() ?>favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="<?= layout('fonts/font.css') ?>">
  <link rel="stylesheet" href="<?= layout('fb/main.css') ?>">
</head>
<body>
  <div id="top">
    <img src="<?= layout() ?>fb/header.png" />    
  </div>
  <div id="app">
    <? if(isset($formOk)): ?>
    <div class="form text">
      <h1>¡GRACIAS POR REGISTRARTE!</h1>
      <p>Este es el código que te permitiá aplicar el 10% de descuento en tu próxima compra.</p>
      <h2>NEWS201544</h2>
      <p><a href="https://anaangulo.com" target="_blank">Disfruta de la compra</a></p>
    </div>
    <? else: ?>
    <div class="form">      
    <form method="post">
      <label>Nombre</label>
      <input class="itt" name="name" value="" />
      <label>Apellidos</label>
      <input class="itt" name="lastname" value="" />
      <label>Correo electrónico</label>
      <input class="itt" name="mail" value="" />
      <p><input type="checkbox" name="privacy" value="1" class="privacy" /> Al registrarte, aceptas nuestros <a href="https://anaangulo.com/informacion/terminos-y-condiciones" target="_blank">Términos y condiciones</a>.</p>
      <input class="button" type="submit" value="" />
    </form>
    </div>
    <? endif ?>
  </div>
  <div id="footer">
    <img src="<?= layout() ?>fb/footer.png" />    
  </div>
  <script>
  $(document).ready(function() {
    $(window).resize(function(){
      if($(window).height()>580)
        $('#app').css('min-height', $(window).height() -  $('#footer').height() -  $('#top').height() )
      else
        $('#app').css('min-height', 0)
    }).resize()
  });
  </script>
</body>
<?
if(isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['privacy'])  && isset($_POST['mail']) && strlen($_POST['name']) > 3 && strlen($_POST['lastname']) > 3 && strlen($_POST['mail']) > 3)
{
  $baseurl = 'https://anaangulo.com/';
  $layout = 'https://anaangulo.com/fb/';
    include_once 'PHPMailer.php';
    $date = date('d-m-Y H:i:s');
    $mail = new PHPMailer();
    $mail->From = 'hola@anaangulo.com';
    $mail->FromName = 'Ana Angulo';
    $mail->AddAddress($_POST['mail']);
    $mail->AddBcc('hola@anaangulo.com');
    $mail->AddBcc('antonio@identty.com');
    $mail->AddBcc('juan@identty.com');
    $mail->IsHTML(true);
    $mail->Subject  = 'Suscripción Ana Angulo';
    $mail->Body  =  "<head></head>
<body style='padding:0;margin:0'>
  <table style='width:600px;margin:auto;border:0;border-spacing:0;border-collapse:collapse'>
  <tr>
    <td style='vertical-align:top'><a href='{$baseurl}' target='_blank'><img src='{$layout}mail/cabecera.jpg'></a></td>
  </tr>
  <tr>
    <td style='vertical-align:top'><a href='{$baseurl}' target='_blank'><img src='{$layout}mail/link.png'></a></td>
  </tr>
  <tr>
    <td style='vertical-align:top;text-align:center'><a href='{$baseurl}' target='_blank'><img alt='' src='{$layout}mail/texta.png'></a></td>
  </tr>
  <tr>
    <td style='vertical-align:top;font-family:Arial, sans-serif; padding:15px 0; text-align:center;font-size:30px'>NEWS201544</td>
  </tr>
  <tr>
    <td style='vertical-align:top;text-align:center'><a href='{$baseurl}' target='_blank'><img alt='' src='{$layout}mail/textb.png'></a></td>
  </tr>
  <tr>
    <td style='vertical-align:top;    background-color: #7D7D7D;text-align:center'>
        <br><a href='{$baseurl}' target='_blank'><img src='{$layout}mail/text2.png'></a><br>
        <a href='{$baseurl}informacion/ana-angulo' target='_blank'><img alt='No respondas a este email ya que no podremos atenderte. Si tienes alguna pregunta o duda haz clic aquí para visitar nuestra página de Ayuda. ' src='{$layout}mail/text3.png'></a><br>
        <a href='{$baseurl}' target='_blank'><img src='{$layout}mail/text4.png'></a><br><br>
        <a style='margin-right:15px' href='https://www.facebook.com/tiendasanaangulo' target='_blank'><img src='{$layout}mail/facebook.jpg'></a> <a href='https://instagram.com/anaanguloboutique' target='_blank'><img src='{$layout}mail/instagram.jpg'></a><br><br>
    </td>
  </tr>
  </table>
</body>";
    @$mail->Send(); 
  $formOk = true;
}

?>
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
  <link rel="icon" href="favicon.png" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />
<style>
@font-face {
  font-family: 'FuturaStd-Book';
  src: url('FuturaStd-Book.eot');
  src: url('FuturaStd-Book.eot?#iefix') format('embedded-opentype'),
       url('FuturaStd-Book.woff2') format('woff2'),
       url('FuturaStd-Book.woff') format('woff'),
       url('FuturaStd-Book.ttf') format('truetype'),
       url('FuturaStd-Book.svg#FuturaStd-Book') format('svg');
  font-weight: normal;
  font-style: normal;
}
@font-face {
  font-family: 'FuturaStd-Book';
  src: url('FuturaStd-Bold.eot');
  src: url('FuturaStd-Bold.eot?#iefix') format('embedded-opentype'),
       url('FuturaStd-Bold.woff') format('woff2'),
       url('FuturaStd-Bold.woff') format('woff'),
       url('FuturaStd-Bold.ttf') format('truetype'),
       url('FuturaStd-Bold.svg') format('svg');
  font-weight: 700;
  font-style: normal;
}

*{
  font-family: 'FuturaStd-Book', sans-serif;
  margin:0;
  padding:0;
}
#top img{
  display: inline-block;vertical-align: top;
  max-width: 450px;
  margin-top:40px;
  margin-bottom:40px;
  opacity:1;
  width:100%
}
#top{
  text-align: center;
  background: url(top.png) top center no-repeat;
  background-size:cover;
}
#app{
  background:#DCC67D
}
#footer img{
  max-width: 235px;
  display: inline-block;vertical-align: top;
  width:100%
}
#footer{
  text-align: center;
  background:#434142
}
.form .button:hover{
  opacity: .8
}
.form .button{
  background: url(button.png);
  width:112px;
  height: 35px;
  display:block;
  cursor: pointer;
  margin:25px auto 15px;
  border:0;
}
.form input.privacy{
  margin-right: 5px
}
.form input.itt{
display:block;
background: transparent;
border:1px solid #FFF;
padding:6px;
width:100%;
width:calc(100% - 12px);
margin-bottom: 15px;
}
.form label{
  margin-bottom: 5px;
  display:block;
  font-size:14px;
  color:#434142;
  text-transform: uppercase;
  text-align: center
}
.text h1{
  margin-bottom: 15px;
  color:#211915;
  font-size:30px
}
.text h2{
  margin-top: 35px;
  font-weight: normal;
  margin-bottom: 45px;
  color:#FFF;
  font-size:30px
}
.form.text{
max-width: 520px;
text-align: center
}
.text p a:hover{
  opacity: .8
}
.text p a{
  letter-spacing: .5px;
  font-size:16px;
  color:#FFF;
  font-weight:bold;
  text-transform: uppercase;
  text-decoration: none;
  background:#211915;
  padding: 5px 12px
}
.text p{
  color:#211915;
  font-size:14px
}
.form a{
  color:#434142;
}
.form{
  font-size:14px;
  color:#434142;
  max-width: 455px;
  margin:0 auto;
  padding: 35px 0
}
@media screen and (max-width: 570px) {
  .form{
    padding:30px 10px;
  }
}
</style>
</head>
<body>
  <div id="top">
    <img src="header.png" />    
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
    <img src="footer.png" />    
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
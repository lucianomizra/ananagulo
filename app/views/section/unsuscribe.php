<!DOCTYPE html>
<html>
<head>
    <title>Desuscripción</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <style type="text/css">
      html {
        background-color:#f5f5f7;
      }
      body {
        background-color: #f5f5f7;
        font-family: helvetica, arial, sans-serif;
      }
      #body {
        max-width: 600px;
        margin: 0 auto;
      }
      #content {
        padding: 36px;
        background-color: #fefefe;
        border: 1px solid #ccc;
        margin-top: 50px;
        color: #333;
        border-radius: 3px;
      }
      h1 {
        margin-top: 0;
        margin-bottom: 15px;
      }
      h2 {
        margin-top: 0;
        margin-bottom: 0;
      }
      p {
        line-height: 1.6em;
        margin-bottom: 0;
      }
      .item-status {
        position: relative;
        top: 6px;
        margin-right: 2px;
      }
    </style>
</head>
<body>
<div id="main">
    <div id="header"></div>
    <div id="body">
        <div id="content">
          <h1><img src="<?= layout('logo_cemaco.png') ?>"></h1>
          <h2><img src="<?= layout('icons/item-success.png') ?>" height="30px" width="30px" class="item-status"> Usted ha sido dado de baja.</h2>
          <p>Su dirección de correo electrónico, <strong><?= $md_email ?></strong>, ha sido eliminado de nuestra lista de correo. Lo sentimos verle ir, pero no vamos a enviar más correos electrónicos a su dirección.</p>
        </div>
    </div>
    <div id="footer"></div>
</div>
</body>
</html>
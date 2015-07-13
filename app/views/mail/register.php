<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registro de cuenta</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color:#FFF;">
<div style="font-family:Arial, Helvetica, sans-serif; max-width:600px;margin:auto">
<div style="margin-bottom:30px;margin-top:5px">
<img src="<?= layout("logo_cemaco.png") ?>" height="26" alt="<?= $this->config->item('client', 'app') ?>"/>
</div>
<div style="margin-bottom:30px;margin-top:5px;font-size:11px;color:#000000">
Gracias por registrarte como cliente en nuestra tienda.<br/>
Te facilitamos tus datos de acceso, no perdás este mail para futuras conexiones.
</div>
<div style="margin-bottom:30px;margin-top:5px;font-size:11px;border-top:1px solid #a3cc40;border-bottom:1px solid #a3cc40;color:#000000;padding:15px 0">
<p style="margin:2px 0"><span style="font-weight:bold">Nombre:</span> <?= $data['name'] ?></p>
<p style="margin:2px 0"><span style="font-weight:bold">Apellido:</span> <?= $data['lastname'] ?></p>
<p style="margin:2px 0"><span style="font-weight:bold">Email:</span> <?= $data['mail'] ?></p>
<p style="margin:2px 0"><span style="font-weight:bold">Password:</span> <?= $data['password'] ?></p>
</div>
<div style="margin-bottom:10px;margin-top:5px;font-size:11px;overflow:hidden">Esta dirección de correo es únicamente informativa, si tuviera cualquier duda por favor envíenos un correo a contactenos@cemaco.co.cr</div>
<div style="margin-bottom:10px;margin-top:5px;font-size:11px;overflow:hidden">
© <?= date('Y') ?> Cemaco
<a href="http://cemaco.co.cr" target="_blank" style="color:#000; float:right">cemaco.co.cr</a>
</div>
</div>
</body>
</html>
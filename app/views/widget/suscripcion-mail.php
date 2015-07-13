<head></head>
<body>
  <table style='border:0;border-spacing:0;border-collapse:collapse'>
  <tr>
    <td style='vertical-align:top'><img style='margin-bottom:5px' src='<?= layout() ?>header/logo.png'><br></td>
  </tr>
  <tr>
    <td style='vertical-align:top'>
      <h2 style='margin-top:0;margin-bottom:6px'>Suscripción realizada por web</h2>
      <div style='margin-bottom:3px'><b>Fecha</b> <?= date('d-m-Y H:i:s') ?></div>
      <div style='margin-bottom:3px'><b>Nombre</b> <?= $this->input->post('name') ?></div>
      <div style='margin-bottom:3px'><b>E-mail</b> <?= $this->input->post('mail') ?></div>
    </td>
  </tr>
  </table>
</body>
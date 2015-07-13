<table style="width:100%;border:0 solid #CCC;">
  <tbody>
    <tr>
      <td style="width:320px"><a href="<?= base_url() ?>" title="<?= $this->config->item('client','app') ?>"><img alt="<?= $this->config->item('client','app') ?>" src="<?= layout() ?>logo.png" height="50" /></td>
      <td style="text-align:right;font-size:20px">Pedido <span style="font-weight:bold"><?= str_pad($cdata->code, 6, "0", STR_PAD_LEFT) ?></span></td>
    </tr>
    <tr>
      <td style="font-size:13px; padding-top: 20px;vertical-align:top; width:320px">        
        <p style="margin:0;margin-bottom:2px"><b>Fecha:</b> <?= date('d/m/Y H:i:s', mysql_to_unix($cdata->modified)) ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Nombre:</b> <?= $fdata['name'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Apellidos:</b> <?= $fdata['lastname'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>DNI:</b>  <?= $fdata['dni'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>E-mail:</b>  <?= $fdata['mail'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Teléfono:</b>  <?= $fdata['cel'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Dirección:</b> <?= $fdata['dir1'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Población:</b> <?= $fdata['city'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Código Postal:</b> <?= $fdata['cp'] ?></p>
      </td>
      <td style="font-size:13px; padding-top: 20px;vertical-align:top;">        
        <p style="margin:0;margin-bottom:2px"><b style="text-decoration:underline">Datos de envío</b></p>
        <p style="margin:0;margin-bottom:2px"><b>Nombre:</b> <?= $fdata['name'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Apellidos:</b> <?= $fdata['lastname'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>DNI:</b>  <?= $fdata['dni'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>E-mail:</b>  <?= $fdata['mail'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Teléfono:</b>  <?= $fdata['cel'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Dirección:</b> <?= $fdata['dir1'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Población:</b> <?= $fdata['city'] ?></p>
        <p style="margin:0;margin-bottom:2px"><b>Código Postal:</b> <?= $fdata['cp'] ?></p>
      </td>
    </tr>
    <tr>
      <td style="font-size:13px; padding-top: 20px;vertical-align:top; width:320px">  
        <p style="margin:0;margin-bottom:2px"><b style="text-decoration:underline">Forma de pago</b>: <?= $cdata->payment ?></p>
      </td>
      <td style="font-size:13px; padding-top: 20px;vertical-align:top;">        
        <p style="margin:0;margin-bottom:2px"><b style="text-decoration:underline">Método de envío</b>: <?= $cdata->shipping ?></p>
      </td>
    </tr>
    <? if($cdata->comments ) :?>
    <tr>
      <td colspan="2" style="font-size:13px; padding-top: 10px;vertical-align:top;">  
        <p style="margin:0;margin-bottom:2px"><b>Comentarios</b></p>
        <p style="margin:0;margin-bottom:2px"><?= nl2br($cdata->comments) ?></p>
      </td>
    </tr>
    <? endif ?>
  </tbody>
</table> 
<table style="text-align:center;border-collapse: collapse;font-size:12px;margin-top:15px;width:100%;border:1px solid #CCC">
  <thead>
    <tr style="background:#666;font-size:13px;color:#EEE;border: 1px solid #CCC;height:25px">
      <th style="text-align:center;width:105px;">Producto</th>
      <th style="width:420px;text-align:left;">Descripción</th>
      <th style="width:80px; ">Color</th>
      <th style="width:80px; ">Talla</th>
      <th style="width:80px; ">Unidades</th>
      <th style="width:80px; ">Precio</th>
    </tr>     
  </thead>
  <tbody>
  <?
    foreach($cartItems as $item) : 
      $itemUriName = prep_word_url($item->name);
      if(!round($item->cost))
        $itemCost = '-';
      else
        $itemCost = prep_cost($item->cost, true, false) /*. '<br/>' . $ivistr*/; 
          $sizesX = explode(',', $item->sizes);
          $sizes = array();
          foreach($sizesX as $value)
          {
            $value = trim(rtrim($value));
            if($value)
              $sizes[] = $value;
          }
      ?>
    <tr style="border: 1px solid #CCC;">
      <td style="padding:5px;vertical-align:top;text-align:left"><img style="width:105px" src="<?= thumb($item->file, 205, 135) ?>" /></td>
      <td style="text-align:left">
        <h3 style="font-size:13px;margin:0;margin-bottom:1px"><?= $item->code ? "{$item->code} - " : "" ?><?= $item->name ?></h3>
        <div style="margin-bottom:2px"><?= character_limiter($item->description,150) ?></div>
      </td>
      <td><?= $item->color ? $item->color : "-"  ?></td>
      <td><?= $item->size ? $item->size : (count($sizes) ? $sizes[0] : "-") ?></td>
      <td><?= round($item->items) ?></td>
      <td><?= $itemCost ?></td>    
    </tr> 
    <? endforeach ?>        
  </tbody>
</table>         
<div style="font-size:12px;margin-bottom:20px;margin-top:20px;text-align:right">
  <div style="margin-right:10px">
    <div style="font-size:15px;margin-top:2px"><span style="font-weight:bold">Subtotal:</span> <span style="display:inline-block;width:100px"><?= prep_cost($cdata->subtotal, true, false); ?></span></div>
    <div style="font-size:15px;margin-top:2px"><span style="font-weight:bold">IVA:</span> <span style="display:inline-block;width:100px"><?= prep_cost($cdata->tax, true, false); ?></span></div>
    <div style="font-size:18px;margin-top:5px"><span style="font-weight:bold">Total:</span> <span style="display:inline-block;width:100px"><?= prep_cost($cdata->total, true, false); ?></span></div>
  </div>
</div>
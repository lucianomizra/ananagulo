<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Pedido online</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color:#FFF;">
<div style="font-family:Arial, Helvetica, sans-serif; min-width:600px; padding:10px; margin:auto">
<div style="margin-bottom:20px;margin-top:5px; overflow:hidden">
<img src="<?= layout("logo_cemaco.png") ?>" height="40" alt="<?= $this->config->item('client', 'app') ?>"/>
<span style="float:right;position:relative;top:11px;padding:3px 20px;background:#7D4199;color:#FFF;font-weight:bold;font-size:12px"><?= "LISTA DE BODAS: " . $list->code ?></span>
<span style="float:right;position:relative;top:11px;padding:3px 20px;background:#23388d;color:#FFF;font-weight:bold;font-size:12px">PEDIDO: #<?= str_pad($this->Cart->GetCart(), 6, "0", STR_PAD_LEFT) ?></span>
</div>
<div style="margin-bottom:20px;margin-top:5px;font-size:11px;border-top:1px solid #23388d;border-bottom:1px solid #a3cc40;color:#000000;padding:12px 0">
Gracias por realizar un pedido en nuestra tienda el día <span style="font-weight:bold"><?= date('d/m/Y') ?></span> a las <span style="font-weight:bold"><?= date('H:i:s') ?></span>.
</div>
<? if( $complete->payment != 'Tarjeta de crédito'): ?>
<div style="margin-top:5px;font-size:13px;font-weight:bold;color:#000000;padding:12px 0">CONDICIONES DE PAGO</div>
<div style="margin-bottom:20px;margin-top:5px;font-size:11px;color:#000000;padding:12px 0">Desde la recepción del email con su selección, dispone de 5 días para recoger en la tienda. Automáticamente, una vez efectuado el pago, se retirará de la Lista de Bodas.</div>
<? endif ?>
<div style="margin-bottom:30px;margin-top:5px;font-size:11px;overflow:hidden">
<div style="">
<span style="font-weight:bold">DATOS DE FACTURACIÓN</span><br/> 
<? if($fdata['dextra']): ?>
<span style="font-weight:bold"><?= $fdata['name'] ?> <?= $fdata['lastname'] ?></span><br/>
<?= $fdata['dir1'] ?><br/>
<?if($fdata['dir2']):?><?= $fdata['dir2'] ?><br/><? endif ?>
<?= $fdata['city'] ?>
<? else: ?>
<span style="font-weight:bold"><?= $fdata['name_2'] ?> <?= $fdata['lastname_2'] ?></span><br/>
<?= $fdata['dir1_2'] ?><br/>
<?if($fdata['dir2_2']):?><?= $fdata['dir2_2'] ?><br/><? endif ?>
<?= $fdata['city_2'] ?>
<? endif ?><br/>
<span style="font-weight:bold">Forma de pago:</span> <?= $complete->payment ?>
<? if( $fdata['payment_authcode']): ?><br/><span style="font-weight:bold">Número de autorización:</span> <?= $fdata['payment_authcode'] ?>
<? endif ?>
</div>
</div>

<table style="width: 100%;margin-bottom:30px;border-collapse: collapse;border: 1px solid #CCC;text-align:center;font-size:12px">
  <thead>
    <tr style="background:#a3cc40;">
      <th style="border: 1px solid #FFF;padding:5px;max-width:400px;color:#FFF;font-size:12px;text-align:center">Producto</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Código</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Color</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Precio unitario</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Cantidad</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Subtotal</th>
    </tr>
  </thead>
  <tbody>
<? 
  $subtotal =  0; 
  $shipping =  0; 
  foreach($cartItems as $item) : 
  $itemUriName = prep_word_url($item->name);
  $itemCost = prep_cost($item->cost, true, true);
  $itemCostST = prep_cost($item->cost * round($item->items), true, false);
  if( $item->id_state == 1 )
    $subtotal += $item->cost * round($item->items);
  $inCart = $this->Cart->ItemExists($item->id, 0, 0); 
  $inWish = $this->Wish->ItemExists($item->id); 
  $pcolors = $this->Data->ProductColors( $item->id );
  ?>
    <tr>
      <td style="text-align:left;border: 1px solid #CCC;padding:5px;width:40%">
        <div class="item-product">
          <? if($item->file):?><a class="app-loader" href="<?= base_url() ?>product/<?= $item->id ?>/<?= $itemUriName ?>"><img style="float:left;margin-left:10px;margin-right:10px;margin-bottom:10px;" src="<?= thumb($item->file, 150, 120) ?>"/></a><? endif ?>
          <p><?= $item->name ?><span><?= nl2br($item->description) ?></span><? if($item->dimensions): ?><span><?= $item->dimensions ?></span><? endif ?><? if($item->weight): ?><span><?= $item->weight ?></span><? endif ?></p>                  
        </div>
      </td>
      <td style="border: 1px solid #CCC;padding:5px;"><?= $item->code ?></td>
      <td style="border: 1px solid #CCC;padding:5px;"><? if( count($pcolors) ): ?>
          <? $first = true; foreach($pcolors as $color): if($item->id_color == $color->id):?><span style="display: block;width: 24px;height: 24px;border: 1px solid #666;padding:1px;background:#FFF; margin: auto;" class="color-item-c <?= ($item->id_color == $color->id || (!$item->id_color && $first ) ) ? "selectedxx" : "" ?>"><span style="display: block;width: 24px;height: 24px;background:<?= $color->value ?>" data-title="<?= $color->color ?>"></span><? $first = false; endif; endforeach ?> 
        <? else: ?>-<? endif ?></td>
      <td style="border: 1px solid #CCC;padding:5px;"><?= $itemCost ?></td>
      <td style="border: 1px solid #CCC;padding:5px;">
        <span class="items-num"><?= round($item->items) ?></span>
      </td>
      <td style="border: 1px solid #CCC;padding:5px;"><? if($item->id_state != 1): ?>
        <span class="price"><?= $item->state ?></span>
        <span class="obs">En cuanto esté disponible su producto nos pondremos en contacto.</span>              
        <? else: ?>
        <span class="price"><?= $itemCostST ?></span>
        <? endif ?>
      </td>
    </tr>
    <? endforeach ?>  
  </tbody>
</table>
<div style="margin-bottom: 40px;overflow:hidden">
<div style="float: right;width: 400px;">
  <? if( round($complete->desc1,2) || round($complete->desc2,2) ): ?>
  <div style="color: #23388D;overflow: hidden;text-align: center;border-top: 1px solid #23388D;">
    <div style="float: left;border-right: 1px solid #23388D;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      Subtotal
    </div>
    <div style="float: left;font-size: 16px;padding: 15px 5px;width: 185px;">         
      <?= prep_cost($complete->subtotal, true, false); ?>
    </div>
  </div>  
  <? endif ?>
  <? /* ?>
  <div style="color: #23388D;overflow: hidden;text-align: center;border-top: 1px solid #23388D;">
    <div style="float: left;border-right: 1px solid #23388D;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      Transporte
    </div>
    <div style="float: left;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      <?= prep_cost($complete->shipping, true, false); ?>              
    </div>
  </div>
  <div style="color: #23388D;overflow: hidden;text-align: center;border-top: 1px solid #23388D;">
    <div style="float: left;border-right: 1px solid #23388D;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      TAX
    </div>
    <div style="float: left;font-size: 16px;padding: 15px 5px;width: 185px;">                  
    <?= prep_cost($complete->tax, true, false); ?>
    </div>
  </div>
  <? */?>
  <? if( round($complete->desc1,2) ): ?>
  <div style="color: #23388D;overflow: hidden;text-align: center;border-top: 1px solid #23388D;">
    <div style="float: left;border-right: 1px solid #23388D;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      Cupon
    </div>
    <div style="color:#1AA8C4" style="float: left;font-size: 16px;padding: 15px 5px;width: 185px;">                  
     - <?= prep_cost($complete->desc1, true, false); ?>
    </div>
  </div>
  <? endif ?>
  <? if(round($complete->desc2,2)): ?>
  <div style="color: #23388D;overflow: hidden;text-align: center;border-top: 1px solid #23388D;">
    <div style="float: left;border-right: 1px solid #23388D;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      Vale de regalo
    </div>
    <div style="color:#1AA8C4" style="float: left;font-size: 16px;padding: 15px 5px;width: 185px;">                  
     - <?= prep_cost($complete->desc2, true, false); ?>
    </div>
  </div>
  <? endif ?>
  <div style="color: #23388D;overflow: hidden;text-align: center;border-top: 1px solid #23388D;background: #23388D;font-weight: bold;color: #FFF;">
    <div style="float: left;border-right: 1px solid #23388D;font-size: 16px;padding: 15px 5px;width: 185px;">                  
      Total:
    </div>
    <div style="float: left;font-size: 16px;padding: 15px 5px;width: 185px;">
      <?= prep_cost($complete->total, true, false); ?>              
    </div>
  </div>
</div>
</div>
<div style="margin-bottom:10px;margin-top:5px;font-size:11px;overflow:hidden">Esta dirección de correo es únicamente informativa, si tuviera cualquier duda por favor envíenos un correo a contactenos@cemaco.co.cr</div>
<div style="margin-bottom:10px;margin-top:5px;font-size:11px;overflow:hidden">
© <?= date('Y') ?> Cemaco
<a href="http://cemaco.co.cr" target="_blank" style="color:#000; float:right">cemaco.co.cr</a>
</div>
</div>
</body>
</html>

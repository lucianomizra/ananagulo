<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Lista de bodas</title>
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
<?= $fdata['name'] ?> <?= $fdata['lastname'] ?> ha realizado un pedido de tu lista de bodas el día <span style="font-weight:bold"><?= date('d/m/Y') ?></span> a las <span style="font-weight:bold"><?= date('H:i:s') ?></span>.
</div>
<table style="width: 100%;margin-bottom:30px;border-collapse: collapse;border: 1px solid #CCC;text-align:center;font-size:12px">
  <thead>
    <tr style="background:#a3cc40;">
      <th style="border: 1px solid #FFF;padding:5px;max-width:400px;color:#FFF;font-size:12px;text-align:center">Producto</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Código</th>
      <?/*
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Color</th>
      */?>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Cantidad</th>
      <th style="border: 1px solid #FFF;padding:5px;color:#FFF;font-size:12px;text-align:center">Precio</th>
    </tr>
  </thead>
  <tbody>
<? 
  $subtotal =  0; 
  $shipping =  0; 
  foreach($cartItems as $item) : 
  if($item->id_category != 9 || $item->id_state != 1) continue;
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
      <?/*
      <td style="border: 1px solid #CCC;padding:5px;"><? if( count($pcolors) ): ?>
          <? $first = true; foreach($pcolors as $color): if($item->id_color == $color->id):?><span style="display: block;width: 24px;height: 24px;border: 1px solid #666;padding:1px;background:#FFF; margin: auto;" class="color-item-c <?= ($item->id_color == $color->id || (!$item->id_color && $first ) ) ? "selectedxx" : "" ?>"><span style="display: block;width: 24px;height: 24px;background:<?= $color->value ?>" data-title="<?= $color->color ?>"></span><? $first = false; endif; endforeach ?> 
        <? else: ?>-<? endif ?></td>
      */?>
      <td style="border: 1px solid #CCC;padding:5px;">
        <span class="items-num"><?= round($item->items) ?></span>
      </td>
      <td style="border: 1px solid #CCC;padding:5px;"><?= $itemCost ?></td>
    </tr>
    <? endforeach ?>  
  </tbody>
</table>
<div style="margin-bottom:10px;margin-top:5px;font-size:11px;overflow:hidden">Esta dirección de correo es únicamente informativa, si tuviera cualquier duda por favor envíenos un correo a contactenos@cemaco.co.cr</div>
<div style="margin-bottom:10px;margin-top:5px;font-size:11px;overflow:hidden">
© <?= date('Y') ?> Cemaco
<a href="http://cemaco.co.cr" target="_blank" style="color:#000; float:right">cemaco.co.cr</a>
</div>
</div>
</body>
</html>

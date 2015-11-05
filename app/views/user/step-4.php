<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="login"></div>
<div class="container">
	<div class="page-login row-products-filter">
		<div class="page-header">
			<ol class="breadcrumb pull-left">
        <li><a href="<?= base_url () ?>">Ana Angulo</a></li>
        <li><a href="<?= base_url () ?>cart">Cesta</a></li>
        <li><a href="<?= base_url () ?>mi-cuenta">Identificación</a></li>
			  <li class="active">Envío</li>
			</ol>
		</div>
    <div class="clearfix"></div>
      <div class="info-menu info-menu-mobile">
        <h3><a class="arr-left" href="javascript:window.history.back()"><span class="glyphicon glyphicon-triangle-left"></span></a>Identificación > Envío > <span class="app-bold">Pago</span></h3>
       </div>


		<ul class="checkout-steps">
      <li class="ok"><a href="<?= base_url()?>mi-cuenta">Identificación</a></li>
      <li class="ok"><a href="<?= base_url()?>mi-cuenta/step-3">Envío</a></li>
      <li class="ok fok"><a href="<?= base_url()?>mi-cuenta/step-4">Pago</a></li>			
		</ul>

		<? $this->load->view('user/data') ?>	

		<div class="page-cart-body">
			<? $this->load->view('cart/table', array('cartDisabled' => true)) ?>
		</div>

		<div class="page-footer text-center page-footer-nm">			
			<a href="<?= base_url() ?>mi-cuenta/step-3" class="btn btn-default btn-lg">Modificar mis datos</a>
			<a href="<?= base_url() ?>cart" class="btn btn-default btn-lg">Modificar cesta</a>
			<button id="submit-button" class="btn btn-primary btn-lg">Confirmar pedido</button>
		</div>
<? 
$amount = $cdata->total;
$amount = round($amount,2) * 100;
if($cdata->id_payment == 1 || $cdata->id_payment ==3): 
$code = '333647345';
$order = str_pad($this->Cart->id, 4, "0", STR_PAD_LEFT) . date('his');
$currency = '978';
$transactionType = 0;
$urlTpv = 'https://sis.redsys.es/sis/realizarPago';
$urlMerchant = base_url() . 'cart/tpv';
$urlMerchantOK = base_url() . 'cart/tpv-ok';
$urlMerchantKO = base_url() . 'cart/tpv-ko';
$terminal = '001';
$clave = '4Q86OG5PN99QS567';
$message = $amount.$order.$code.$currency.$transactionType.$urlMerchant.$clave;
$signature = strtoupper(sha1($message));

        ?>
<form style="display:none" id='form-tpv' action='<?= $urlTpv ?>' method='post'>
<input type='hidden' name='Ds_Merchant_ProductDescription' value='<?= str_pad($this->Cart->id, 4, "0", STR_PAD_LEFT) ?>' />
<input type='hidden' name='Ds_Merchant_MerchantName' value='CARLANA ECOMERCE' />
<input type='hidden' name='Ds_Merchant_Amount' value='<?= $amount ?>' />
<input type='hidden' name='Ds_Merchant_Currency' value='<?= $currency ?>' />
<input type='hidden' name='Ds_Merchant_Order ' value='<?= $order ?>' />
<input type='hidden' name='Ds_Merchant_MerchantCode' value='<?= $code ?>' />
<input type='hidden' name='Ds_Merchant_Terminal' value='<?= $terminal ?>' />
<input type='hidden' name='Ds_Merchant_TransactionType' value='<?= $transactionType ?>' />
<input type='hidden' name='Ds_Merchant_MerchantURL' value='<?= $urlMerchant ?>' />
<input type='hidden' name='Ds_Merchant_UrlOK' value='<?= $urlMerchantOK ?>' />
<input type='hidden' name='Ds_Merchant_UrlKO' value='<?= $urlMerchantKO ?>' />
<input type='hidden' name='Ds_Merchant_MerchantSignature' value='<?= $signature ?>' />
</form>
        <? endif ?>
	</div>
</div>
<script>
$(document).ready(function() {
  $('#submit-button').click(function(){
  <? if( (!$this->session->userdata('cart-ok-amout') || $this->session->userdata('cart-ok-amout') != $amount) && 
  	($cdata->id_payment == 1 || $cdata->id_payment == 3)): ?>
  	$('#form-tpv').submit();
 	 return false;
  <? elseif($cdata->id_payment == 2): ?>
    window.location.href = '<?= base_url () ?>cart/paypal';
  <? elseif($cdata->id_payment == 5): ?>
  	window.location.href = '<?= base_url () ?>cart/contrareembolso';
  <? endif ?>
  });
});
</script>
<?php $this->load->view('common/footer') ?>
<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="login"></div>
<div class="container">
	<div class="page-login row-products-filter page-cc">
		<div class="page-header">
			<ol class="breadcrumb pull-left">
        <li><a href="<?= base_url () ?>">Ana Angulo</a></li>
        <li><a href="<?= base_url () ?>cart">Cesta</a></li>
        <li><a href="<?= base_url () ?>mi-cuenta">Identificación</a></li>
			  <li class="active">Envío</li>
			</ol>
		</div>

		<ul class="checkout-steps">
      <li class="ok"><a href="<?= base_url()?>mi-cuenta">Identificación</a></li>
      <li class="ok"><a href="<?= base_url()?>mi-cuenta/step-3">Envío</a></li>
      <li><a class="disabled">Pago</a></li>
			
		</ul>

		<? $this->load->view('user/data') ?>	

    <form action="<?= base_url() ?>mi-cuenta/step-3" method="post">
    <input type="hidden" name="level" value="3"/>

		<? $payment = isset($cdata->id_payment) ? $cdata->id_payment : 1; ?>	

<div class="row checkout-center">
			<div class="col-sm-5">

				<div class="form-title">Formas de pago</div>
				<div class="payment-methods">
					<div class="pull-right absolute">
						<div class="method-pay">
							<img src="<?= layout().'imgs/visamaster.png'; ?>" />
						</div>
						<?/*
						<div class="method-pay">
							<img src="<?= layout().'imgs/paypal.png'; ?>" />
						</div>
						*/?>
					</div>
					<div class="form-group row text-left">
						<div class="col-xs-1 col-xs-offset-1">
							<input id="credit"<?= ($payment == 1) ? " checked='checked'" : "" ?> type="radio" name="payment" value="1">
						</div>
						<div class="col-xs-10">
							<label for="credit">Tarjeta de crédito</label>
						</div>
					</div>
					<?/*
					<div class="form-group row text-left">
						<div class="col-xs-1 col-xs-offset-1">
							<input id="paypal"<?= ($payment == 2) ? " checked='checked'" : "" ?> type="radio" name="payment" value="2">
						</div>
						<div class="col-xs-10">
							<label for="paypal">Paypal</label>
						</div>
					</div>
					*/?>
					<div class="form-group row text-left">
						<div class="col-xs-1 col-xs-offset-1">
							<input id="cod"<?= ($payment == 5) ? " checked='checked'" : "" ?> type="radio" name="payment" value="5">
						</div>
						<div class="col-xs-10">
							<label for="cod">Contra reembolso</label>
						</div>
					</div>


				</div>
			</div>
			<? $shipping = isset($cdata->id_shipping) ? $cdata->id_shipping : 2; ?>
			<? $comments = isset($cdata->comments) ? $cdata->comments : ''; ?>
			<div class="col-sm-5 col-sm-offset-2">

				<div class="form-title">Metodos de envío</div>
				


					<div class="methods-ship">
						<div class="form-group">
							 <select class="selectpicker" data-style="select-default" data-width="100%" name="shipping">
							      <option value="1" selected="selected">Entrega exppress</option>
							 </select>
		 				</div>
		 				
						<div class="form-group">
							<textarea name="comments" placeholder="Observaciones de entrega"><?=  $comments ?></textarea>
		 				</div>
	 				</div>

			</div>
		</div>	
		
    <?php if(isset($error)):
        $errorArr['fields'] = 'Debes seleccionar una forma de pago y un método de envío';
	    ?>
		<div class="row">
	    <div class="col-sm-12 text-center">
		    <div class="margin-bottomx30">
		      <p class="info-box-error"><?php echo $errorArr[$error] ?></p>
		    </div>
	    </div>
	  </div>
    <? endif ?>

		<div class="page-footer text-center">			
			<a href="<?= base_url() ?>cart" class="btn btn-default btn-lg">Modificar cesta</a>
			<button class="btn btn-primary btn-lg">Confirmar pedido</button>
			<?/*
			<a href="<?= base_url() ?>mi-cuenta/step-4" class="btn btn-primary btn-lg">Confirmar pedido</a>
			*/?>
		</div>

				</form>

	</div>
</div>
<?php $this->load->view('common/footer') ?>
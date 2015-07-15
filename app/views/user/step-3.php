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

<div class="row checkout-center row-hhh">
			<div class="col-sm-5 offxdty">
				<div class="clearfix"></div>
   			 <div class="form-title">Datos de facturación</div>

								<form action="<?= base_url() ?>mi-cuenta" method="post" class="text-right">
									<input type="hidden" name="action" value="dataxy" />
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="email">Email:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['mail'] ?>" name="mail" id="email" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="name">Nombre:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['name'] ?>" name="name" id="name" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="lastname">Apellidos:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['lastname'] ?>" name="lastname" id="lastname" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="dni">CIF/NIF:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['dni'] ?>" name="dni" id="dni" tabindex="1" class="form-control">
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-sm-12 text-center">
										<?php if(isset($errorY)):
			                $errorArr['fields'] = 'Debes completar todos los campos';
			                $errorArr['mail'] = 'El correo electrónico ingresado es inválido';
			                $errorArr['mail2'] = 'El correo electrónico ingresado ya ha sido registrado';
			              ?>
			              <div class="margin-bottomx30">
			                <p class="info-box-error"><?php echo $errorArr[$errorY] ?></p>
			              </div>
			              <? endif ?>
											<input type="submit" class="btn btn-primary" value="Modificar" />
										</div>
									</div>

								</form>
			</div>
			<div class="col-sm-5 col-sm-offset-2 offxdt">
  			<div class="clearfix"></div>
   				 <div class="form-title">Datos de envío</div>

								<form action="<?= base_url() ?>mi-cuenta" method="post" class="text-right">
									<input type="hidden" name="action" value="dataxx" />
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="dir1">Dirección de envío:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['dir1'] ?>" name="dir1" id="dir1" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="cp">Código Postal:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['cp'] ?>" name="cp" id="cp" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="city">Localidad</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['city'] ?>" name="city" id="city" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="cel">Telf. de contacto:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['cel'] ?>" name="cel" id="cel" tabindex="1" class="form-control">
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-sm-12 text-center">
										<?php if(isset($error)):
			                $errorArr['fields'] = 'Debes completar todos los campos';
			                $errorArr['privacy'] = 'Debes aceptar las políticas de privacidad';
			                $errorArr['mail'] = 'El correo electrónico ingresado es inválido';
			                $errorArr['mail2'] = 'El correo electrónico ingresado ya ha sido registrado';
			              ?>
			              <div class="margin-bottomx30">
			                <p class="info-box-error"><?php echo $errorArr[$error] ?></p>
			              </div>
			              <? endif ?>
											<input type="submit" class="btn btn-primary" value="Modificar" />
										</div>
									</div>

								</form>
			</div>
</div>
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
							      <option value="1" selected="selected">Entrega Exppress</option>
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
<script>
	$(document).ready(function() {
		<? if(isset($openFormY)): ?>
		$('.rowoffxdt .offxdty').replaceWith($('.row-hhh .offxdty'));
		$("html, body").animate({ scrollTop: $('.rowoffxdt .offxdty').offset().top - 100 }, 200);
		<? endif ?>
		<? if(isset($openForm)): ?>
		$('.rowoffxdt .offxdt').replaceWith($('.row-hhh .offxdt'));
		$("html, body").animate({ scrollTop: $('.rowoffxdt .offxdt').offset().top - 100 }, 200);
		<? endif ?>
		$('.data-addressy .lnk').click(function(e){
			e.preventDefault();
			$('.rowoffxdt .offxdty').replaceWith($('.row-hhh .offxdty'));
  		$("html, body").animate({ scrollTop: $('.rowoffxdt .offxdty').offset().top - 100 }, 200);
		});
		$('.data-addressx .lnk').click(function(e){
			e.preventDefault();
			$('.rowoffxdt .offxdt').replaceWith($('.row-hhh .offxdt'));
  		$("html, body").animate({ scrollTop: $('.rowoffxdt .offxdt').offset().top - 100 }, 200);
		});
	});

</script>
<?php $this->load->view('common/footer') ?>
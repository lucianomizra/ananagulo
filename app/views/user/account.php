<?php if(!AJAX) $this->load->view('common/header') ?>
<div id="page-info" data-section="info"></div>
<div class="container" style="padding-bottom:60px;">
	<div class="page-myaccount row-products-filter">
		<div class="page-header">
			<ol class="breadcrumb pull-left">
			  <li><a href="#">Ana Angulo</a></li>
			  <li class="active">Mi cuenta</li>
			</ol>
		</div>
		<div class="clearfix"></div>

		<div class="page-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="info-menu text-left">
						<h3>Mi cuenta</h3>
						<p>Desde la sección "Mi cuenta" puedes gestionar de forma sencilla tus datos, tus pedidos, tu cotnraseña, etc. Selecciona la opción que desees:</p>
						<?/*
						<p><strong>Ativar una cuenta distinta a <a href="">Antonio Horcojo Nicolau</a></strong></p>
						*/?>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-6 col-sm-offset-1">
					<div class="info">

						<h2>Gestionar mis pedidos</h2>
						<p>Desde aquí puedes consultar tus pedidos, así como su estado y situación de envío de manera instantánea</p>
					</div>
				</div>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="info">
						
						<table class="table hidden-xs table-carts">
					      <thead>
					        <tr>
					          <th>Fecha</th>
					          <th>Nº pedido</th>
					          <th>Tracking</th>
					          <th>Estado</th>
					          <th>Total</th>
					        </tr>
					      </thead>
					      <tbody>
					      	<? foreach($carts as $cart): $shipping = json_decode($cart->shipping_data); ?>
					        <tr>
					          <td><?= date('d/m/Y H:i:s', mysql_to_unix($cart->modified)) ?></td>
					          <td><a href="<?= base_url() ?>mi-cuenta/pedido/<?= $cart->id_cart ?>" target="_blank"><?= str_pad($cart->id_cart, 6, "0", STR_PAD_LEFT) ?></a></td>
					          <td><?= isset($shipping->expedicion) ? $shipping->expedicion : "-"  ?></td>
					          <td><?= $cart->state ?></td>
					          <td><?= prep_cost($cart->total, true, false) ?></td>
					        </tr>
					      	<? endforeach ?>
					      </tbody>
					    </table>
					    <? if(!count($carts)) :?>
					    <div class="no-history">NO HAY PEDIDOS EN EL HISTORIAL</div>
					  	<? endif ?>
						
						<div class="visible-sm orders-mini">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
							    <div class="panel-heading" role="tab" id="heading-1">
							      <h4 class="panel-title">
							        <a data-toggle="collapse" data-parent="#accordion" href="#order-1" aria-expanded="false" aria-controls="order-1">
							          05/03/2015 18:54:05
							        </a>
							      </h4>
							    </div>
							    <div id="order-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-1">
							      <div class="panel-body">
									<p>
									 	<a href="">150305-131440</a> <br>
							         	Pedido enviado <br>
							         	60€ <br>

							         	<div class="text-center">
							         		<a href="" class="show-order">Ver pedido</a>
							         	</div>
									</p>
							      </div>
							    </div>
							  </div>
							  <div class="panel panel-default">
							    <div class="panel-heading" role="tab" id="heading-2">
							      <h4 class="panel-title">
							        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#order-2" aria-expanded="false" aria-controls="order-2">
							          05/03/2015 18:54:05
							        </a>
							      </h4>
							    </div>
							    <div id="order-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-2">
							      <div class="panel-body">
									<p>
									 	<a href="">150305-131440</a> <br>
							         	Pedido enviado <br>
							         	60€ <br>

							         	<div class="text-center">
							         		<a href="" class="show-order">Ver pedido</a>
							         	</div>
									</p>
									</div>
							    </div>
							  </div>
							</div>
						</div>

						<div class="row row-forms-user">
							<div class="col-sm-6">
								<h2>Cambiar mi contraseña actual</h2>
								<p class="h60">Si deseas cambiar tu contraseña actual, puedes hacerlo desde aquí en un instante</p>
							
								<form action="<?= base_url() ?>mi-cuenta" method="post" class="text-right">
									<input type="hidden" name="action" value="password" />
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="actual">Contraseña actual:</label>
										</div>
										<div class="col-sm-7">
											<input type="password" name="old_password" value="<?= $this->input->post('old_password') ?>" id="actual" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="newpasswd">Nueva contraseña:</label>
										</div>
										<div class="col-sm-7">
											<input type="password" name="password" value="<?= $this->input->post('password') ?>" id="newpasswd" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4">
											<label for="repeatpasswd">Repita la contraseña:</label>
										</div>
										<div class="col-sm-7">
											<input type="password" name="password2" value="<?= $this->input->post('password2') ?>" id="repeatpasswd" tabindex="1" class="form-control">
										</div>
									</div>
		              <?php if(isset($errorP)):
		                $errorArr['fields'] = 'Debes completar todos los campos';
		                $errorArr['password'] = 'La confirmación de la contraseña es incorrecta';
		                $errorArr['password_old'] = 'La contraseña actual es incorrecta';
		                $errorArr['password_ok'] = 'La contraseña fue cambiada correctamente';
		              ?>
									<div class="col-sm-12 text-center">
		              <div class="margin-bottomx30">
		                <p class="info-box-error"><?php echo $errorArr[$errorP] ?></p>
		              </div>
		              </div>
            		  <? endif ?>
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<input type="submit" class="btn btn-primary" value="Cambiar" />
										</div>
									</div>
								</form>
							</div>
							<div class="col-sm-5 pull-right">
								<h2>Modificar mis datos personales</h2>
								
								<p class="h60">Puedes cambiar cualquiera de tus datos personales(nombre, email, etc)</p>
							
								<form action="<?= base_url() ?>mi-cuenta" method="post" class="text-right">
									<input type="hidden" name="action" value="data" />
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="email">Email:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['mail'] ?>" name="mail" id="email" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="name">Nombre:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['name'] ?>" name="name" id="name" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="lastname">Apellidos:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['lastname'] ?>" name="lastname" id="lastname" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="dni">CIF/NIF:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['dni'] ?>" name="dni" id="dni" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="dir1">Dirección de envío:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['dir1'] ?>" name="dir1" id="dir1" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="cp">Código Postal:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['cp'] ?>" name="cp" id="cp" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="city">Localidad</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['city'] ?>" name="city" id="city" tabindex="1" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-5">
											<label for="cel">Telf. de contacto:</label>
										</div>
										<div class="col-sm-7">
											<input type="text" value="<?= $fdata['cel'] ?>" name="cel" id="cel" tabindex="1" class="form-control">
										</div>
									</div>
									
									<div class="form-group row text-left">
										<div class="col-sm-1 col-sm-offset-1">
											<input id="newsletter"<? if($fdata['newsletter']): ?> checked="checked"<? endif ?> type="checkbox" name="newsletter" value="1">
										</div>
										<div class="col-sm-10">
											<label class="dd" for="newsletter">Quiero recibir el boletin semanal de ofertas y descuentos exclusivos</label>
										</div>
									</div>

									<div class="form-group row text-left">
										<div class="col-sm-1 col-sm-offset-1">
											<input id="privacy" <? if($fdata['privacy']): ?> checked="privacy"<? endif ?> type="checkbox" name="privacy" value="1">
										</div>
										<div class="col-sm-10">
											<label class="dd" for="privacy">He leído y acepto la <a href="<?= base_url() ?>informacion/terminos-y-condiciones"><strong>Política de Privacidad</strong></a> y <a href="<?= base_url() ?>informacion/politica-de-datos"><strong>Términos y Condiciones</strong></a>.</label>
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
						<div class="text-center">
							<a href="<?= base_url() ?>mi-cuenta/logout" class="btn btn-primary btn-lg">Cerrar la sesión actual</a>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
  <? if(isset($errorP) || isset($error)): ?>
  setTimeout(function(){
    $("html, body").animate({ scrollTop: $('.row-forms-user').offset().top - 100 }, 0);
  },1000);    
  <? endif ?>
});
</script>
<?php $this->load->view('common/footer') ?>
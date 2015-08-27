<div class="widget-newsletter">
  <div class="box">
	  <div class="box-inside">
			<div class="cls clscls"><span aria-hidden="true">×</span></div>
			<div class="form-join-cc-alt">
				<div class="rowx">         			
					<? if( isset($formSOK)):?>
					<div style="text-align:center">
		      	<h1 style="max-width:none">¡GRACIAS POR REGISTRARTE!</h1>
						<p>Este es el código que te permitiá aplicar el 10% de descuento en tu próxima compra.</p>
						<p style="font-size:30px;margin-top:30px;color:#FFF">NEWS201544</p>
						<p style="margin-top:30px"><a style="background:#FFF;font-weight:bold;cursor:pointer;padding:10px 20px;color:#000;font-size:14px"class="clscls">A COMPRAR! ></a></p>
					</div>
						
					<? else: ?>		
		      <h1>REGÍSTRATE EN NUESTRA NEWSLETTER Y RECIBE UN 10% DE DESCUENTO.</h1>
		      <p>Introduce tu nombre y correo electrónico y recibirás un código de descuento directo además de estar a la última en todas las novedades que tenemos preparadas este año.</p> 
					<form action="<?= base_url() ?>suscripcion/cc" method="post" class="join form-join-alt">
						<input id="level-input" type="hidden" name="level" />
				    <div class="col-sm-5 col-sm-left">             
				      <input type="text" class="form-control form-newslatter" name="name" value="<?= $this->input->post('name') ?>" placeholder="Tu nombre">
				    </div>
				    <div class="col-sm-5">              
				      <input type="text" class="form-control form-newslatter" name="mail" value="<?= $this->input->post('mail') ?>" placeholder="Tu correo">
				    </div>
				    <div class="col-sm-2">              
				      <input type="submit" class="btn btn-invese btn-block form-newslatter" id="submit_newslatter" value="Enviar">            
				    </div>
			      <p class="pxx"><input type="checkbox" name="privacy" value="1" class="chckbox"> Confirmo que haber leído y estar conforme con los términos y condiciones generales y la política de privacidad de Ana Angulo.</p>
					</form>
					<script>
					$('#level-input').val('2');
					$('form.form-join-alt').submit(function(e){
						e.preventDefault();
				    $.ajax({
				      type: "POST",
				      cache: true,
				      url: $(this).attr('action'),
				      data: $(this).serialize(),
				      dataType: "html",
				      processData: false
				    }).done(function(html) {
				      $('.widget-newsletter').replaceWith(html);
				    });
					});
					</script>
					<? endif ?>
					<script>					
					$('.widget-newsletter .clscls').click(function(e){
						$('.widget-newsletter').remove();
						$.ajax({
				      type: "POST",
				      cache: true,
				      url: '<?= base_url() ?>suscripcion',
				      data: {level:2, quit:true},
				      dataType: "html",
				      processData: true
				    });
					});
					</script>
				</div>
			</div>
 		</div>
	</div>
</div>
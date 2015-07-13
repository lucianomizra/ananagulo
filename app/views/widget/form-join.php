<div class="form-join-cc">
	<div class="row">          
	  <div id="collapseFooterAlt" class="">
		<? if( isset($formSOK)):?>
		<div class="join-ok">Muchas gracias por unirte!</div>
		<? else: ?>
		<form action="<?= base_url() ?>suscripcion" method="post" class="join form-join">
			<input id="level-input" type="hidden" name="level" />
	    <div class="col-sm-4">             
	      <input type="text" class="form-control form-newslatter" name="name" placeholder="Tu nombre">
	    </div>
	    <div class="col-sm-4">              
	      <input type="text" class="form-control form-newslatter" name="mail" placeholder="Tu correo">
	    </div>
	    <div class="col-sm-4">              
	      <input type="submit" class="btn btn-invese btn-block form-newslatter" id="submit_newslatter" value="Estate a la última">            
	    </div>
		</form>
		<script>
		$('#level-input').val('2');
		$('form.form-join').submit(function(e){
			e.preventDefault();
	    $.ajax({
	      type: "POST",
	      cache: true,
	      url: $(this).attr('action'),
	      data: $(this).serialize(),
	      dataType: "html",
	      processData: false
	    }).done(function(html) {
	      $('.form-join-cc').replaceWith(html);
	    });
		});
		</script>
		<? endif ?>
	  </div>
	</div>
</div>

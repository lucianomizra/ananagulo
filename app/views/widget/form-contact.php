<div class="form-join-cc form-contact">
	<div class="row">          
	  <div id="collapseFooterAlt" class="">
		<? if( isset($formSOK)):?>
		<div class="join-ok">
			<div class="col-md-12 text-center">Muchas gracias por tu mensaje.</div>
		</div>
		<? else: ?>
		<form action="<?= base_url() ?>contacto" method="post" class="join form-join form-group">
			<input id="level-input" type="hidden" name="level" />
			<div class="row">
				<div class="col-md-6">
				  <div class="form-group">
				  	<div class="col-sm-3 text-right lbl-box">
				    	<label for="inputname">Nombre</label>
				  	</div>
				  	<div class="col-sm-9">
				    	<input type="text" placeholder="Nombre" name="name" value="<?= $this->input->post('name') ?>" class="form-control" id="inputname">
					</div>
				  </div>							
				  <div class="form-group">
				  	<div class="col-sm-3 text-right lbl-box">
				    	<label for="inputsubject">Asunto</label>
				    </div>
				    <div class="col-sm-9">
				    	<input type="text" placeholder="Asunto" name="subject" value="<?= $this->input->post('subject') ?>" class="form-control" id="inputsubject">
					</div>
				  </div>
				  <div class="form-group">
				  	<div class="col-sm-3 text-right lbl-box">
				    	<label for="inputemail">E-mail</label>
				    </div>
				    <div class="col-sm-9">
				    	<input type="email" placeholder="E-mail" name="mail" value="<?= $this->input->post('mail') ?>" class="form-control" id="inputemail">
					</div>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="form-group">
				  	<div class="col-sm-3 text-right lbl-box">
				    	<label for="textareamessage">Mensaje</label>
				    </div>
				  	<div class="col-sm-9">
				    	<textarea  placeholder="Mensaje" name="message" id="textareamessage" style="height: 140px;" class="form-control"><?= $this->input->post('message') ?></textarea>
				    </div>
				  </div>
				</div>
				<? if(isset($formError)): ?>
				<div class="col-md-12 text-center">Debes completar todos los campos.</div>
			<? endif ?>
				<div class="col-md-12 text-center">
			  		<button type="submit" class="btn btn-primary btn-xl">Enviar</button>
				</div>
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

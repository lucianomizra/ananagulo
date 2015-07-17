<? 
$types = $this->Data->GetSizeTypes();
?><div class="widget-sizes">
	<div class="close"><span aria-hidden="true">×</span></div>
	<div class="widget-sizes-inside">
		<div class="guide">
			<div class="guide-b">
				<h2><span>Guía de tallas mujer</span></h2>
			</div>
			<? foreach($types as $key => $type): 
			$dd = $this->Data->GetSizeDD($type->id_type);
			$cols = explode(',', $type->sizes);
			?>
			<div class="guide-<?= ($type->num > 4) ? "extra" : "b" ?>">
				<? if($type->show_name): ?>
				<h3><?= $type->type ?></h3>
				<? endif ?>
				<table>
					<thead>
						<tr>
							<th class="cpl">TALLA</th>
							<? foreach($cols as $col): ?>
							<th><?= $col ?></th>
							<? endforeach ?>
						</tr>
					</thead>
					<tbody>
						<? foreach($dd as $d): $cols = explode(',', $d->sizes); ?>
						<tr>
							<td class="cpl"><?= $d->size ?></td>
							<? foreach($cols as $col): ?>
							<td><?= $col ?></td>
							<? endforeach ?>
						</tr>
						<? endforeach ?>
					</tbody>
				</table>
			</div>
			<? endforeach ?>
		</div>
		<div class="guide-image">
			<h2><span>Cómo medir</span></h2>
			<img src="<?= layout('imgs/sizes.png') ?>" >
		</div>
	</div>
</div>
<script>
$('.widget-sizes .close').click(function(event) {
	$('.widget-sizes').css('display', 'none');
  $("html, body").animate({ scrollTop: $('.open-guide').offset().top - 400 }, 300);
});
</script>
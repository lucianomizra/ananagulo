<? 
$instagram = $this->Data->Instagram();
foreach( $instagram as $i): ?>
<li><a target="_blank" href="<?= $i->link ?>"><img src="<?= upload($i->file) ?>" alt=""></a></li>
<? endforeach ?>
<form style="display:none" id="credomatic-form" method="post" action="https://credomatic.compassmerchantsolutions.com/api/transact.php">
<? foreach($fieldsCF as $key => $value): ?>
<input name="<?= $key ?>" value="<?= $value ?>" />
<? endforeach ?>
</form>
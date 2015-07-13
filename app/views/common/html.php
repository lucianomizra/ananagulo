<?php
$lang = $this->config->item('lang', 'app');
$layoutversion = $this->config->item('layout-version', 'app');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-language" content="<?php echo $lang ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="initial-scale=1.0" />
<?php $this->load->view('common/metatags') ?>
<link rel="icon" href="<?= layout('favicon.png' . $layoutversion) ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo layout('favicon.png' . $layoutversion) ?>" type="image/x-icon" />
<?php $this->load->view('common/css', array('layoutversion' => $layoutversion) ) ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body id="app-body" class="app-body lang-<?php echo $lang ?>">
<?php $this->load->view('common/app-fb') ?>
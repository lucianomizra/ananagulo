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
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '876976675690933']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=876976675690933&amp;ev=PixelInitialized" /></noscript>
</head>
<body id="app-body" class="app-body lang-<?php echo $lang ?>">
<?php $this->load->view('common/app-fb') ?>
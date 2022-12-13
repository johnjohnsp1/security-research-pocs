<?php 
	if (!empty($_GET['xssfilter'])) {
		header('X-XSS-Protection: 1'); 
	} else {
		header('X-XSS-Protection: 0');
	}?>
<!doctype html>
<html lang="en">
  <head>
  	
<meta http-equiv=Content-Security-Policy content="
<?php
	if (!isset($_GET['csp'])) {
		$_GET['csp'] = 'sd';
	}
	$csp = "";
	switch ($_GET['csp']) {
		case 'sd':
			$csp = "object-src 'none'; script-src 'nonce-random' 'strict-dynamic' https: http:;";
			break;
		case 'ue':
			$csp = "object-src 'none'; script-src 'nonce-random' 'unsafe-eval' 'self'";
			break;
                case 'nonces':
                        $csp = "object-src 'none'; script-src 'nonce-random' 'self'";
                        break;
		case 'wh':
			$csp = "object-src 'none'; script-src 'self' http://cdn.ractivejs.org";
			break;	
	}
	echo $csp;
?>
">
<script nonce="random" src='http://cdn.ractivejs.org/latest/ractive.js'></script>
</head>

<body>
  <h1>Ractive test</h1>

  <div id='container'></div>

 <?php echo $_GET['inj'] ?>
  <script id="template" type="foo">Hi</script>

  <script nonce="random">
    var ractive = new Ractive({
      el: '#container',

      template: '#template',

      data: { name: 'world' }
    });
  </script>
</body>
</html>


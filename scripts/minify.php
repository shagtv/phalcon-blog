<body style="font-family: monospace;">
<?php
	include_once("minifier.php");
	
	$js = array(
		__DIR__."/../www/js/script.js" 	=> __DIR__."/../www/js/script.min.js",
	);
	
	$css = array(
		__DIR__."/../www/css/style.css"	=> __DIR__."/../www/css/style.min.css",
	);
	
	minifyJS($js);
	minifyCSS($css);
?>
</body>

<!DOCTYPE html>
<html>
	<head>
		<title> HTML5 Web-Radio Player </title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
<?php
	$file = file_get_contents('./radio.json', FILE_USE_INCLUDE_PATH);
	echo 'liste des radios disponibles : '. $file;
?>
	</body>
</html>

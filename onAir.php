<?php

/************************************
 *
 *	@file=onAir.php
 *	@description=Return current song on Air
 *	@author=Damien Calesse
 *
 ************************************/

define('LIB_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', LIB_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);


require_once (LIB_PATH . 'Icecast/Icecast.php');
require_once (VENDOR_PATH . 'simplehtmldom/simple_html_dom.php');
require_once (LIB_PATH . 'autoload.php');
require_once (LIB_PATH . 'server.class.php');


if (isset($_POST) && ($_POST['server'])) {

	$infos = Server::init($_POST['address']);

	if (trim($_POST['address']) == '') {
		$reflectionMethod = new ReflectionMethod(ucfirst($_POST['server']), 'getInfos');
		if ($reflectionMethod->isStatic()) {
			$infos = $reflectionMethod->invokeArgs(null, array($infos));
		} else {
			$infos = $reflectionMethod->invokeArgs(new $_POST['server'], array($infos));
		}
	}

	print_r (json_encode($infos));
}

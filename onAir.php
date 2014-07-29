<?php

/************************************
 *
 *	@file=onAir.php
 *	@description=Return current song on Air
 *	@author=Damien Calesse
 *
 ************************************/

require_once ('./require.php');


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

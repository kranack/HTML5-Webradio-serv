<?php

/************************************
 *
 *	@file=onAir.php
 *	@author=Damien Calesse
 *
 ************************************/


require_once ("./Icecast/Icecast.php");
include_once ("../vendor/simplehtmldom/simple_html_dom.php");

function __autoload($classname) {
	if ($p = get_parent_class($classname))
		include_once('./modules/'.$p.'.class.php');
	if ($interfaces = class_implements($classname))
		foreach ($interfaces as $interface) {
			include_once('./modules/'.$interface.'.interface.php');
		}
    $filename = "./modules/". $classname .".class.php";
    include_once($filename);
}


if (isset($_POST) && ($_POST['server'])) {

	$serveur = new IceCast();
	$html = "";
	$infos = array();
	if (trim($_POST['address']) != '') {
		$serveur->setUrl($_POST['address']);
		$infos = $serveur->getStatus();
	} else {
		$serveur->setUrl($_POST['address']);
		$tmp = $serveur->getStatus();
		$reflectionMethod = new ReflectionMethod(ucfirst($_POST['server']), 'getInfos');
		if ($reflectionMethod->isStatic()) {
			$infos = $reflectionMethod->invokeArgs(null, array($tmp));
		} else {
			$infos = $reflectionMethod->invokeArgs(new $_POST['server'], array($tmp));
		}
	}
	print_r (json_encode($infos));
}
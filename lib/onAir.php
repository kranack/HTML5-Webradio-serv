<?php

/************************************
 *
 *	@file=onAir.php
 *	@author=Damien Calesse
 *
 ************************************/

require_once ("./functions.php");
require_once ("./Icecast.php");
include_once ("../vendor/simplehtmldom/simple_html_dom.php");

function __autoload($classname) {
    $filename = "./modules/". $classname .".class.php";
    include_once($filename);
}

if (isset($_GET) && ($_GET['server'])) {

	$serveur = new IceCast();
	$html = "";
	$infos = array();
	
	switch ($_GET['address']) {
		case '':
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			echo 'no address';
			//$infos = $_GET['server']::getInfos($tmp);
			break;
		default :
			$serveur->setUrl($_GET['address']);
			$infos = $serveur->getStatus();
			break;
	}
	print_r (json_encode($infos));
}
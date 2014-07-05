<?php

/************************************
 *
 *	@file=onAir.php
 *	@author=Damien Calesse
 *
 ************************************/

//require_once ("./functions.php");
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
	
	switch ($_GET['server']) {
		case 'ouifm' :
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			$infos = Ouifm::getInfos($tmp);
			break;
		case 'mouv' :
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			$infos = Mouv::getInfos($tmp);
			break;
		case 'fip' :
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			$infos = Fip::getInfos($tmp);
			break;
		default :
			$serveur->setUrl($_GET['address']);
			$infos = $serveur->getStatus();
			break;
	}
	print_r (json_encode($infos));
}
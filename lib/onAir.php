<?php

/************************************
 *
 *	@file=onAir.php
 *	@author=Damien Calesse
 *
 ************************************/

require_once ("./functions.php");
require_once ("./Icecast.php");

if (isset($_GET) && ($_GET['server'])) {

	$serveur = new IceCast();
	$html = "";
	$infos = array();

	switch ($_GET['server']) {
		case 'ouifm' :
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			$infos = getRadioInfos("oui", $tmp);
			break;
		case 'mouv' :
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			$infos = getRadioInfos("mouv", $tmp);
			break;
		case 'fip' :
			$serveur->setUrl($_GET['address']);
			$tmp = $serveur->getStatus();
			$infos = getRadioInfos("fip", $tmp);
			break;
		default :
			$serveur->setUrl($_GET['address']);
			$infos = $serveur->getStatus();
			break;
	}
	print_r (json_encode($infos));
}
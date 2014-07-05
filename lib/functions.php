<?php

include_once ("../vendor/simplehtmldom/simple_html_dom.php");

function __autoload($classname) {
    $filename = "./modules/". $classname .".class.php";
    include_once($filename);
}

function LeMouv_chooseMin ($min) {
	
	$minutes = array('00',15,30,45);
	$res = array();
	for ($i=0;$i<count($minutes);$i++) {
		$res[] = abs($minutes[$i] - $min);
	}
	$n = (array_search(min($res), $res)) ;
	
	return $minutes[$n];
}

function LeMouv_hourFormat ($hour) {
	
	return (int)$hour;
	
}


function getRadioInfos ($radio, $tmp) {

	switch ($radio) {
		case 'mouv' :
				$infos = Mouv::getInfos($tmp);
			break;
		case 'oui' :
				$infos = OuiFm::getInfos($tmp);
			break;
		case 'fip' :
				$infos = Fip::getInfos($tmp);
			break;
		default :
			break;
	}
	return $infos;
}
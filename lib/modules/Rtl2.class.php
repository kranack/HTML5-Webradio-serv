<?php

/************************************
 *
 *	@file=Rtl2.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Rtl2 {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.rtl2.fr');
		
		$live = $html->find('div.emissions', 0);
		$items = array();
		$infos['title'] = 'RTL2';
		
		$infos['now_playing']['artist'] = trim(substr($live->find('p.animateurs', 0)->plaintext, 0));
		$infos['now_playing']['track'] = trim(substr($live->find('p.show', 0)->plaintext, 0));
		$infos['now_playing']['cover'] = "http://static.rtl2.fr/www/img/logo_header.png";

		return $infos;
	}

}
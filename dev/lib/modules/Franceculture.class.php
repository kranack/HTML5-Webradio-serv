<?php

/************************************
 *
 *	@file=Franceculture.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Franceculture {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.franceculture.fr/player');
		$infos['title'] = 'France Culture';
		
		$live = $html->find('div.content', 0);
		
		if ($l = $live->find('div.metas', 0)) {
			$infos['now_playing']['emission'] = trim(substr($l->find('span.title', 0)->plaintext, 0));
			$infos['now_playing']['animateur'] = trim(substr($l->find('span.author', 0)->plaintext, 0));
			$infos['now_playing']['artist'] = trim(substr($live->find('h1.title', 0)->plaintext, 0));
			$infos['now_playing']['track'] = '';
		} else {
			$infos['now_playing']['artist'] = '';
			$infos['now_playing']['track'] = '';
		}

		return $infos;
	}

}
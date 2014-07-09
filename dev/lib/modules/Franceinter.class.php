<?php

/************************************
 *
 *	@file=Franceinter.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Franceinter {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.franceinter.fr/player');
		$infos['title'] = 'France Inter';

		$live = $html->find('div#emission_content', 0);

		if ($l = $live->find('div.metas', 0)) {
			$infos['now_playing']['emission'] = trim(substr($l->find('span.title', 0)->plaintext, 0));
			$infos['now_playing']['animateur'] = trim(substr($l->find('span.author', 0)->plaintext, 0));
			$infos['now_playing']['artist'] = trim(substr($live->find('h1.title', 0)->plaintext, 0));
			$infos['now_playing']['track'] = '';
		} else {
			$infos['now_playing']['artist'] = '';
			$infos['now_playing']['title'] = '';
		}

		return $infos;
	}

}
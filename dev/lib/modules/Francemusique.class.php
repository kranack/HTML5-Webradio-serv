<?php

/************************************
 *
 *	@file=Francemusique.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Francemusique {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.francemusique.fr/playerr');
		$infos['title'] = 'France Musique';
		
		$live = $html->find('div#emission_content', 0);

		if ($l = $live->find('div.content', 0)) {
			$infos['now_playing']['emission'] = trim(substr($l->find('h2#musique_title', 0)->plaintext, 0));
			$infos['now_playing']['animateur'] = trim(substr($l->find('h2#musique_subtitle', 0)->plaintext, 0));
			$infos['now_playing']['artist'] = '';
			$infos['now_playing']['track'] = '';
		} else {
			$infos['now_playing']['artist'] = '';
			$infos['now_playing']['title'] = '';
		}

		return $infos;
	}

}
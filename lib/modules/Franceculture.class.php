<?php

class Franceculture {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.franceculture.fr/');
		$infos['title'] = 'France Culture';
		
		$live = $html->find('div#bloc-direct-ajax', 0);
		
		if ($song = $live->find('div.context', 0)) {
			
			$t = trim(substr($song->find('p', 0)->plaintext, 0));
			$e = explode('...', $t);
			$infos['now_playing']['emission'] = $e[0];
			$infos['now_playing']['animateur'] = $e[1];
			$infos['now_playing']['artist'] = '';
			$infos['now_playing']['track'] = '';

		} else {
			$infos['artist'] = "";
			$infos['track'] = "";
		}

		return $infos;
	}

}
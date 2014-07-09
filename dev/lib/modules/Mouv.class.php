<?php

/************************************
 *
 *	@file=Mouv.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Mouv {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.lemouv.fr');
		$infos['title'] = "Le Mouv'";

		$live = $html->find('div#block-lemouv_direct-direct', 0);
		$infos['now_playing']['animateur'] = trim(substr($live->find('span.animateur', 0)->plaintext, 0));
		$infos['now_playing']['emission'] = trim(substr($html->find('span.emission', 0)->plaintext, 0));
		
		if ($song = $live->find('div.direct', 0)) {
			$item = array();
			$item['cover'] = $song->find('img', 0)->src;
			$d = trim(substr($song->find('span.titre', 0)->plaintext, 0));
			if ($d) {
				$r = explode('-', $d);
				$item['artist'] = $r[0];
				$item['title'] = $r[1];
			} else {
				$item['artist'] = '';
				$item['title'] = '';
			}
			
			if (!(empty($item))) {
				$infos['now_playing']['artist'] = (($item['artist'] == null) || ($item['artist'] == '')) ? null : $item['artist'];
				$infos['now_playing']['track'] = (($item['title'] == null) || ($item['title'] == '')) ? null : $item['title'];
				$infos['now_playing']['cover'] = $item['cover'];
			}
		} else {
			$infos['artist'] = '';
			$infos['track'] = '';
		}
		
		return $infos;
	}

}
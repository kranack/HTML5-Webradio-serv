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
		$html = file_get_html('http://www.lemouv.fr/ckoicetitre');
		$infos['title'] = "Le Mouv'";

		$live = $html->find('#block-lemouv_direct-direct', 0);
		if ($live->find('span.animateur', 0))
			$infos['now_playing']['animateur'] = trim(substr($live->find('span.animateur', 0)->plaintext, 0));
		if ($live->find('span.emission', 0))
			$infos['now_playing']['emission'] = trim(substr($html->find('span.emission', 0)->plaintext, 0));

		$song = $html->find('.views-row-first', 0);
		$infos['now_playing']['cover'] = $song->find('img', 0)->src;
		$infos['now_playing']['track'] = trim(substr($song->find('.title', 0)->plaintext, 0));
		$infos['now_playing']['artist'] = trim(substr($song->find('.name', 0)->plaintext, 0));

		return $infos;
	}

}

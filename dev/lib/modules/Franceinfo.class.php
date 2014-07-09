<?php

/************************************
 *
 *	@file=Franceinfo.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Franceinfo {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.franceinfo.fr/player');
		$infos['title'] = 'France Info';
		
		$live = $html->find('div#rf_rel', 0);
		
		if ($song = $live->find('div.infos', 0)) {
			$item = array();
			$item['cover'] = $song->find('img', 0)->src;
			$item['artist'] =  null;
			$item['title'] =  trim(substr($song->find('p.rf_rel_diffusion_title', 0)->plaintext, 0));
			
			if (!(empty($item))) {
				$infos['now_playing']['artist'] = $item['artist'];
				$infos['now_playing']['track'] = $item['title'];
				$infos['now_playing']['cover'] = $item['cover'];
			}
		} else {
			$infos['artist'] = '';
			$infos['track'] = '';
		}

		return $infos;
	}

}
<?php

class Fip {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.fipradio.fr/player');
		$infos['title'] = 'FIP';
		
		$live = $html->find('div#emission_content', 0);
		
		if ($song = $live->find('div.content', 0)) {
			$item = array();
			//$item['cover'] = $song->find('img', 0)->src;
			$item['cover'] = 'http://www.fipradio.fr/sites/all/themes/fip_player_theme/img/95x95.png';
			$item['artist'] =  trim(substr($song->find('p.desc', 0)->plaintext, 0));
			$item['title'] =  trim(substr($song->find('h1.title', 0)->plaintext, 0));
			
			if (!(empty($item))) {
				//print (substr(substr($list[0]['cover'], '10'), 0,'-11'));
				//print($list[0]['cover']);
				$infos['now_playing']['artist'] = $item['artist'];
				$infos['now_playing']['track'] = $item['title'];
				$infos['now_playing']['cover'] = $item['cover'];
			}
		} else {
			$infos['artist'] = "";
			$infos['track'] = "";
		}

		return $infos;
	}

}
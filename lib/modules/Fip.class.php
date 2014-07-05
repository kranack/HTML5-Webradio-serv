<?php

class Fip {


	public static function getInfos($tmp) {
		$infos = $tmp;
		$html = file_get_html('http://www.fipradio.fr/');
		$infos['title'] = 'FIP';
		
		$live = $html->find('div#direct-list', 0);
		
		if ($song = $live->find('div.direct-current', 0)) {
			$item = array();
			$item['cover'] = $song->find('img', 0);
			$d = trim(substr($song->find('span.titre', 0)->plaintext, 0));
			$r = explode('-', $d);
			$item['artist'] =  trim(substr($song->find('span.artiste', 0)->plaintext, 0));
			$item['title'] =  trim(substr($song->find('span.titre', 0)->plaintext, 0));
			
			if (!(empty($item))) {
				//print (substr(substr($list[0]['cover'], '10'), 0,'-11'));
				//print($list[0]['cover']);
				$infos['now_playing']['artist'] = $item['artist'];
				$infos['now_playing']['track'] = $item['title'];
				$infos['now_playing']['cover'] = substr(substr($item['cover'], '10'), 0,'-11');
			}
		} else {
			$infos['artist'] = "";
			$infos['track'] = "";
		}

		return $infos;
	}

}
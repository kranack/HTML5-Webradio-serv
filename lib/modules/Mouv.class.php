<?php

class Mouv {


	public static function getInfos($tmp) {
		$infos = $tmp;
		//$minutes = LeMouv_chooseMin(date('i'));
		$html = file_get_html('http://www.lemouv.fr');
		//print ('http://www.lemouv.fr/ckoicetitre?start_date='.date('Y-m-d').'&start_hour='.LeMouv_hourFormat(date('H')).'&start_minute='.$minutes);
		//print($html);
		
		$infos['title'] = "Le Mouv'";
		$live = $html->find('div#block-lemouv_direct-direct', 0);
		$infos['now_playing']['animateur'] = trim(substr($live->find('span.animateur', 0)->plaintext, 0));
		$infos['now_playing']['emission'] = trim(substr($html->find('span.emission', 0)->plaintext, 0));
		
		if ($song = $live->find('div.direct', 0)) {
			$item = array();
			$item['cover'] = $song->find('img', 0);
			$d = trim(substr($song->find('span.titre', 0)->plaintext, 0));
			$r = explode('-', $d);
			$item['artist'] = $r[0];
			$item['title'] = $r[1];
			
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
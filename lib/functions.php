<?php

include_once ("../vendor/simplehtmldom/simple_html_dom.php");

function LeMouv_chooseMin ($min) {
	
	$minutes = array('00',15,30,45);
	$res = array();
	for ($i=0;$i<count($minutes);$i++) {
		$res[] = abs($minutes[$i] - $min);
	}
	$n = (array_search(min($res), $res)) ;
	
	return $minutes[$n];
}

function LeMouv_hourFormat ($hour) {
	
	return (int)$hour;
	
}


function getRadioInfos ($radio, $tmp) {

	switch ($radio) {
		case 'mouv' :
			$infos = $tmp;
			$minutes = LeMouv_chooseMin(date('i'));
			$html = file_get_html('http://www.lemouv.fr/ckoicetitre?start_date='.date('Y-m-d').'&start_hour='.LeMouv_hourFormat(date('H')).'&start_minute='.$minutes);
			//print ('http://www.lemouv.fr/ckoicetitre?start_date='.date('Y-m-d').'&start_hour='.LeMouv_hourFormat(date('H')).'&start_minute='.$minutes);
			//print($html);

			$infos['title'] = "Le Mouv'";
			$live = $html->find('div#block-lemouv_direct-direct', 0);
			$infos['now_playing']['animateur'] = trim(substr($live->find('span.animateur', 0)->plaintext, 0));
			$infos['now_playing']['emission'] = trim(substr($html->find('span.emission', 0)->plaintext, 0));
			
			if ($song = $html->find('div.encart', 0)) {
				$item = array();
				$item['cover'] = $song->find('img', 0);
				$item['artist'] = trim(substr($song->find('div.name', 0)->plaintext, 0));
				$item['title'] = trim(substr($song->find('div.title', 0)->plaintext, 0));
				
				if (!(empty($item))) {
					//print (substr(substr($list[0]['cover'], '10'), 0,'-11'));
					//print($list[0]['cover']);
					$infos['now_playing']['artist'] = $item['artist'];
					$infos['now_playing']['track'] = $item['title'];
					$infos['now_playing']['cover'] = substr(substr($item['cover'], '10'), 0,'-11');
				}
			} else {
				$item['artist'] = "";
				$item['track'] = "";
			}
			echo 'artist : '.$item['artist'];
			break;
		case 'oui' :
			$infos = $tmp;
			$html = file_get_html('http://www.ouifm.fr/cest-quoi-ce-titre');
			$list = $html->find('div#cest-quoi-ce-titre-results', 0);
			$items = array();
			$infos['title'] = 'Ouï FM';
			
			foreach($list->find('li') as $song) {
				$item = array();
				$item['cover'] = $song->find('img', 0)->src;
				$item['artist'] = trim(substr($song->find('strong.artist', 0)->plaintext, 0));
				$item['title'] = trim(substr($song->find('strong.title', 0)->plaintext, 0));
				$items[] = $item;
			}
			$infos['now_playing']['artist'] = $items[0]['artist'];
			$infos['now_playing']['track'] = $items[0]['title'];
			$infos['now_playing']['cover'] = $items[0]['cover'];
			break;
		default :
			break;
	}
	return $infos;
}
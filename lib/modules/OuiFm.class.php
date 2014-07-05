<?php

class OuiFm {


	public static function getInfos($tmp) {
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

		return $infos;
	}

}
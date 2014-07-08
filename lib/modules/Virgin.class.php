<?php

/************************************
 *
 *	@file=Virgin.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Virgin {


	public static function getInfos($tmp) {
		$infos = $tmp;
		
		$program = json_decode(file_get_contents('http://www.virginradio.fr/calendar/api/current.json/argv/calendar_type/emission/origine_flags/virginradio/get_current_foreign_type/TRUE'));

		$root_program = $program->root_tab;
		$start = str_replace(' ', '%20', $root_program->events[0]->start);
		$end = str_replace(' ', '%20', $root_program->events[0]->end);

		$live = json_decode(file_get_contents('http://www.virginradio.fr/radio/api/get_all_events.json/argv/id_radio/2/start/'.$start.'/end/'.$end));
		$root_live = $live->root_tab;

		$infos['now_playing']['emission'] = $root_program->events[0]->tab_foreign_type->nom_thema;
		$infos['now_playing']['animateur'] = $root_program->events[0]->title;
		$infos['now_playing']['artist'] = $root_live->event[0]->artist;
		$infos['now_playing']['track'] = $root_live->event[0]->title;
		$infos['now_playing']['cover'] = $root_live->event[0]->cover;
		
		return $infos;
	}

}
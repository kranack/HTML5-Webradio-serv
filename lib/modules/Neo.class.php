<?php

/************************************
 *
 *	@file=Neo.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Neo {

    public static function getInfos($tmp) {
        $infos = $tmp;
        $json = json_decode(file_get_contents('http://www.radioneo.org/player/playlistLive.php'));
        
        $infos['now_playing']['artist'] = $json->artisteNom;
        $infos['now_playing']['track'] = $json->titreNom;

        return $infos;
    }

}

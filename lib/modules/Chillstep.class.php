<?php

/************************************
 *
 *	@file=Chillstep.class.php
 *	@author=Damien Calesse
 *
 ************************************/

class Chillstep {

    public static function getInfos($tmp) {
        $infos = $tmp;
        $json = json_decode(file_get_contents('http://chillstep.info/jsonInfo.php'));
        
        $infos = explode("-", $json->title);
        $infos['now_playing']['artist'] = $infos[0];
        $infos['now_playing']['track'] = $infos[1];

        return $infos;
    }

}

<?php

/************************************
 *
 *	@file=onAir.php
 *	@description=Return current song on Air
 *	@author=Damien Calesse
 *
 ************************************/

require_once ('./require.php');


if (isset($_GET) && ($_GET['server'])) {
	$infos = array();
	Server::init($_GET['address'], $_GET['server']);

	$infos = Server::getInfos();

	while (trim($infos['now_playing']['track'], ' ') == trim(urldecode($_GET['current_track']), ' ')) 
	{
		usleep(10000000); // 10 s (10 * 1 000 000 us)
		Server::reload();
		$infos = Server::getInfos();
	}

	echo json_encode($infos);
}

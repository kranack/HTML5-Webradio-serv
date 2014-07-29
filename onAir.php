<?php

/************************************
 *
 *	@file=onAir.php
 *	@description=Return current song on Air
 *	@author=Damien Calesse
 *
 ************************************/

require_once ('./require.php');


if (isset($_POST) && ($_POST['server'])) {
	$infos = array();
	$infos = Server::init($_POST['address'], $_POST['server']);

	print_r (json_encode($infos));
}

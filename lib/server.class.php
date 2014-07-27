<?php

/************************************
 *
 *	@file=server.class.php
 *	@description=Server Class
 *	@author=Damien Calesse
 *
 ************************************/


class Server {


	public static function init($address) {
		$server = new IceCast();
		$infos = array();
		$server->setUrl($address);

		return $server->getStatus();
	}

}
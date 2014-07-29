<?php

/************************************
 *
 *	@file=server.class.php
 *	@description=Server Class
 *	@author=Damien Calesse
 *
 ************************************/


class Server {

	static private $_server;
	static private $_infos;

	public static function init($address, $server) {
		self::$_server = new IceCast();
		self::$_server->setUrl($address);

		if (trim($address) == '')
			self::getModule($server);
		else
			self::getStatus();

		return self::$_infos;
	}

	public static function getStatus() {
		self::$_infos = self::$_server->getStatus();
	}

	public static function getModule($server, $infos = array()) {
		$reflectionMethod = new ReflectionMethod(ucfirst($server), 'getInfos');
		if ($reflectionMethod->isStatic())
			self::$_infos = $reflectionMethod->invokeArgs(null, array($infos));
		else
			self::$infos = $reflectionMethod->invokeArgs(new $server, array($infos));
	}

}
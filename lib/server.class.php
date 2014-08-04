<?php

/************************************
 *
 *	@file=server.class.php
 *	@description=Server Class
 *	@author=Damien Calesse
 *
 ************************************/


class Server {

	static private $_server = null;
	static private $_infos = null;
	static private $_module = null;

	public static function init($address, $server) {
		self::$_server = new IceCast();
		self::$_server->setUrl($address);

		if (trim($address) == '')
			self::getModule($server);
		else
			self::getStatus();
	}

	private static function getStatus() {
		self::$_infos = self::$_server->getStatus();
	}

	private static function getModule($server, $infos = array()) {
		self::$_module = ucfirst($server);
		$reflectionMethod = new ReflectionMethod(ucfirst($server), 'getInfos');
		if ($reflectionMethod->isStatic())
			self::$_infos = $reflectionMethod->invokeArgs(null, array($infos));
		else
			self::$infos = $reflectionMethod->invokeArgs(new $server, array($infos));
	}

	public static function reload() {
		if (self::$_module == null)
			self::getStatus();
		else
			self::getModule(self::$_module);
	}

	public static function getInfos() {
		return self::$_infos;
	}

}
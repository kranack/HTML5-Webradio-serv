<?php

/************************************
 *
 *	@file=autoload.php
 *	@description=Autoload function (seek & load)
 *	@author=Damien Calesse
 *
 ************************************/

function __autoload($classname) {
    $filename = MODULE_PATH . $classname . '.class.php';
    require_once($filename);
	if ($p = get_parent_class($classname))
		require_once(MODULE_PATH . $p . '.class.php');
	if ($interfaces = class_implements($classname))
		foreach ($interfaces as $interface) {
			require_once(MODULE_PATH . $interface . '.interface.php');
		}
}
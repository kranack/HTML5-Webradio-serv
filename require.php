<?php

/************************************
 *
 *	@file=require.php
 *	@description=require lib & classes
 *	@author=Damien Calesse
 *
 ************************************/

define('LIB_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', LIB_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);


require_once (LIB_PATH . 'icecast/Icecast.php');
require_once (VENDOR_PATH . 'simplehtmldom/simple_html_dom.php');
require_once (LIB_PATH . 'autoload.php');
require_once (LIB_PATH . 'server.class.php');
<?php
require 'config.php';
session_start();

/* Init */
ini_set('include_path', 'libs/:'. ini_get('include_path'));
date_default_timezone_set(TIME_ZONE);

require'Smarty/Smarty.class.php';
//require'Zend/Cache.php';

/* Init View */
$view = new Smarty;
$view->caching = false;
$view->template_dir = TEMPLATE_DIR;
$view->compile_dir = COMPILE_DIR;
$view->config_dir = CONFIG_DIR;
$view->cache_dir = CACHE_DIR;
$view->assign('themes', THEMES);

if(isset($_SESSION['user']) && $_SESSION['user'] != 'guest')
{
	session_destroy();

	/* Output */
	$view->display('logout.tpl');
}
else
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.html';
	header("Location: http://$host$uri/$extra");
}
?>

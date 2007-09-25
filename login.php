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

if(isset($_POST['username']) && isset($_POST['password']))
{
	/* Init Databases */
	$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
		or die('Could not connect: ' . mysql_error());
	mysql_select_db(WALKER_DB_NAME);
	mysql_query('SET NAMES utf8');
	mysql_query('SET CHARACTER SET utf8');
	mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

	$username = strval($_POST['username']);
	$password = strval($_POST['password']);

	$result = mysql_query("SELECT usr_name, usr_nickname, usr_password FROM walker_user WHERE usr_name = '$username'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	if($username == $row['usr_name'] && md5($password) == $row['usr_password'])
	{
		$_SESSION['user'] = $row['usr_nickname'];
		$_SESSION['usr'] = $row['usr_name'];
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'manage.html';
		header("Location: http://$host$uri/$extra");
	}
	mysql_close($db);
}
else
{
}

/* Output */
$view->display('login.tpl');
?>

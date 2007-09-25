<?php
require 'config.php';

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

/* Init Databases */
$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
	or die('Could not connect: ' . mysql_error());
mysql_select_db(WALKER_DB_NAME);
mysql_query('SET NAMES utf8');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

if(isset($_GET['m']))
{
	$m = strtolower(trim($_GET['m']));
}
else
{
	$m = 'home';
}

switch($m)
{
default:
case 'home':
	$sql = "SELECT * FROM walker_post ORDER BY post_create DESC LIMIT " . COUNT_OF_FEED;
	//echo $sql;
	$result = mysql_query($sql);

	$num_rows = mysql_num_rows($result);

	$i = 0;
	while($i < $num_rows)
	{
		$row[$i] = mysql_fetch_array($result, MYSQL_ASSOC);
		$i++;
	}
	//print_r($row);

	$view->assign('channel', $row);
	mysql_free_result($result);
	$view->display('rss.tpl');
	break;

case 'view':
	$id = intval(trim($_GET['id']));
	$result = mysql_query('SELECT * FROM walker_post WHERE post_id = ' . $id);
	$blog = mysql_fetch_array($result, MYSQL_ASSOC);
	$result = mysql_query('SELECT * FROM walker_reply WHERE reply_pid = ' . $id);
	$reply = mysql_fetch_array($result, MYSQL_ASSOC);

	$view->assign('blog', $blog);
	$view->assign('reply', $reply);
	$view->display('view.tpl');
	break;
}
mysql_close($db);
?>

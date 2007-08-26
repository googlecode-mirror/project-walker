<?php
/* Project Walker
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: walker.php 0 2007-06-24 09:10:15Z always.8 $
 * @copyright http://www.n7money.cn/
 *
 * Thanks to Livid
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

session_start();
if(!isset($_SESSION['user']))
{
	$_SESSION['user'] = 'guest';
}
require 'config.php';

/* Init */
ini_set('include_path', 'libs/:'. ini_get('include_path'));
ini_set('include_path', 'libs/FusionCharts/:'. ini_get('include_path'));
date_default_timezone_set(TIME_ZONE);

require'Includes/FusionCharts.php';
require'Smarty/Smarty.class.php';
//require'Zend/Cache.php';

/* Init View */
$view = new Smarty;
$view->caching = false;
$view->template_dir = TEMPLATE_DIR;
$view->compile_dir = COMPILE_DIR;
$view->config_dir = CONFIG_DIR;
$view->cache_dir = CACHE_DIR;

if(strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
{
	$view->assign('style', 'ie.css');
	$_SESSION['browser'] = 'IE';
}
else
{
	$view->assign('style', 'style.css');
}

/* Init Databases */
$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
	or die('Could not connect: ' . mysql_error());
mysql_select_db(WALKER_DB_NAME);
mysql_query('SET NAMES utf8');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

$user = $_SESSION['user'];

/*$frontendOptions = array(
	'lifeTime' => 7200,
	'automaticSerialization' => true
);

$backendOptions = array(
	'cacheDir' => WALKER_PREFIX . '/tmp/cache/'
);

$this->cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);*/

/*if(!$post = $this->cache->load('index'))
{
	$result = $this->db->query('SELECT * FROM walker_post');
	$post = $result->fetchAll();
	$this->cache->save($post, 'index');
	$this->view->assign('post', $post);
	$this->view->display('index.tpl');
}
else
{
	$this->view->assign('post', $post);
	$this->view->display('index.tpl');
}*/

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
	/* Sorry, site do not support IE browser */
	/*if(strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
	{
		echo '<?xml version="1.0" encoding="utf-8"?>';
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"';
		echo '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml">';
		echo '<head>';
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
		echo '<title>ξ命令提示符</title>';
		echo '</head>';
		echo '<body>';
		echo '<span style="font-size:18px; color:#9c0000; display:block; margin-top:200px; margin-left:150px; ';
		echo 'width:700px; height:25px; border:1px solid #eee;">很抱歉，本站不提供对IE浏览器的支持,';
		echo '为了更好的体验请使用Firefox，谢谢！</span><br />';
		echo '<span style="margin-left:320px;">';
		echo '<a href="http://www.mozilla.org.cn">下载Firefox</a>';
		echo '</span>';
		echo '</body>';
		echo '</html>';
	}
	else
	{*/
	$result = mysql_query('SELECT * FROM walker_post');
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);

	$view->assign('content', 
		array('title' => $row[post_title],
		'author' => $row[post_author],
		'create' => $row[post_create],
		'hits' => $row[post_hits],
		'contents' => $row[post_content]));
	$view->display('index.tpl');
	//}
	break;

case 'view':
	$id = intval(trim($_GET['id']));
	$result = mysql_query('SELECT * FROM walker_post WHERE post_id = ' . $id);
	$blog = mysql_fetch_array($result, MYSQL_ASSOC);
	$result = mysql_query('SELECT * FROM walker_reply WHERE reply_pid = ' . $id);
	$reply = mysql_fetch_array($result, MYSQL_ASSOC);

	$view->assign('blog', 
		array('title' => $blog[post_title],
		'author' => $row[post_author],
		'create' => $blog[post_create],
		'hits' => $blog[post_hits],
		'contents' => $blog[post_content]));
	$view->assign('reply', $reply);
	$view->display('view.tpl');
	break;

case 'edit':
	$id = intval(trim($_GET['id']));
	$result = mysql_query('SELECT * FROM walker_post WHERE post_id = ' . $id);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	$view->assign('edit', 
		array('title' => $row['post_title'],
		'tags' => $row[post_tags],
		'contents' => $row[post_content]));
	//print_r($row[post_content]);
	$view->display('edit.tpl');
	break;

case 'tags':
	$tag = strval(trim($_GET['tag']));
	echo $tag;
	break;

case 'post':
	$view->display('post.tpl');
	break;

case 'signup':
	break;

case 'login':
	$view->display('login.tpl');
	break;

case 'logout':
	break;

case 'about':
	$view->display('about.tpl');
	break;

case 'manage':
	$result = mysql_query('SELECT * FROM walker_post');

	$num_rows = mysql_num_rows($result);

	$i = 0;
	while($i < $num_rows)
	{
		$row[$i] = mysql_fetch_array($result, MYSQL_ASSOC);
		$i++;
	}

	$view->assign('num_rows', $num_rows);
	$view->assign('row', $row);
	mysql_free_result($result);
	$view->display('manage.tpl');
	break;

case 'ing':
	$view->display('ing.tpl');
	break;

case 'invest':
	$chart = renderChartHtml("/libs/FusionCharts/FCF_Line.swf", "schema/2007/1436.xml", "", "myNext", 700, 400);
	$card = renderChartHtml("/libs/FusionCharts/FCF_MSLine.swf", "schema/2007/5128.xml", "", "card", 700, 400);
	$view->assign('chart', $chart);
	$view->assign('card', $card);
	$view->display('invest.tpl');
	break;
}
//mysql_close($link);
?>

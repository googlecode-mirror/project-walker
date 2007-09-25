<?php
/* Project Walker
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
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: walker.php 0 2007-09-25 14:51:29Z always.8 $
 * @copyright http://www.n7money.cn/
 */

session_start();
if(!isset($_SESSION['user']))
{
	$_SESSION['user'] = 'guest';
}
require_once 'config.php';

/* Init */
ini_set('include_path', 'libs/:'. ini_get('include_path'));
ini_set('include_path', 'libs/ZendFramework-0.9.3-Beta:'. ini_get('include_path'));
ini_set('include_path', 'libs/pear:'. ini_get('include_path'));
ini_set('include_path', 'libs/FusionCharts/:'. ini_get('include_path'));

/* Set default timezone */
date_default_timezone_set(TIME_ZONE);

require_once 'Includes/FusionCharts.php';
require_once 'Smarty/Smarty.class.php';
require_once 'models/utils.php';
require_once 'models/Tags.class.php';
require_once 'models/Links.class.php';
require_once 'models/Show.class.php';
require_once 'Cache/Lite.php';
require_once 'Zend/Cache.php';

/* Init View */
$view = new Smarty;
$view->caching = false;
$view->template_dir = TEMPLATE_DIR;
$view->compile_dir = COMPILE_DIR;
$view->config_dir = CONFIG_DIR;
$view->cache_dir = CACHE_DIR;

$view->assign('themes', THEMES);
$view->assign('dns', DOMAIN_NAME);
$view->assign('usr', $_SESSION['usr']);
if($_SESSION['usr'] == 'root')
{
	define('ROOT', true);
}
else
{
	define('ROOT', false);
}

$user = $_SESSION['user'];

/* Init Databases */
$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
	or die('Could not connect: ' . mysql_error());
mysql_select_db(WALKER_DB_NAME);
mysql_query('SET NAMES utf8');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");


/* Zend_Cache solution */
$frontendOptions = array(
	'lifetime' => LIFETIME,
	'automatic_serialization' => true
);
$backendOptions = array(
	'cache_dir' => CACHE_DIR
);
$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);

$content = Zend_Cache::factory('Core', 'File', 
	array('lifetime' => LIFETIME_OF_CONTET,'automatic_serialization' => true), 
	array('cache_dir' => CACHE_DIR)
);

/* Get tags list */
$tags = new Tags;
if(ROOT)
{
	$tag_list = $tags->getAll(true);
}
else
{
	$tag_list = $tags->getAll();
}

$view->assign('tag', $tag_list);

/* Get links list */
$links = new Links("schema/Links.xml");
$link_list = $links->output();
$view->assign('links', $link_list);

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
	//echo $_SESSION['user'];

	/* Flickr cache */
	require_once 'models/Flickr.class.php';
	if(!$flickr = $cache->load('flickr'))
	{
		$flickr = Flickr::output("schema/Flickr.xml");
		$view->assign('flickr', $flickr);
		$cache->save($flickr, 'flickr');
	}
	else
	{
		$view->assign('flickr', $flickr);
	}

	/* Ing cache */
	require_once 'models/Ing.class.php';
	$Ing = new Ing;
	if(!$ing_list = $cache->load('ing'))
	{
		$ing_list = $Ing->output('LOCAL');
		$view->assign(
			array(
				'ing' => $ing_list,
				'ingColor' => rand_color(true)
			));
		$view->assign('ing', $ing_list);
		$cache->save($ing_list, 'ing');
	}
	else
	{
		$view->assign(
			array(
				'ing' => $ing_list,
				'ingColor' => rand_color(true)
			));
	}

	if(!$index = $content->load('index'))
	{
		$show = new Show();
		$show->count_of_result = DISPLAY_OF_PAGE;

		if(ROOT)
		{
			$index = $show->getByTags('ALL', true);
		}
		else
		{
			$index = $show->getByTags('ALL');
		}

		for($i = 0; $i < count($index); $i ++)
		{
			$id = $index[$i][id];
			$reply = $show->getTopReply($id);
			$index[$i][content] = format_ubb($index[$i][content]);
			$index[$i][reply_user] = $reply[reply_user];
			$index[$i][reply_create] = make_descriptive_time($reply[reply_create]);
			$index[$i][reply_content] = $reply[reply_content];
			$index[$i][reply_desc] = $reply[reply_desc];
		}
		$view->assign('index', $index);
		$content->save($index, 'index');
	}
	else
	{
		$view->assign('index', $index);
	}

	$view->display('index.tpl');
	break;

case 'view':
	$id = intval(trim($_GET['id']));
	if(!$logs_list = $content->load('logs_list'))
	{
		$show = new Show();
		$logs_list = $show->getById($id);
		$reply_list = $show->getReply($id);
		$logs_list[0]['content'] = format_ubb($logs_list[0]['content']);
		$related = $show->getRelated($logs_list[0]['tags']);
		for($i = 0; $i < count($related); $i ++)
		{
			$related[$i][lastmodify] = make_descriptive_time($related[$i][lastmodify]);
		}
		for($i = 0; $i < count($reply_list); $i ++)
		{
			$reply_list[$i][create] = make_descriptive_time($reply_list[$i][create]);
		}
		//print_r($related);
		$view->assign('logs', $logs_list);
		$view->assign('reply', $reply_list);
		$view->assign('count_of_reply', count($reply_list));
		$view->assign('pid', $id);
		$view->assign('related', $related);
		$view->assign('relatedColor', rand_color(true));
		$content->save($logs_list, 'logs_list');
	}
	else
	{
		$view->assign('logs', $logs_list);
	}
	//print_r($logs_list);
	$view->assign(array(
		'tags_name' => $logs_list[0][tags],
		'topic_name' => $logs_list[0][title],
		'topic_id' => $logs_list[0][id]
	));
	$view->display('view.tpl');
	break;

case 'edit':
	check_login();
	$id = intval(trim($_GET['id']));
	$show = new Show();
	$logs_list = $show->getById($id);
	$view->assign('edit', $logs_list);
	$view->display('edit.tpl');
	break;

case 'tags':
	$tag = strval(trim($_GET['tag']));
	$tag = urldecode($tag);
	$view->assign('tags_name', $tag);

	if(!$tags_list = $content->load('tags_list'))
	{
		$show = new Show();

		if(ROOT)
		{
			$tags_list = $show->getByTags($tag, true);
		}
		else
		{
			$tags_list = $show->getByTags($tag);
		}

		for($i = 0; $i < count($tags_list); $i ++)
		{
			$id = $tags_list[$i][id];
			$reply = $show->getTopReply($id);
			$tags_list[$i][content] = format_ubb($tags_list[$i][content]);
			$tags_list[$i][reply_user] = $reply[reply_user];
			$tags_list[$i][reply_create] = make_descriptive_time($reply[reply_create]);
			$tags_list[$i][reply_content] = $reply[reply_content];
			$tags_list[$i][reply_desc] = $reply[reply_desc];
			//print_r($reply);
		}
		$view->assign('tags', $tags_list);
		$content->save($tags_list, 'tags_list');
	}
	else
	{
		$view->assign('tags', $tags_list);
	}

	/* Flickr cache */
	require_once 'models/Flickr.class.php';
	if(!$flickr = $cache->load('flickr'))
	{
		$flickr = Flickr::output("schema/Flickr.xml");
		$view->assign('flickr', $flickr);
		$cache->save($flickr, 'flickr');
	}
	else
	{
		$view->assign('flickr', $flickr);
	}

	$view->display('tags.tpl');
	break;

case 'manage':
	check_login();
	/* Ing cache */
	require_once 'models/Ing.class.php';
	$Ing = new Ing;
	if(!$ing_list = $cache->load('ing'))
	{
		$ing_list = $Ing->output('LOCAL');
		$view->assign(
			array(
				'ing' => $ing_list,
				'ingColor' => rand_color(true)
			));
		$view->assign('ing', $ing_list);
		$cache->save($ing_list, 'ing');
	}
	else
	{
		$view->assign(
			array(
				'ing' => $ing_list,
				'ingColor' => rand_color(true)
			));
	}

	$view->assign('num_rows', $num_rows);
	$view->assign('row', $row);

	$show = new Show();
	if(ROOT)
	{
		$topic_list = $show->getTopicList(true);
	}
	else
	{
		$topic_list = $show->getTopicList();
	}
	$view->assign('topic_list', $topic_list);
	$view->assign('count', count($topic_list));

	$view->display('manage.tpl');
	break;

case 'post':
	check_login();
	$view->display('post.tpl');
	break;

case 'about':
	$view->display('about.tpl');
	break;

case 'help':
	$view->display('help.tpl');
	break;

case 'labs':
	$view->display('labs.tpl');
	break;

case 'rules':
	$view->display('rules.tpl');
	break;
	}
?>

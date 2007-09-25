<?php
/** 
 *
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
 * @version $Id: post.php 0 2007-09-21 18:02:04Z always.8 $
 * @copyright http://www.n7money.cn/
 * @package 
 */
/* Init Databases */
session_start();
require_once 'models/Post.class.php';
require_once 'models/utils.php';
require_once 'config.php';

$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
	or die('Could not connect: ' . mysql_error());
mysql_select_db(WALKER_DB_NAME);
mysql_query('SET NAMES utf8');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

if(isset($_POST['method']))
{
	$post = new Post;

	switch($_POST['method'])
	{
	case 'new':
		check_login();
		$post->setTitle($_POST['title']);
		$post->setAuthor($_SESSION['user']);
		$post->setTags($_POST['tags']);
		$post->setReply($_POST['reply']);
		$post->setShow($_POST['show']);
		$post->setContent($_POST['content']);
		$id = $post->newTopic();
		mysql_close($db);
		echo 'ok';
		//header("Location: http://www.n7money.cn/view/$id.html");
		break;

	case 'modify':
		check_login();
		$post->setId(intval($_POST['topic_id']));
		$post->setTitle($_POST['title']);
		$post->setCreated($_POST['created']);
		$post->setAuthor($_SESSION['user']);
		$post->setReply($_POST['reply']);
		$post->setShow($_POST['show']);
		$post->setContent($_POST['content']);
		$post->setTags($_POST['tags']);
		$post->Modify();
		//echo $_POST['content'];
		mysql_close($db);
		echo 'ok';
		break;

	case 'reply':
		$post->Reply(array(
			'pid' => intval($_POST['pid']),
			'user' => $_SESSION['user'],
			'content' => strval($_POST['reply_content']),
			'desc' => '地球'
		));
		echo 'ok';
		break;
	default:;
	}
}
elseif(isset($_GET['m']) && isset($_SESSION['user']) && $_SESSION['user'] != 'guest')
{
	if($_GET['m'] == 'rm' && $_GET['id'])
	{
		$user = $_SESSION['user'];
		//echo "<script type=\"text/javascript\">alert('$user');</script>";
		//echo $_SESSION['user'];
		$id = intval($_GET['id']);
		$sql = "DELETE FROM `walker_post` WHERE post_id = $id";
		mysql_query($sql);
	}
	mysql_close($db);
	header("Location: http://www.n7money.cn/manage.html");
}
?>

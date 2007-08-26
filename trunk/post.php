<?php
/* Project Walker
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: post.php 0 2007-06-24 09:10:15Z always.8 $
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

require 'config.php';
session_start();

/* Init */
ini_set('include_path', 'libs/:'. ini_get('include_path'));
date_default_timezone_set(TIME_ZONE);

/* Init Databases */
$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
	or die('Could not connect: ' . mysql_error());
mysql_select_db(WALKER_DB_NAME);
mysql_query('SET NAMES utf8');
mysql_query('SET CHARACTER SET utf8');
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

if(isset($_POST['title']) && isset($_POST['categ']) && isset($_POST['content']) && isset($_POST['tags']))
{
	$title = $_POST['title'];
	$content = $_POST['content'];
	$tags = $_POST['tags'];
	$create = time();

	if($_POST['method'] == 'post')
	{
	$sql = "INSERT INTO console_walker.walker_post (`post_id` ,`post_cid` ,`post_title` ,`post_create` ,`post_uid` ,`post_content` ,`post_hits` ,`post_desc` ,`post_tags` ,`post_lastmodify`)VALUES (NULL , '1', '$title', '$create', '1', '$content', '0', ' ', '$tags', '$create')";
	mysql_query($sql);
	$id = intval(mysql_insert_id());
	$_SESSION['post_id'] = $id + 1;
	}
	else if($_POST['method'] == 'update')
	{
	}

	$fp = fopen('post.txt', 'a');
	fwrite($fp, $_POST['method'] . '<br />' . $_POST['categ'] . '<br />' . $_POST['content'] . '<br />' . $sql);
	fclose($fp);
}
mysql_close($db);
?>

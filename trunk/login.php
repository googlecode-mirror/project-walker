<?php
/* Project Walker
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: login.php 0 2007-06-24 09:10:15Z always.8 $
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

require'Smarty/Smarty.class.php';
//require'Zend/Cache.php';

/* Init View */
$view = new Smarty;
$view->caching = false;
$view->template_dir = TEMPLATE_DIR;
$view->compile_dir = COMPILE_DIR;
$view->config_dir = CONFIG_DIR;
$view->cache_dir = CACHE_DIR;

if(isset($_POST['username']) && isset($_POST['password']))
{
	/* Init Databases */
	$db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
		or die('Could not connect: ' . mysql_error());
	mysql_select_db(WALKER_DB_NAME);
	mysql_query('SET NAMES utf8');
	mysql_query('SET CHARACTER SET utf8');
	mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = mysql_query("SELECT usr_name, usr_password FROM walker_user");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	if($username == $row['usr_name'] && md5($password) == $row['usr_password'])
	{
		$_SESSION['user'] = $username;
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.html';
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

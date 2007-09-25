<?php
/** 
 * Project Walker
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Tags.class.php 0 2003-01-05 18:38:11Z always.8 $
 * @copyright http://www.n7money.cn/
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
class Tags
{
	private $db;

	public function __construct()
	{
		/* Init Databases */
		$this->db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
			or die('Could not connect: ' . mysql_error());
		mysql_select_db(WALKER_DB_NAME);
		mysql_query('SET NAMES utf8');
		mysql_query('SET CHARACTER SET utf8');
		mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
	}

	public function exists($tag)
	{
	}

	public function getAll($private = false)
	{
		if($private == true)
		{
			$sql = 'SELECT COUNT( * ) AS `count_of_result` , `post_tags` FROM `walker_post` GROUP BY `post_tags` ORDER BY `post_tags`';
		}
		else
		{
			$sql = "SELECT COUNT( * ) AS `count_of_result` , `post_tags` FROM `walker_post` WHERE post_public = '1' GROUP BY `post_tags` ORDER BY `post_tags`";
		}
		$tmp = mysql_query($sql);
		$fin = array();
		$i = 0;
		while($result = mysql_fetch_array($tmp, MYSQL_ASSOC))
		{
			$fin[$i]['tags'] = $result[post_tags];
			$fin[$i]['count'] = $result[count_of_result];
			//print_r($fin);
			$i ++;
		}
		mysql_free_result($tmp);
		return $fin;
	}

	/*
	 * @static
	 * @param string $tag tag name
	 * @return boolean
	 */
	public static function add($tag)
	{
	}

	public static function remove($tag)
	{
	}

	public function __destruct()
	{
		mysql_close($this->db);
	}
}
?>

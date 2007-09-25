<?php
/** 
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Show.class.php 0 2007-09-22 01:56:11Z always.8 $
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
class Show
{
	public $count_of_result = 5;
	public $db;

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

	public function getByTags($tag = 'ALL', $private = false)
	{
		if($tag != 'ALL' && is_string($tag))
		{
			if($private == true)
			{
				$sql = "SELECT * FROM `walker_post` WHERE post_tags = '$tag' ORDER BY post_create DESC LIMIT $this->count_of_result";
			}
			else
			{
				$sql = "SELECT * FROM `walker_post` WHERE post_tags = '$tag' AND post_public = '1' ORDER BY post_create DESC LIMIT $this->count_of_result";
			}
		}
		else
		{
			if($private == true)
			{
				$sql = "SELECT * FROM `walker_post` ORDER BY post_create DESC LIMIT $this->count_of_result";
			}
			else
			{
				$sql = "SELECT * FROM `walker_post` WHERE post_public = '1' ORDER BY post_create DESC LIMIT $this->count_of_result";
			}
		}
		$tmp = mysql_query($sql);
		$fin = array();
		$i = 0;
		while($result = mysql_fetch_array($tmp, MYSQL_ASSOC))
		{
			$fin[$i]['id'] = $result[post_id];
			$fin[$i]['uid'] = $result[$i][post_uid];
			$fin[$i]['title'] = $result[post_title];
			$fin[$i]['create'] = $result[post_create];
			$fin[$i]['author'] = $result[post_author];
			$fin[$i]['content'] = $result[post_content];
			$fin[$i]['hits'] = $result[post_hits];
			$fin[$i]['reply'] = $result[post_reply];
			$fin[$i]['public'] = $result[post_public];
			$fin[$i]['desc'] = $result[post_desc];
			$fin[$i]['tags'] = $result[post_tags];
			$fin[$i]['lastmodify'] = $result[post_lastmodify];
			$i ++;
		}
		mysql_free_result($tmp);
		return $fin;
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM `walker_post` WHERE post_id = '$id'";

		$tmp = mysql_query($sql);
		$fin = array();
		$i = 0;
		while($result = mysql_fetch_array($tmp, MYSQL_ASSOC))
		{
			$fin[$i]['id'] = $result[post_id];
			$fin[$i]['uid'] = $result[$i][post_uid];
			$fin[$i]['title'] = $result[post_title];
			$fin[$i]['create'] = $result[post_create];
			$fin[$i]['author'] = $result[post_author];
			$fin[$i]['content'] = $result[post_content];
			$fin[$i]['hits'] = $result[post_hits];
			$fin[$i]['reply'] = $result[post_reply];
			$fin[$i]['public'] = $result[post_public];
			$fin[$i]['desc'] = $result[post_desc];
			$fin[$i]['tags'] = $result[post_tags];
			$fin[$i]['lastmodify'] = $result[post_lastmodify];
			$i ++;
		}
		mysql_free_result($tmp);
		return $fin;
	}

	public function getTopicList($private = false)
	{
		if($private == true)
		{
			$sql = "SELECT `post_id`, `post_title`, `post_create`, `post_public`, `post_tags`, `post_lastmodify` FROM `walker_post` ORDER BY post_create DESC";
		}
		else
		{
			$sql = "SELECT `post_id`, `post_title`, `post_create`, `post_public`, `post_tags`, `post_lastmodify` FROM `walker_post` WHERE post_public = '1' ORDER BY post_create DESC";
		}
		//echo $sql;

		$tmp = mysql_query($sql);
		$fin = array();
		$i = 0;
		while($result = mysql_fetch_array($tmp, MYSQL_ASSOC))
		{
			$fin[$i]['id'] = $result[post_id];
			$fin[$i]['title'] = $result[post_title];
			$fin[$i]['create'] = $result[post_create];
			$fin[$i]['public'] = $result[post_public];
			$fin[$i]['tags'] = $result[post_tags];
			$fin[$i]['lastmodify'] = $result[post_lastmodify];
			$i ++;
		}
		mysql_free_result($tmp);
		return $fin;
	}

	public function getRelated($tag)
	{
		if($tag != 'ALL' && is_string($tag))
		{
			$sql = "SELECT * FROM `walker_post` WHERE post_tags = '$tag' ORDER BY post_create DESC LIMIT $this->count_of_result";
		}
		else
		{
			$sql = "SELECT * FROM `walker_post` WHERE post_public = '1' ORDER BY post_create DESC LIMIT $this->count_of_result";
		}
		$tmp = mysql_query($sql);
		$fin = array();
		$i = 0;
		while($result = mysql_fetch_array($tmp, MYSQL_ASSOC))
		{
			$fin[$i]['id'] = $result[post_id];
			$fin[$i]['title'] = $result[post_title];
			$fin[$i]['create'] = $result[post_create];
			$fin[$i]['author'] = $result[post_author];
			$fin[$i]['tags'] = $result[post_tags];
			$fin[$i]['lastmodify'] = $result[post_lastmodify];
			$i ++;
		}
		mysql_free_result($tmp);
		return $fin;
	}

	public function asUbb()
	{
	}

	public function getReply($id)
	{
		$sql = "SELECT `reply_id`, `reply_user`, `reply_create`, `reply_content`, `reply_desc` FROM `walker_reply` WHERE reply_pid = '$id' ORDER BY reply_create";

		$tmp = mysql_query($sql);
		$fin = array();
		$i = 0;
		while($result = mysql_fetch_array($tmp, MYSQL_ASSOC))
		{
			$fin[$i]['id'] = $result[reply_id];
			$fin[$i]['create'] = $result[reply_create];
			$fin[$i]['author'] = $result[reply_user];
			$fin[$i]['content'] = $result[reply_content];
			$fin[$i]['desc'] = $result[reply_desc];
			$i ++;
		}
		mysql_free_result($tmp);
		return $fin;
	}

	public function getTopReply($id)
	{
		$sql = "SELECT `reply_id`, `reply_user`, `reply_create`, `reply_content`, `reply_desc` FROM `walker_reply` WHERE reply_pid = '$id' ORDER BY reply_create DESC LIMIT 1";
		$tmp = mysql_query($sql);
		$res = mysql_fetch_array($tmp, MYSQL_ASSOC);
		mysql_free_result($tmp);
		return $res;
	}

	public function __destruct()
	{
		mysql_close($this->db);
	}
}
?>

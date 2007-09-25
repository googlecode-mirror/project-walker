<?php
/** 
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Post.class.php 0 2007-09-21 18:05:59Z always.8 $
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
class Post
{
	private $id;
	private $title;
	private $author;
	private $content;
	private $reply = 1;
	private $tags;
	private $show = 1;
	private $created;
	private $modify;


	public function __construct()
	{
		/* Init Databases */
		$this->db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
			or die('Could not connect: ' . mysql_error());
		mysql_select_db(WALKER_DB_NAME);
		mysql_query('SET NAMES utf8');
		mysql_query('SET CHARACTER SET utf8');
		mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
		$this->modify = time();
		$this->created = $this->modify;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setReply($reply)
	{
		if($reply == '任何人都可以评论')
		{
			$this->reply = 1;
		}
		else if($reply == '禁止评论')
		{
			$this->reply = 0;
		}
	}

	public function setTags($tags)
	{
		$this->tags = $tags;
	}

	public function setShow($show)
	{
		if($show == '公开发布')
		{
			$this->show = 1;
		}
		elseif($show == '私有发布')
		{
			$this->show = 0;
		}

	}

	public function setCreated($created)
	{
		$this->created = $created;
	}

	public function setModify($modify)
	{
		$this->modify = $modify;
	}

	public function newTopic()
	{
		$sql = "INSERT INTO `walker_post` VALUES (NULL, 1, '$this->title', $this->created, '$this->author', '$this->content', 0, '$this->reply', '$this->show', '', '$this->tags', $this->modify)";
		if(mysql_query($sql))
		{
			return mysql_insert_id();
		}
		else
		{
			return false;
		}
	}

	public function Modify()
	{
		$sql = "UPDATE `walker_post` SET `post_title` = '$this->title',
			`post_create` = UNIX_TIMESTAMP('$this->created'), 
			`post_author` = '$this->author',
			`post_content` = '$this->content',
			`post_reply` = '$this->reply',
			`post_public` = '$this->show',
			`post_tags` = '$this->tags',
			`post_lastmodify` = '$this->modify' 
			WHERE post_id = $this->id";
		//echo $sql;
		if(mysql_query($sql))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function Reply($array)
	{
		$sql = "INSERT INTO `walker_reply` VALUES (NULL, '$array[pid]', '$array[user]', '$this->modify', '$array[content]', '$array[desc]', '$this->modify')";
		if(mysql_query($sql))
		{
			return mysql_insert_id();
		}
		else
		{
			return false;
		}
	}

	public function __destruct()
	{
		mysql_close($this->db);
	}
}
?>

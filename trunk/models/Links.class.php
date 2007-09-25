<?php
/** 
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Links.class.php 0 2007-09-14 17:19:45Z always.8 $
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

class Links{
	/**
	 * @access private
	 */
	private $datas;

	public function __construct($datas)
	{
		$this->datas = $datas;
	}

	public function output($shuffle = true, $count = 'ALL')
	{
		if(!$xml = simplexml_load_file($this->datas))
		{
			return false;
		}

		$link = array();
		$i = 0;
		foreach($xml->xpath('//item') as $node)
		{
			$link[$i]['title'] = strval($node->title);
			$link[$i]['url'] = strval($node->url);
			$link[$i]['color'] = strval($node->color);
			$link[$i]['img'] = strval($node->img);
			$link[$i]['description'] = strval($node->description);
			$i++;
		}
		/* Shuffle mode */
		if($shuffle == true)
		{
			shuffle($link);
		}

		if($count != 'ALL' && is_int($count))
		{
			/* Results of the $count restrictions */
			array_splice($link, $count);
		}
		return $link;
	}
}
?>

<?php
/** 
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Flickr.class.php 0 2007-09-12 12:18:34Z always.8 $
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

class Flickr{
	public static function output($xml, $shulffle = true, $count = 7)
	{
		if(!$xml = simplexml_load_file($xml))
		{
			return false;
		}

		$flickr = array();
		$i = 0;
		foreach($xml->xpath('//item') as $node)
		{
			$flickr[$i]['name'] = strval($node->name);
			$flickr[$i]['url'] = strval($node->url);
			$flickr[$i]['description'] = strval($node->description);
			$flickr[$i]['link'] = strval($node->link);
			$i++;
		}
		/* Shuffle mode */
		if($shulffle == true)
		{
			shuffle($flickr);
		}
		/* Results of the $count restrictions */
		array_splice($flickr, $count);
		return $flickr;
	}
}
?>

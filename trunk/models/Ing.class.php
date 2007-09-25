<?php
/** 
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Ing.class.php 0 2007-09-12 12:20:36Z always.8 $
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
class Ing
{
	public $datas = 'schema/Ing.xml';
	public $xml_url = 'http://www.v2ex.com/feed/ing/%CE%BE%E5%91%BD%E4%BB%A4%E6%8F%90%E7%A4%BA%E7%AC%A6';

	/**
	 * @access private
	 * @return string $ing_from_v2ex V2EX::Ing Feed datas
	 */
	private function fromV2EX()
	{
		$fp = fopen($this->xml_url, 'rb');
		$ing_from_v2ex = stream_get_contents($fp);
		fclose($fp);
		return $ing_from_v2ex;
	}

	public function output($source = 'LOCAL', $count = 10)
	{
		if($source == 'LOCAL')//Read datas from 'schema/Ing.xml'
		{
			if(!$xml = simplexml_load_file($this->datas))
			{
				return false;
			}
		}
		elseif($source == 'V2EX')//Read datas from V2EX
		{
			if(!$xml = simplexml_load_string($this->fromV2EX()))
			{
				return false;
			}
		}

		$ing = array();
		$i = 0;
		foreach($xml->xpath('//item') as $node)
		{
			$description = strval($node->description);
			$ing[$i]['title'] = strval($node->title);
			$ing[$i]['link'] = strval($node->link);
			$ing[$i]['img'] = $this->getImgUrl($description);
			$ing[$i]['posted'] = $this->getPostTime($description);
			$i++;
		}

		/* Results of the $count restrictions */
		array_splice($ing, $count);
		return $ing;
	}

	private function getImgUrl($description)
	{
		if(preg_match('/src="(.*?)"/i', $description, $capture))
		{
			return 'http://www.v2ex.com' .$capture[1];
		}
		else
		{
			return false;
		}
	}

	private function getPostTime($description)
	{
		if(preg_match('/&nbsp;(.*?)\-(.*)/i', $description, $capture))
		{
			$post = $capture[2];
			$post = str_replace('days', '天', $post);
			$post = str_replace('hours', '小时', $post);
			$post = str_replace('mins', '分钟', $post);
			$post = str_replace('secs', '秒', $post);
			$post = str_replace(' ago', '前', $post);
			return $post;
		}
		else
		{
			return false;
		}
	}
}
?>


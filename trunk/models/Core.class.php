<?php
/** 
 * Core.class.php
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
 * @version $Id: Core.class.php 0 2007-09-25 12:38:09Z always.8 $
 * @copyright http://www.n7money.cn/
 * @package Core
 */
require_once '../config.php';
require_once 'Flickr.class.php';
require_once 'Ing.class.php';
require_once 'Links.class.php';
require_once 'Post.class.php';
require_once 'Show.class.php';
require_once 'Tags.class.php';
require_once 'utils.php';

class Core
{
	public function __construct()
	{
	}

	public function header($title)
	{
		echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' . "\n";
		echo 'http://www.w3.org/TR/xhtml/DTD/xhtml-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
		echo '<head>' . "\n";
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\n";
		echo '<link href="/themes/' . THEMES . '/images/favicon.ico" rel="shortcut icon" />' . "\n";
		echo '<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 RSS" href="http://www.n7money.cn/feed/walker.rss" />' . "\n";
		echo '<link rel="stylesheet" type="text/css" href="/themes/' . THEMES . '/styles/style.css" />' . "\n";
		echo '<link rel="stylesheet" type="text/css" href="/themes/' . THEMES . '/styles/extra.css" />' . "\n";
		echo '<script type"text/javascript" src="/themes/' . THEMES . '/scripts/prototype.js"></script>';
		echo '<script type"text/javascript" src="/themes/' . THEMES . '/scripts/scriptaculous.js?load=effects,dragdrop"></script>';
		echo '<title>' . $title . '</title>' . "\n";
		echo '</head>' . "\n";
		echo '<body>' . "\n";
	}

	public function footer()
	{
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}
}
?>


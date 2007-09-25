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
 * @version $Id: test.php 0 2007-09-22 01:11:52Z always.8 $
 * @copyright http://www.n7money.cn/
 * @package 
 */
require_once 'Show.class.php';
require_once '../config.php';

$show = new Show($db);
$tmp = $show->getTopReply(73);
print_r($tmp);
?>


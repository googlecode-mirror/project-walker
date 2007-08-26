<?php
/* Project Walker
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: utils.php 0 2007-06-24 09:10:15Z always.8 $
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

function make_descriptive_time($unix_timestamp)
{
	$now = intval(time());
	echo strftime('%Y-%m-%d %H:%M:%S', $now) . "\n";
	$diff = $now - $unix_timestamp;
	
	if ($diff > (86400 * 30)) {
		$m_span = intval($diff / (86400 * 30));
		$d_diff = $diff % ($m_span * (86400 * 30));
		if ($d_diff > 86400) {
			$d_span = intval($d_diff / 86400);
			return $m_span . ' 月 ' . $d_span . ' 天前';
		} else {
			return $m_span . ' 月前';
		}
	}
	
	if ($diff > 86400) {
		$d_span = intval($diff / 86400);
		$h_diff = $diff % 86400;
		if ($h_diff > 3600) {
			$h_span = intval($h_diff / 3600);
			return $d_span . ' 天 ' . $h_span . ' 小时前';
		} else {
			return $d_span . ' 天前';
		}
	}
	
	if ($diff > 3600) {
		$h_span = intval($diff / 3600);
		$m_diff = $diff % 3600;
		if ($m_diff > 60) {
			$m_span = intval($m_diff / 60);
			return $h_span . ' 小时 ' . $m_span . ' 分钟前';
		} else {
			return $h_span . ' 小时前';
		}
	}
	
	if ($diff > 60) {
		$span = floor($diff / 60);
		$secs = $diff % 60;
		if ($secs > 0) {
			return $span . ' 分 ' . $secs . ' 秒前';
		} else {
			return $span . ' 分钟前';
		}
	}
	
	return $diff . ' 秒前';
}
?>

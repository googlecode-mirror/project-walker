<?php
/* Project Walker
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: config.php 0 2007-06-24 09:10:15Z always.8 $
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

define('WALKER_DB_HOST', 'localhost');
define('WALKER_DB_PORT', 3306);
define('WALKER_DB_USERNAME', 'console_zhao');
define('WALKER_DB_PASSWORD', 'lampo1.3.31');
define('WALKER_DB_NAME', 'console_walker');

define('GOOGLE_AD', false);

define('WALKER_PREFIX', '/home/console');
define('HTDOCS', WALKER_PREFIX . '/domains/consolezhao.host5.meyu.net/public_html');
define('TIME_ZONE', 'Asia/Shanghai');
define('TEMPLATE_DIR', HTDOCS . '/views/');
define('COMPILE_DIR', HTDOCS . '/tmp/templates_c/');
define('CONFIG_DIR', HTDOCS . '/tmp/configs/');
define('CACHE_DIR', HTDOCS . '/tmp/cache/');
?>

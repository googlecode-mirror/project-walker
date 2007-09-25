<?php
/**
 * Project Walker
 *
 * Walker global configuration file
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
 *
 * @autohr Walkin <console_zhao@163.com>
 * @version $Id: config.php 0 2007-09-13 16:50:17Z always.8 $
 * @copyright http://www.n7money.cn/
 */

/* Database args */
define('WALKER_DB_HOST', 'localhost');
define('WALKER_DB_PORT', 3306);
define('WALKER_DB_USERNAME', 'console_zhao');
define('WALKER_DB_PASSWORD', 'lampo1.3.31');
define('WALKER_DB_NAME', 'console_walker');

/* Domain name */
define('DOMAIN_NAME', 'http://www.n7money.cn/');

/* Google AdSense */
define('GOOGLE_AD', false);

/* Default language */
define('LANG', 'zh_CN');

/* Default Themes */
define('THEMES', 'X');

/* Flickr, Ing cache lifetime */
define('LIFETIME', '1');

/* Content cache lifetime */
define('LIFETIME_OF_CONTET', 1);

/* Number 5 articles */
define('DISPLAY_OF_PAGE', 8);

/* Results for the 10 feed restrictions */
define('COUNT_OF_FEED', 10);

/* Results for the 10 related restrictions */
define('COUNT_OF_RELATED', 10);

/* Walker path */
define('WALKER_PREFIX', '/home/console');
define('HTDOCS', WALKER_PREFIX . '/domains/consolezhao.host5.meyu.net/public_html');

/* Default Time Zone */
define('TIME_ZONE', 'Asia/Shanghai');

/* Views Settings */
define('TEMPLATE_DIR', HTDOCS . '/themes/' . THEMES . '/');
define('COMPILE_DIR', HTDOCS . '/tmp/templates_c/');
define('CONFIG_DIR', HTDOCS . '/tmp/configs/');
define('CACHE_DIR', HTDOCS . '/tmp/cache/');
?>

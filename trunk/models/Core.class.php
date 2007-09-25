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
 * @version $Id: Core.class.php 0 2007-09-25 13:45:16Z always.8 $
 * @copyright http://www.n7money.cn/
 * @package Core
 */

ini_set('include_path', '../:'. ini_get('include_path'));
ini_set('include_path', '../libs/ZendFramework-0.9.3-Beta:'. ini_get('include_path'));
require_once 'config.php';
require_once 'models/Flickr.class.php';
require_once 'models/Ing.class.php';
require_once 'models/Links.class.php';
require_once 'models/Post.class.php';
require_once 'models/Show.class.php';
require_once 'models/Tags.class.php';
require_once 'models/utils.php';
require_once 'Zend/Cache.php';

class Core
{
	public function __construct()
	{
	}

	public function Meta()
	{
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\n";
	}

	public function Link()
	{
		echo '<link href="/themes/' . THEMES . '/images/favicon.ico" rel="shortcut icon" />' . "\n";
		echo '<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 RSS" href="http://www.n7money.cn/feed/walker.rss" />' . "\n";
		echo '<link rel="stylesheet" type="text/css" href="/themes/' . THEMES . '/styles/style.css" />' . "\n";
		echo '<link rel="stylesheet" type="text/css" href="/themes/' . THEMES . '/styles/extra.css" />' . "\n";
		echo '<script type"text/javascript" src="/themes/' . THEMES . '/scripts/prototype.js"></script>' . "\n";
		echo '<script type"text/javascript" src="/themes/' . THEMES . '/scripts/scriptaculous.js?load=effects,dragdrop"></script>' . "\n";
	}

	public function Title()
	{
		echo '<title>' . $title . '</title>' . "\n";
	}

	public function Head($title)
	{
		echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' . "\n";
		echo 'http://www.w3.org/TR/xhtml/DTD/xhtml-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
		echo '<head>' . "\n";
		$this->Meta();
		$this->Link();
		$this->Title();
		echo '</head>' . "\n";
		echo '<body>' . "\n";
	}

	public function Flickr($datas)
	{
		$flickr Flickr::output($datas);

		echo '<div id="flickr" class="blank" style="height:160px;">' . "\n";
		echo '<img src="/themes/{$themes}/images/flickr_logo.gif" alt="" style="border:0px; position:relative; top:5px;" />' . "\n";
		echo '<span style="color:#577DE7;">[root@localhost ~]ls *.jpg *.gif *.png</span>' . "\n";
		echo '<br /><br />' . "\n";
		echo '<ul>' . "\n";

		for($i = 0; $i < count($flickr); $i ++)
		{
			echo '<li><a href="' . $flickr[$i][link] .'" target="_blank"><span>' . $flickr[$i][name] . '</span><img src="'
				. $flickr[$i][url] . '" alt="" />' . $flickr[$i][description] . '</a></li>' . "\n";
		}

		echo '</ul>' . "\n";
		echo '</div><!-- flickr end -->' . "\n";
	}

	public function Ing($datas)
	{
		echo '<div id="ing" class="blank">' . "\n";
		echo '<img src="/themes/{$themes}/images/hourglass.png" alt="" style="position:relative; top:3px;" />' . "\n";
		echo '<span style="color:#577DE7;">&nbsp;[root@localhost ~]# history</span>' . "\n";
		echo '<div style="height:10px; overflow:hidden;"></div>' . "\n";
		echo '<ul class="ing">' . "\n";

		for($i = 0; $ < count($ing); $i ++)
		{
			$ing = new Ing;
			$list = $ing->output('LOCAL');

			echo '<li><img src="' . $ing[$i][img] . '" alt="" />&nbsp;&nbsp;<a style="color:' . rand_color() . '"  class="var" href="'
				. $ing[$i][link] . '" target="_blank">' . $ing[$i][title] . '</a>&nbsp;&nbsp;<span class="post_time">...' 
				. $ing[$i][posted] . '</span></li>' . "\n";
		}

		echo '</ul>' . "\n";
		echo '</div><!-- ing end -->' . "\n";
	}

	public function Stock()
	{
	}

	public function Topnav()
	{
		echo '<div id="topnav" class="blank">' . "\n";
		echo '<img src="/themes/{$themes}/images/house.png" alt="" />' . "\n";
		echo '<span>' . "\n";
		echo '<a href="{$dns}index.html">[root@localhost ~]#</a>' . "\n";
		echo '{if $topic_id}' . "\n";
		echo 'cat&nbsp;<a href="{$dns}view/{$topic_id}.html">{$topic_name}.html</a>' . "\n";
		echo '{elseif $tags_name}' . "\n";
		echo 'cat *.html | grep "<a href="{$dns}tags/{$tags_name}.html">{$tags_name}</a>"' . "\n";
		echo '{/if}' . "\n";
		echo '' . "\n";
		echo '{if $smarty.server.REQUEST_URI == '/manage.html'}' . "\n";
		echo 'ls -al' . "\n";
		echo '{/if}' . "\n";
		echo '' . "\n";
		echo '{if $smarty.server.REQUEST_URI|regex_replace:"/\/\d+\.html/":"" == '/edit'}' . "\n";
		echo '{*&gt;&nbsp;<a href="{$dns}manage.html">日志管理</a>*}' . "\n";
		echo 'vim&nbsp;{$smarty.server.REQUEST_URI|replace:"/edit/":""}' . "\n";
		echo '{/if}' . "\n";
		echo '' . "\n";
		echo '{if $smarty.server.REQUEST_URI == '/post.html'}' . "\n";
		echo '{*&gt;&nbsp;<a href="{$dns}manage.html">日志管理</a>*}' . "\n";
		echo 'vim' . "\n";
		echo '{/if}' . "\n";
		echo '</span>' . "\n";
		echo '</div>' . "\n";
	}

	public function Sidebar()
	{
		echo '<div id="sidebar">' . "\n";
		echo '<div class="blank">' . "\n";
		echo '<ul class="tools">' . "\n";
		echo '<li><span>&nbsp;当前用户：{$smarty.session.user}</span></li>' . "\n";
		echo '<li><img src="/themes/{$themes}/images/zoom.png" alt="" /><a href="{$dns}search.html">&nbsp;搜索</a></li>' . "\n";
		echo '<li><img src="/themes/{$themes}/images/feed.png" alt="" /><a href="{$dns}feed/walker.rss">&nbsp;RSS种子输出</a></li>' . "\n";
		echo '<li><img src="/themes/{$themes}/images/help.png" alt="" /><a href="{$dns}help.html">&nbsp;帮助</a></li>' . "\n";
		echo '{if $smarty.session.user == 'guest'}' . "\n";
		echo '<li><img src="/themes/{$themes}/images/key.png" alt="" /><a href="{$dns}login.html">&nbsp;登陆</a></li>' . "\n";
		echo '{else}' . "\n";
		echo '<li><img src="/themes/{$themes}/images/key_go.png" alt="" /><a href="{$dns}logout.html">&nbsp;登出</a></li>' . "\n";
		echo '<li><img src="/themes/{$themes}/images/application_osx_terminal.png" alt="" /><a href="{$dns}manage.html">&nbsp;控制台</a></li>' . "\n";
		echo '{/if}' . "\n";
		echo '<li><img src="/themes/{$themes}/images/music.png" alt="" /><span>&nbsp;最近&nbsp;Top</span>' . "\n";
		echo '<ul class="music">' . "\n";
		echo '<li><a href="#">All for you</a></li>' . "\n";
		echo '<li><a href="#">Alive</a></li>' . "\n";
		echo '<li><a href="#">Four Seasons</a></li>' . "\n";
		echo '<li><a href="#">Given Up</a></li>' . "\n";
		echo '</ul></li>' . "\n";
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
		echo '' . "\n";
		echo '<div class="blank">' . "\n";
		echo '<img src="/themes/{$themes}/images/page_white_code.png" alt="" />' . "\n";
		echo '<span style="line-height:160%;">Tags</span>' . "\n";
		echo '<ul class="tags">' . "\n";
		echo '{section name=i loop=$tag}' . "\n";
		echo '<li><a href="{$dns}tags/{$tag[i].tags}.html">{$tag[i].tags}&nbsp;({$tag[i].count})</a></li>' . "\n";
		echo '{/section}' . "\n";
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
		echo '' . "\n";
		echo '<div class="blank">' . "\n";
		echo '<img src="/themes/{$themes}/images/world_link.png" alt="" /><span>&nbsp;链接</span>' . "\n";
		echo '<ul class="links">' . "\n";
		echo '{section name=i loop=$links}' . "\n";
		echo '<li><a {if $links[i].color} class="var" style="color:{$links[i].color|default:"#577DE7"};"{/if} href="{$links[i].url}" target="_blank">{$links[i].title}</a></li>' . "\n";
		echo '{/section}' . "\n";
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
		echo '</div><!-- sidebar end -->' . "\n";
	}

	public function Login()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 TRANSITIONAL//EN"' . "\n";
		echo '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">' . "\n";
		echo '<head>' . "\n";
		echo '<meta http-equiv="content-type" content="text/html;charset=UTF-8" />' . "\n";
		echo '<title>ξ命令提示符</title>' . "\n";
		echo '<link href="/themes/{$themes}/styles/login.css" media="screen" rel="stylesheet" type="text/css" />' . "\n";
		echo '</head>' . "\n";
		echo '<body onload="document.forms[0].elements[0].focus();">' . "\n";
		echo '<div id="main" align="center">' . "\n";
		echo '<div id="v2ex" align="left">' . "\n";
		echo '<div class="title">登录</div>' . "\n";
		echo '<hr size="1" color="#EEE" style="color: #EEE; background-color: #EEE; height: 1px; border: 0;" />		<table width="100%" cellpadding="5" cellspacing="0" class="login_form_t">' . "\n";
		echo '<form action="/login.php" method="post">' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80" align="right">用户名:</td>' . "\n";
		echo '<td align="left"><input name="username" type="text" class="line" onfocus="this.style.borderColor = '#0C0'; this.style.backgroundColor = '#FFF';" onblur="this.style.borderColor = '#999'; this.style.backgroundColor = '#F5F5F5';" maxlength="100" /></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80" align="right">密码:</td>' . "\n";
		echo '<td align="left"><input name="password" type="password" class="line" onfocus="this.style.borderColor = '#0C0'; this.style.backgroundColor = '#FFF';" onblur="this.style.borderColor = '#999'; this.style.backgroundColor = '#F5F5F5';" maxlength="32" /></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80"></td>' . "\n";
		echo '<td align="left"><span class="tip"><a href="/passwd.html">我忘记了密码</a> &nbsp;|&nbsp; <a href="/signup.html">注册</a> &nbsp;|&nbsp; <a href="/">游客</a></span></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80"></td>' . "\n";
		echo '<td valign="middle"><input type="image" src="/themes/{$themes}/images/login.gif" alt="登录" /></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<input type="hidden" value="http://www.n7money.cn/" name="return" />			</form>' . "\n";
		echo '</table>' . "\n";
		echo '</div>	' . "\n";
		echo '<div id="bottom" align="center">' . "\n";
		echo '&copy; 2006-2007 <a href="http://www.n7money.cn/" target="_self">V2EX</a>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}

	public function Logout()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 TRANSITIONAL//EN"' . "\n";
		echo '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">' . "\n";
		echo '<head>' . "\n";
		echo '<meta http-equiv="content-type" content="text/html;charset=UTF-8" />' . "\n";
		echo '<title>ξ命令提示符</title>' . "\n";
		echo '<link href="/themes/{$themes}/styles/login.css" media="screen" rel="stylesheet" type="text/css" />' . "\n";
		echo '</head>' . "\n";
		echo '<body>' . "\n";
		echo '<div id="main" align="center">' . "\n";
		echo '<div id="v2ex" align="left">' . "\n";
		echo '<div class="title">你已经从 ξ命令提示符 登出</div>' . "\n";
		echo '<hr size="1" color="#EEE" style="color: #EEE; background-color: #EEE; height: 1px; border: 0;" />		<div id="logout">' . "\n";
		echo '<p>没有任何个人信息被留在你现在使用过的计算机上，请对你的隐私放心。</p>' . "\n";
		echo '<p>ξ命令提示符 欢迎你随时再度访问！</p>' . "\n";
		echo '<p>' . "\n";
		echo '<li><a href="/login.html">重新登录</a></li>' . "\n";
		echo '<li><a href="/index.html">返回 ξ命令提示符 首页</a></li>' . "\n";
		echo '<li><a href="/new_features.html" target="_blank">新功能</a></li>' . "\n";
		echo '<li><a href="/help.html" target="_blank">帮助</a> <!--<img src="/themes/{$themes}/images/ext.png" align="absmiddle" />--></li>' . "\n";
		echo '</p>' . "\n";
		echo '</div>' . "\n";
		echo '</div>	' . "\n";
		echo '<div id="bottom" align="center">' . "\n";
		echo '&copy; 2006-2007 <a href="http://www.n7money.cn/" target="_self">ξ命令提示符</a>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}

	public function Footer()
	{
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}
}
?>


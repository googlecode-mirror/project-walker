<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="favicon.ico" rel="shortcut icon" />
		<link rel="stylesheet" type="text/css" href="/styles/{$style|default:"style.css"}" />
		<link rel="stylesheet" type="text/css" href="/styles/extend.css" />
		<link rel="stylesheet" type="text/css" href="/styles/ifm.css" />
		<title>ξ命令提示符</title>
	</head>

	<body style="max-width:1024px;">
		<div id="header">
			<img alt="" src="/images/logo.png" />
			<!--<span id="toolbar"><a href="#">注册</a></span>-->
		</div>

		<div id="wrap">

			<div id="topnav" class="blank">
				<span id="feture">Walkin SPECIAL FETURES</span>
				<span id="tag" class="underline">
					<img class="reposit" alt="" src="/images/report.png">&nbsp;
					<span class="bold">参考手册：</span>
					<a href="http://www.phpchina.com/manual/apache/" target="_blank">Apache</a> |
					<a href="http://dev.mysql.com/doc/refman/5.1/zh/index.html" target="_blank">MySQL</a> |
					<a href="http://www.php.net/manual/zh/" target="_blank">PHP</a> |
					<a href="http://www.phpchina.com/manual/pear/" target="_blank">Pear</a> |
					<a href="http://www.phpchina.com/manual/smarty/" target="_blank">Smarty</a> | 
					<a href="http://framework.zend.com/manual/zh/index.html" target="_blank">ZendFramework</a> | 
					<a href="http://doc.51windows.net/css2/" target="_blank">CSS</a>
				</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://www.caibangzi.com/user/console_zhao" target="_blank">我的财帮子</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://www.v2ex.com/u/%CE%BE%E5%91%BD%E4%BB%A4%E6%8F%90%E7%A4%BA%E7%AC%A6" target="_blank">我的V2EX主页</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://mail.google.com" target="_blank">我的Gmail</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://www.cmbchina.com" target="_blank">招商银行</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://palary.org/" target="_blank">Palary代理</a>...</span>
			</div>

			<div id="main" class="blank">
				<div id="mainbar">
					<span class="ban"><img alt="Home" src="/images/house.png" /></span>
					<span style="{if $smarty.session.browser}width:675px;{else}width:678px;{/if}" class="ban">会花钱的人才会挣钱</span>
					<span id="feed" class="ban">
						<a class="img" href="/feed/walker.rss"><img alt="RSS" src="/images/feed.png" /></a>
					</span><br />
					<span class="underline" style="margin-top:6px;"></span>
				</div>
				<br /><br />

				<div id="content">
				    <img style="position:relative; top:2px;" src="/images/page_white_star.png" alt="" />
				    <h1 class="ititle">{$content.title}</h1> 
				    <span class="tip_i">... by {$content.author}... At {$content.create|date_format:" %d, %b %H:%M"} ... {$content.hits} 次点击 </span>
				    {$content.contents}
				</div>

				<div style="clear:both; height:5px; width:625px;"></div>

				<div class="link" style="clear:both; width:625px;">
					<strong class="p_cur" href="#">1</strong>
					<a class="p" href="#">2</a>
					<a class="p" href="#">3</a>
					<a class="p_edge" href="#">10</a>
					<strong class="p_info">14 ITEMS / 30 PER PAGE</strong>
					<div class="rebuild"></div>
				</div>
				<br />
			</div>

			<div id="sidebar">
			    <div id="about" class="blank">
				    <span class="sidebarTitle">About me</span>
				    <img alt="ξ命令提示符" src="/images/me.jpg" />
					<br /><span style="margin-left:35px;">ξ命令提示符</span>
					<br /><a href="about.html" style="margin:8px;">
					    凌乱的住处，嗜酒，不只一台电脑，无线网络覆盖...
					</a>
			    </div>

				<div id="tags" class="blank">
					<img alt="" src="/images/page_white_code.png" />
					<span>&nbsp;Tags</span>
					<span class="bom"></span>
					<ul class="nav">
						<li><a href="/tags/LAMP">LAMP</a></li>
						<li><a href="/tags/%C9%E8%BC%C6">设计</a></li>
						<li><a href="/tags/%CD%B6%D7%CA%D3%EB%C0%ED%B2%C6">投资与理财</a></li>
						<li><a href="/tags/%CA%B1%C9%D0%CF%FB%B7%D1">时尚消费</a></li>
						<li><a href="/tags/%C2%D2%C6%DF%B0%CB%D4%E3">乱七八糟</a></li>
						<li><a href="/tags/%CE%D2%B5%C4%D2%F4%C0%D6">我的音乐</a></li>
						<li><a href="/tags/About me">About me</a></li>
					</ul>
				</div>

				<div id="date" class="blank">
					<img alt="" src="/images/drive_disk.png" />
					<span>&nbsp;存档</span>
					<span class="bom"></span>
					<ul class="nav">
						<li><a href="/date/9.html">一月</a><small>(10)</small></li>
						<li><a href="/date/10.html">二月</a><small>(10)</small></li>
						<li><a href="/date/11.html">三月</a><small>(10)</small></li>
						<li><a href="/date/9.html">四月</a><small>(10)</small></li>
						<li><a href="/date/9.html">五月</a><small>(10)</small></li>
					</ul>
				</div>

				<div id="favorite" class="blank">
					<img alt="" src="/images/star.png" />
					<a href="/favorite.html">我的收藏夹</a>
				</div>

				<div id="meta" class="blank">
					<ul class="menu">
						<li><img alt="" src="/images/zoom.png" /><a href="/search.html">&nbsp;搜索</a></li>
						<li><img alt="" src="/images/feed.png" /><a href="/feed/walker.rss">&nbsp;RSS种子输出</a></li>
						<li><img alt="" src="/images/coins.png" /><a href="/invest.html">&nbsp;投资与理财</a></li>
                        {if $smarty.session.user != "guest"}
						<li><img alt="" src="/images/terminal.png" /><a href="/manage.html">&nbsp;管理</a></li>
						<li><img alt="" src="/images/key_go.png" /><a href="/logout.html">&nbsp;登出</a></li>
                        {elseif $smarty.session.user == "guest"}
						<li><img alt="" src="/images/key.png" /><a href="/login.html">&nbsp;登录</a></li>
                        {/if}
						<li><img alt="" src="/images/page_link.png" /><span>&nbsp;链接</span>
						<ul class="nav">
							<li><a href="http://silentstar.cn/">silentstar.cn</a></li>
							<li><a href="#">link2</a></li>
							<li><a href="#">link3</a></li>
							<li><a href="#">link4</a></li>
						</ul>
						</li>
						<li><img alt="" src="/images/cog_go.png" /><a href="/about.html">&nbsp;关于Walker</a></li>
					</ul>
					<a target="_blank" href="http://www.mozilla.com/"><img style="border:0;"class="img" alt="firefox" src="/images/firefox.gif" /></a>
				</div>
				<div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
			</div>

		<div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>

		<div id="footer" class="blank">
			<span class="gray">Project Walker | Copyright (C) 2007-2010 ξ命令提示符 &lt;console_zhao@163.com&gt;
		</div>
	</body>
</html>

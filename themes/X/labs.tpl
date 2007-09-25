<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
{config_load file="my.conf"}
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="/themes/{$themes}/images/favicon.ico" rel="shortcut icon" />
		<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 RSS" href="http://www.n7money.cn/feed/walker.rss" />
		<link rel="stylesheet" type="text/css" href="/themes/{$themes}/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/themes/{$themes}/styles/extra.css" />
		<title>ξ命令提示符 - Project-Walker Labs</title>
	</head>
	<body>
		<div id="header">
			<img id="logo" src="/themes/{$themes}/images/logo.png" alt="" />
			<div id="ititle">
				<span style="font-size:12px; color:#fff;">{#subHeadding#}</span>
			</div>
		</div>

		<div id="wrap">
			<div id="main">
				{include file="topnav.tpl"}

				<div id="rules" class="blank">
				<h3>Project-Walker Labs</h3>
					<div class="header">
					<img align="absmiddle" src="/themes/{$themes}/images/tick.png"/>&nbsp;Project-Walker</div>
					<br />
					<a href="http://code.google.com/p/project-walker/">Project-Walker</a> 是一个完全按照自己的意愿开发的博客程序，遵循 GPL 协议，任何人可以修改和再发布，这个程序源于一个 <a href="http://www.v2ex.com/" target="_blank">V2EX</a> 会员的想法。继承了 <a href="http://www.v2ex.com/" target="_blank">V2EX</a> 简洁的界面风格，构建与 <a href="http://www.php.net/" target="_blank">PHP</a>5，<a href="http://www.mysql.com/" target="_blank">MySQL</a>5，<a href="http://httpd.apache.org/" target="_blank">Apache</a>2，mod_rewrite 环境之上，同时使用了 Ajax，另外使用了 <a href="http://framework.zend.com/" target="_blank">ZendFramework</a> 的 Cache 模块以及 <a href="http://smarty.php.net/" target="_blank">Smarty</a> 模板技术。<br /><br />
					到目前为止，基本功能已经完成，并兼容大多数浏览器。
					<br /><br />
					<div class="header">
					<img align="absmiddle" src="/themes/{$themes}/images/basket_put.png"/>&nbsp;获得源代码</div>
					<br />
					本程序遵循 GPL 协议，但是并不会提供安装包，当然没有安装程序，本程序只提供给那些有兴趣的人，源代码可以从 Google 上获得：<br />
					svn co http://project-walker.googlecode.com/svn/trunk/ project-walker
					<br /><br />
					联系作者：<a href="mailto:always.8@gmail.com">always.8@gmail.com</a>
				</div>
			</div><!-- main end -->

			{* Sidebar *}
			{include file="sidebar.tpl"}

			<div class="bug"></div>
		</div><!-- wrap end -->

		{* footer *}
		{include file="footer.tpl"}
	</body>
</html>

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
		<title>ξ命令提示符 - About</title>
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

				<div id="content" class="blank">
					<h3><a class="var" style="color:#006699;" href="{$dns}view/.html">关于这个项目</a></h3>
					<span class="gray">Posted by <a class="var" style="color:#993399;" href="http://www.v2ex.com/u/" target="_blank">ξ命令提示符</a> on 2007-09-21 02:22 CST</span>
					<br /><br />
					<a href="http://code.google.com/p/project-walker/" rel="nofollow external" class="tpc" target="_blank">Project-Walker</a>，起源于一个非常有意思的社区 -- <a href="http://www.v2ex.com/" rel="nofollow external" class="tpc" target="_blank">V2EX</a>。<br />

					<br />
					V2EX 代表着一种生活态度：way too extreme，way to explore。V2EX 是一个面向那些充满好奇心，有着不寻常生活态度的年轻人的社区。社区中汇聚了大量的技术相关的 geek 话题，经过从 2006 年 3 月至今的发展，V2EX 已经是目前中国大陆最大的 geek 话题社区。<br />
					<br />
					Project-Walker 是一个遵循 GPL 协议的个人博客程序。到目前位置已完成基本功能，这个程序不是为一般的博客用户，而是为自己定制的，自己不想用现有的任何博客程序，同时非常喜欢 <a href="http://www.v2ex.com/" rel="nofollow external" class="tpc" target="_blank">V2EX</a> 的 简洁的设计，从而有了这么一个想法，一个风格类似 <a href="http://www.v2ex.com/" rel="nofollow external" class="tpc" target="_blank">V2EX</a> 的博客。Project-Walker 这个名称没有任何含义，纯粹是喜欢 walker 这个单词而已。<br />
					<br />
					Project-Walker 的 UI 和代码以及架构很多地方源于 <a href="http://www.v2ex.com/" rel="nofollow external" class="tpc" target="_blank">V2EX</a>，这也是遵循自由软件的精神，在此向 <a href="http://www.livid.cn/" rel="nofollow external" class="tpc" target="_blank">Livid</a> 致敬。<br />

					<br />
					程序简介：<br />
					采用PHP5，MySQL5，Apache2，mod_rewrite 构建，使用了 ZendFramework 的 Cache 模块和 Smarty 模板技术，并使用了 Ajax，兼容大多数浏览器。<br />
					<br />
					程序代码可以通过 SVN 从 Google 上获得：<br />
					svn co http://project-walker.googlecode.com/svn/trunk/ project-walker<br />
					<br />
					ξ命令提示符，V2EX 第 1833 号会员，2006 年 9 月 8 号来到这个社区。<br />
					姓名：赵京松<br />
					英文名：Jinsong Chioa（由中文直译）<br />

					星座：狮子座 （1987-08-08）<br />
					常住城市：成都（一个来了就不想走的地方）<br />
					E-mail：<a class="tpc" href="mailto:always.8@gmail.com">always.8@gmail.com</a><br />
					<br />
					一个自认为跟别人不一样的社会叛逆者，对中国的教育以及一些传统庸俗的东西毫无兴趣，痴迷于计算机与视觉摇滚（X-Japan）一类的音乐。<br />
					<br />
					正如标题上所说的：<br />
					凌乱的住处，嗜酒，不只一台电脑，无线网络覆盖，坐在马桶上用PDA 读RSS，没有女朋友，有自己极其痴迷的事物，对任何工作没有任何热情，不向往什么社会认同感，内心敏感，与父母关系紧张却又疏离，手淫，自言自语，喜欢听视觉摇滚和Hip-Hop一类的日本音乐．<br />
					<br />
					Thanks to <a href="http://www.livid.cn/" rel="nofollow external" class="tpc" target="_blank">Livid</a>!
					<br /><br />
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

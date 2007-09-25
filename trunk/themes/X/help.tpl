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
					<h3><a class="var" style="color:#006699;" href="{$dns}view/.html">关于这个网站</a></h3>
					<span class="gray">Posted by <a class="var" style="color:#993399;" href="http://www.v2ex.com/u/" target="_blank">ξ命令提示符</a> on 2007-09-21 02:22 CST</span>
					<br /><br />
					这是一个基于 Project-Walker 构建的博客，与传统的博客程序不同，不提供任何编辑相关的按钮及控件。<br />

					支持 UBB 以及纯文本评论及留言。<br />
					<br />
					1.超链接：&#91;url=http://www.link.com/&#93;文本&#91;/url&#93;<br />
					<br />
					2.图片：&#91;img&#93;http://www.link.com/exapmle.jpg&#91;/img&#93;<br />

					<br />
					3.E-mail：&#91;email&#93;always.8@gmail.com&#91;/email&#93;<br />
					<br />
					4.Flash：&#91;media,width,height&#93;http://www.link.com/exapmle.swf&#91;/media&#93;<br />
					<br />
					5.文字：&#91;b&#93;粗体&#91;/b&#93;，&#91;i&#93;斜体&#91;/i&#93;<br />

					<br />
					<br />
					备注：width 为对象宽度，height 为对象高度。<br />
					UBB 标记和 HTML 标记不能混合使用。<br />
					UBB 标记是大小写无关的，[URL] 或 [url]具有相同的效果。<br />
					UBB 标记不支持嵌套。<br />
					UBB 标记语法中，等于号后加的内容不用加引号，如&#91;url="http://www.google.cn"&#93;www.google.cn&#91;/url&#93;就是错误的写法。其次，也不要在标记和标记作用的文字之间加空格，像&#91;url&#93; www.google.cn &#91;/url&#93;这样的写法，也一样有错误。最后一点，UBB 标记对的结束标记必须包括正斜杠"/"，如&#91;url=http://google.cn&#93;返回 Google 首页&#91;/url&#93;<br />
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

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
		<title>ξ命令提示符</title>
	</head>
	<body>
		<div id="header">
			<img id="logo" src="/themes/{$themes}/images/logo.png" alt="" />
			<div id="ititle">
				<span style="font-size:12px; color:#fff;">{#subHeadding#}</span>
			</div>
			<!--<div id="head_bar">
				<a class="white" href="signup.html">注册</a>&nbsp;|&nbsp;
				<a class="white" href="login.html">登录</a>&nbsp;|&nbsp;
				<a class="white" href="feture.html">新功能</a>
			</div>-->
		</div>

		<div id="wrap">
			<div id="main">
				{include file="topnav.tpl"}

				<div id="content" class="blank">
					{section name=i loop=$index}
					<h3><a class="var" style="color:#006699;" href="{$dns}view/{$index[i].id}.html">{$index[i].title}</a></h3>
					<span class="gray">Posted by <a class="var" style="color:#993399;" href="http://www.v2ex.com/u/{$index[i].author}" target="_blank">{$index[i].author}</a> on {$index[i].create|date_format:"%Y-%m-%d %H:%M:%S"} CST in <a class="var" style="color:#f7499c;" href="{$dns}tags/{$index[i].tags}.html">{$index[i].tags}</a></span>
					<br /><br />
					{$index[i].content}
					<br /><br />
					{if $index[i].reply == 1}
					<span>
						<a class="h" href="{$dns}view/{$index[i].id}.html">我要评论</a>
						{if $index[i].reply_content}
						<br /><br /><img class="r" src="/themes/{$themes}/images/award_star_gold_1.png" />&nbsp;最新评论：
						<a class="regular" href="{$dns}view/{$index[i].id}.html">{$index[i].reply_content|truncate:60:"...":true}</a>
						<span class="gray">By&nbsp;{$index[i].reply_user}&nbsp;{$index[i].reply_create}</span>
						{/if}
					</span><br /><br />
					{/if}
					{/section}
				</div>

				{* Flickr图片展示 *}
				{include file="flickr.tpl"}

				{* Ing *}
				{include file="ing.tpl"}

			</div><!-- main end -->

			{* Sidebar *}
			{include file="sidebar.tpl"}

			<div class="bug"></div>
		</div><!-- wrap end -->

		{* footer *}
		{include file="footer.tpl"}
	</body>
</html>

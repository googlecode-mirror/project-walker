{config_load file="my.conf"}
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="/themes/{$themes}/images/favicon.ico" rel="shortcut icon" />
		<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 RSS" href="http://www.n7money.cn/feed/walker.rss" />
		<script type"text/javascript" src="/themes/{$themes}/scripts/walker.js"></script>
		<link rel="stylesheet" type="text/css" href="/themes/{$themes}/styles/style.css" />
		<title>ξ命令提示符</title>
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

				<div id="manage" class="blank">
					<span style="font-size:18px;
						font-weight:bold;"><img style="position:relative; top:7px;" src="/themes/{$themes}/images/applications-internet.png" alt="" />&nbsp;控制台</span>

					<div id="console"><img src="/themes/{$themes}/images/pencil.png" alt="" />&nbsp;<a href="{$dns}post.html">撰写新文章</a></div>
					<br />
					<div style="padding:5px; border: 2px solid
						#ccc; background-color: #f7f3f7;
						margin-bottom: 10px; font-size: 12px;
						-moz-border-radius: 10px;
						-webkit-border-radius: 10px;">
						<span><img style="position:relative; top:2px;" src="/themes/{$themes}/images/chart_bar.png" alt="" />&nbsp;
							建立于&nbsp;2007&nbsp;年&nbsp;8&nbsp;月&nbsp;8&nbsp;日,其中&nbsp;{$count}&nbsp;篇文章共获得了&nbsp;0&nbsp;条评论.</span><br />
						<span style="padding-bottom:2px;
							border-bottom:1px #e5e5e5 solid;
							display:block; width:700px;"></span>
						<br />
						<ul class="list">
							{section name=i loop=$topic_list}
							<li style="clear:both;">
							<span class="post"><img src="/themes/{$themes}/images/document.png" alt="" /><a href="{$dns}view/{$topic_list[i].id}.html">{$topic_list[i].title}</a>&nbsp;
								<small class="status">{if $topic_list[i].public == 1}... 已公开发布{else if}... 已私下发布{/if}</small>
							</span>
							<span class="process">
								<a class="btn1" href="{$dns}edit/{$topic_list[i].id}.html">编辑</a>
								<a class="btn1" href="{$dns}manage.html" onclick="remove({$topic_list[i].id});">删除</a>
								<!--<a class="btn1" href="#">发布</a>-->
							</span>
							</li>
							{/section}
						</ul>
						<div style="height:0px; clear:both;"></div>
					</div>
				</div>

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

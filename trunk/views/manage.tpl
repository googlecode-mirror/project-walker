<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="/styles/{$style|default:"style.css"}" />
		<link rel="stylesheet" type="text/css" href="/styles/extend.css" />
		<link rel="stylesheet" type="text/css" href="/styles/ifm.css" />
		<title>ξ命令提示符</title>
{literal}
<style>
div#manage{
clear:both;
}

div#manage ul{
	list-style:none;
	display:block;
padding:0px;
margin:0px;
border:0px;
}

div#manage li{
height:28px;
}

div#manage span{
height:26px;
/*border:1px solid #eff7ff;*/
border:1px solid #eeeeee;
display:block;
float:left;
line-height:210%;
margin-right:2px;
padding-left:1px;
}

span.m_img img{
position:relative;
top:5px;
left:2px;
right:2px;
width:16px;
}
span.m_img{
clear:both;
width:20px;
}

span.m_title{
width:265px;
}

span.m_reply, span.m_browse{
width:28px;
}

span.m_author{
width:132px;
}

span.m_date{
width:80px;
}

span.m_process{
width:30px;
border:1px dashed #eee;
background-color:#f9f9f9;
}

span.m_process a{

color:#0063dc;
}

span.m_public, span.m_private{
width:47px;
}

span.m_public a{
color:#00ff00;
}

span.m_private a{
color:#ff0000;
}

span.m_process, span.m_private, span.m_public{
	text-align:center;
}

span.total{
	font-size:14px;
    color:#993366;
    display:block;
    height:24px;
	line-height:175%;
	padding-left:500px;
    border-top:1px solid #eeeeee;
    border-bottom:1px solid #eeeeee;
    background-color:#f7f7f7;
}

small.num{
	font-family:Georgia,Verdana;
	font-size:14px;
    color:#990099;
}
</style>
{/literal}
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
				<span class="ban"><a href="http://www.n7money.cn/manage.html">管理首页</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://www.n7money.cn/post.html">撰写新文章</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://mail.google.com">管理评论</a>...</span>
				<span class="ban"><img alt="" src="/images/gt.gif" /></span>
				<span class="ban"><a href="http://www.n7money.cn/">返回首页</a>...</span>
			</div>

			<div id="main" class="blank">
				<div id="mainbar">
					<span class="ban"><img alt="Home" src="/images/terminal.png" /></span>
					<span style="{if $smarty.session.browser}width:675px;{else}width:678px;{/if}" class="ban">Walker Manage System</span>
					<span id="feed" class="ban">
						<a class="img" href="/feed/walker.rss"><img alt="RSS" src="/images/feed.png" /></a>
					</span><br />
					<span class="underline" style="margin-top:6px;"></span>
				</div>
				<div id="manage">
					<span style="font-size:20px; color:#669966; border:0px; margin-left:2px;">最新文章</span>
					<br /><br /><br />
                    <div>
						<span class="m_img"><img src="/images/star_active.png" alt="gt" />&nbsp;</span>
						<span class="m_title" style="border:1px solid #dfebf5; background-color:#ecf6fe;">标题</span>
						<span class="m_browse" style="border:1px solid #dfebf5; background-color:#ecf6fe;">浏览</span>
						<span class="m_reply" style="border:1px solid #dfebf5; background-color:#ecf6fe;">评论</span>
						<span class="m_author" style="border:1px solid #dfebf5; background-color:#ecf6fe;">作者</span>
						<span class="m_date" style="border:1px solid #dfebf5; background-color:#ecf6fe;">日期</span>
						<span style="width:152px; text-align:center; border:1px solid #dfebf5; background-color:#ecf6fe;">Action</span>
					</div>
					<div>
						<ul style="clear:both;">
						    {section name=i loop=$row}
							<li>					
								<span class="m_img">
								{if $row[i].post_show == 1}
								<img src="/images/star_inactive.png" alt="gt" />
                                {else}
								<img src="/images/star_active.png" alt="gt" />
                                {/if}
								</span>
								<span class="m_title">{$row[i].post_title}</span>
								<span class="m_browse">{$row[i].post_hits}</span>
								<span class="m_reply">{$row[i].post_hits}</span>
								<span class="m_author">{$row[i].post_author}</span>
								<span class="m_date">{$row[i].post_create|date_format:"%y-%m-%d"}</span>
								<span class="m_process"><a href="/edit/{$row[i].post_id}.html">编辑</a></span>
								<span class="m_process"><a href="#">删除</a></span>
								<span class="m_process"><a href="/view/{$row[i].post_id}.html">查看</a></span>
                                {if $row[i].post_show == 1}
								<span class="m_public"><a href="#">公开</a></span>
                                {else}
								<span class="m_private"><a href="#">不公开</a></span>
                                {/if}
							</li>
							{/section}
						</ul>
					</div>
				</div>
                
                <div style="clear:both; height:8px;"></div>
				<div class="link" style="clear:both; margin:0px; padding:0px;">
					<strong class="p_cur" href="#">1</strong>
					<a class="p" href="#">2</a>
					<a class="p" href="#">3</a>
					<a class="p_edge" href="#">10</a>
					<strong class="p_info">14 ITEMS / 30 PER PAGE</strong>
				</div>
				<br />
			<span class="total">总计<small class="num">{$num_rows}&nbsp;</small>篇日志，<small class="num">56&nbsp;</small>条回复</span>	
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

				<div id="cate" class="blank">
					<img alt="" src="/images/disk.png" />
					<a href="#">&nbsp;分类</a>
					<span class="bom"></span>
					<ul class="nav">
						<li><a href="/cat/1.html">Linux</a></li>
						<li><a href="/cat/2.html">Apache</a></li>
						<li><a href="/cat/3.html">MySQL</a></li>
						<li><a href="/cat/4.html">PHP</a></li>
						<li><a href="/cat/5.html">CSS</a></li>
						<li><a href="/cat/6.html">金融与经济</a></li>
						<li><a href="/cat/7.html">About me</a></li>
					</ul>
				</div>

				<div id="date" class="blank">
					<img alt="" src="/images/drive_disk.png" />
					<a href="#">&nbsp;存档</a>
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
						<li><img alt="" src="/images/coins.png" /><a href="/ifm.html">&nbsp;投资与理财</a></li>
						<li><img alt="" src="/images/application_form_magnify.png" /><a href="/ifm.html">&nbsp;历史交易查询</a></li>
						<li><img alt="" src="/images/application_form_edit.png" /><a href="/ifm.html">&nbsp;记账</a></li>
						<li><img alt="" src="/images/page_excel.png" /><a href="/ifm.html">&nbsp;交易报表</a></li>
						<li><img alt="" src="/images/terminal.png" /><a href="/manage.html">&nbsp;管理</a></li>
						<li><img alt="" src="/images/key.png" /><a href="/login.html">&nbsp;登录</a></li>
						<li><img alt="" src="/images/key_go.png" /><a href="/logout.html">&nbsp;登出</a></li>
						<li><img alt="" src="/images/page_link.png" /><a href="/link.html">&nbsp;链接</a>
						<ul class="nav">
							<li><a href="http://silentstar.cn/">silentstar.cn</a></li>
							<li><a href="#">link2</a></li>
							<li><a href="#">link3</a></li>
							<li><a href="#">link4</a></li>
						</ul>
						</li>
						<li><img alt="" src="/images/cog_go.png" /><a href="/about.html">&nbsp;关于Walker</a></li>
					</ul>
					<a  target="_blank" href="http://www.mozilla.com/"><img style="border:0;"class="img" alt="" src="http://www.77boy.cn/wp-content/themes/v2ex4wp//images/ff2o80x15.gif" /></a>
				</div>
				<div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
			</div>

		<div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>

		<div id="footer" class="blank">
			<span class="gray">Project Walker | Copyright (C) 2007-2010 Walkin &lt;console_zhao@163.com&gt;
		</div>
	</body>
</html>

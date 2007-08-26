<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="/styles/{$style|default:"style.css"}" />
		<link rel="stylesheet" type="text/css" href="/styles/extend.css" />
		<link rel="stylesheet" type="text/css" href="/styles/ifm.css" />
		<title>ξ命令提示符 - {$blog.title}</title>
	</head>

	<body>
		<div id="header">
			<img alt="" src="/images/logo.png" />
		</div>

		<div id="wrap">
			<div id="walker" class="blank">
				<img class="reposit" alt="" src="/images/house.png" />
				<span>
					<a href="/index.html">Walker</a> &gt; 
					<span>{$blog.title}</span>
				</span>
			</div>

			<div id="blog" class="blank">
				<h1 class="ititle">{$blog.title}</h1> 
				<span class="tip_i">... by
                {$blog.author} ... At {$blog.create|date_format:" %d, %b %H:%M"} ...
                {$blog.hits} 次点击 </span><br />
				{$blog.contents}
			</div>

			<div id="reply" class="blank">
				<span>本主题共有{$reply.count}条回复 | <a href="#">回到顶部</a>	| <a href="#">回复主题</a></span><br /><br />
{section name=j loop=$reply}
				<div class="{if $j is odd}light_odd{else}light_even{/if}">
					<img alt="" src="/images/star.png" />
					<span class="poster">{$reply[j].reply_uid}</span>
					<span
					class="posted">{$reply[j].reply_create|date_format:"%Y-%m-%d %H:%M"} sayed:</span>
					<p class="comment_content">
					{$reply[j].reply_content}
					</p>
				</div>
{/section}
				<div id="ReplyTip"><br />
					<span class="">看完之后有话想说？那就帮楼主加盖一层吧！</span><br /><br />
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="reply">
						<span style="color: rgb(51, 0, 102);">
							<img src="12800_files/1833_s.jpg" style="border-left: 2px solid rgb(0, 0, 0); padding: 0px 5px;" align="absmiddle">
							现在回复楼主道：<input class="sll"
							name="pst_title" value="Re: {$blog.title}" type="text">
							<br /><br />
							<textarea name="pst_content" rows="10" class="quick" id="taQuick"></textarea>
							<input name="p_cur" value="1" type="hidden">
							<div style="margin: 10px 0px 0px; padding-left: 390px;" align="left">
								<div id="btn_6918">
									<div class="btn_o" onclick="" align="left">
										<div class="btn_i" align="center">
											<a href="javascript:document.reply.submit();">立即回复</a>
										</div>
									</div>
								</div>
							</div>
						</span>
					</form>
				</div>

				<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">
				<span style="padding-left:20px;" class="tip">
					<a href="#;" onclick="window.scrollTo(0,0);">回到顶部</a> |
					<a href="http://www.v2ex.com/">回到首页</a>
				</span>
			</div>

			<div id="sidebar">
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
							<li><a href="#">link1</a></li>
							<li><a href="#">link2</a></li>
							<li><a href="#">link3</a></li>
							<li><a href="#">link4</a></li>
						</ul>
						</li>
						<li><img alt="" src="/images/cog_go.png" /><a href="/ablout.html">&nbsp;关于Walker</a></li>
					</ul>
					<a  target="_blank" href="http://www.mozilla.com/"><img style="border:0;"class="img" alt="" src="http://www.77boy.cn/wp-content/themes/v2ex4wp//images/ff2o80x15.gif" /></a>
				</div>
				<div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
			</div>

		<div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>

		<div id="footer" class="blank">
			<span class="gray">Project Walker | Copyright (C) 2007-2010 Walkin &lt;console_zhao@163.com&gt;</span>
		</div>
	</body>
</html>

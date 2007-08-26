<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/styles/extend.css" />
		<link rel="stylesheet" type="text/css" href="/styles/ifm.css" />
		<title>Project Walker | http://www.statin.cn/</title>
{php}echo '<script type="text/javascript">var id = ' .
$_SESSION['post_id'] .
'</script>';{/php}
{literal}<script type="text/javascript">
			var xmlHttp;

function initAjax() 
{
	if(window.ActiveXObject) 
	{
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest) 
	{
		xmlHttp = new XMLHttpRequest();
	}
}
function post() 
{
	initAjax();
	var title = document.getElementById("title");
	var categ = document.getElementById("categ");
	var content = document.getElementById("content");
	var tags = document.getElementById("tags");
	var url = "http://www.n7money.cn/post.php";
	var data = "method=post&title=" + title.value + "&categ=" + categ.value + "&content=" + content.value + "&tags=" + tags.value;
	xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	xmlHttp.onreadystatechange = callback;
	xmlHttp.send(data);
}

function callback()
{
	if(xmlHttp.readyState == 4)
	{
		if(xmlHttp.status == 200)
		{
			window.location='http://www.n7money.cn/view/' + id + '.html';
		}
	}
}
</script>
{/literal}
	</head>

	<body>
		<div id="header">
			<img alt="" src="/images/logo.png" />
			<!--<span id="toolbar"><a href="#">注册</a></span>-->
		</div>

		<div id="wrap">
			<div id="walker" class="blank">
				<img class="reposit" alt="" src="/images/house.png" />
				<span>
					<a href="/index.html">Walker</a> &gt; 
					<a href="/ifm.html">写日志</a>
				</span>
			</div>

			<div id="publish" class="blank">
				<span class="text_large">
					<img src="/images/ico_conf.gif" class="home" align="absmiddle">
					写日志
				</span>
				<table class="form" border="0" cellpadding="0" cellspacing="0">
					<form name="post" action="/post.php" method="post" id="write">
					<tbody>
						<tr>
							<td align="right" width="100">标题</td>
							<td align="left" width="400"><input onfocus="brightBox(this);" onblur="dimBox(this);" class="sll" name="title" id="title" type="text"></td>
						</tr>
						<tr>
							<td align="right" width="100">分类</td>
							<td align="left" width="400">
								<select class="sll" name="categ" id="categ" style="width:100px;">
									<option>Linux</option>
									<option>Apache</option>
									<option>MySQL</option>
									<option>金融与经济</option>
									<option>About me</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" width="100">日志内容</td>
							<td align="left" width="600">
								<textarea onfocus="brightBox(this);" onblur="dimBox(this);" rows="20" class="ml" name="content" id="content"></textarea>
							</td>
						</tr>
						<tr>
							<td align="right" width="100">Tag</td>
							<td align="left" width="400">
								<input onfocus="brightBox(this);" onblur="dimBox(this);" class="sll" name="tags" id="tags" type="text">
								<span style="color:#999999;font-size:12px;">&nbsp;&nbsp;用逗号隔开</span>
							</td>
						</tr>
					</tbody>
					</form>
				</table>
                <br />
                <a style="margin-left:535px;"
				href="javascript:post();" class="btn">发布</a>
				<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">
				<span style="padding-left:20px;" class="tip"><a href="#">返回首页</a></span>
			</div>

			<div id="sidebar">
				<div id="tools" class="blank">
					<ul class="menu">
						<li><img alt="" src="/images/house.png" /><a href="/search.html">&nbsp;返回首页</a></li>
						<li><img alt="" src="/images/page_edit.png" /><a href="/feed/walker.rss">&nbsp;管理文章</a></li>
						<li><img alt="" src="/images/clock.png" /><a href="/ifm.html">&nbsp;我的ING</a></li>
						<li><img alt="" src="/images/calendar.png" /><a href="/ifm.html">&nbsp;Google日历</a></li>
						<li><img alt="" src="/images/email_go.png" /><a href="/ifm.html">&nbsp;我的邮箱</a></li>
						<li><img alt="" src="/images/music.png" /><a href="/ifm.html">&nbsp;我的音乐</a></li>
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

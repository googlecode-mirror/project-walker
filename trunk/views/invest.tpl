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
{literal}<script type="text/javascript" src="http://www.n7money.cn/libs/FusionCharts/FusionCharts.js"></script>{/literal}
{literal}<script type="text/javascript">
			var xmlHttp;

function createXMLHttpRequest() 
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
function validate() 
{
	createXMLHttpRequest();
	var date = document.getElementById("trans_date");
	var url = "ajax.php?trans_date=" + escape(date.value);
	xmlHttp.open("GET", url, true);
	xmlHttp.onreadystatechange = callback;
	xmlHttp.send(null);
}

function callback()
{
	if(xmlHttp.readyState == 4)
	{
		if(xmlHttp.status == 200)
		{
			var passed = xmlHttp.responseText;
			//alert(passed);
			if(passed == "true")
			{
				setMessage("你输入了正确的日期格式.", "true");
			}
			else
			{
				setMessage("对不起，你输入的日期格式不正确.", "false");
			}
		}
	}
}

function setMessage(message, isValid)
{
	var messageArea = document.getElementById("dateMessage");
	var fontColor = "red";
	if(isValid == "true")
	{
		fontColor = "green";
	}
	messageArea.innerHTML = "<font color=" + fontColor + ">" +
		message + "</font>";
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
					<a href="/ifm.html">投资与理财</a>
				</span>
			</div>

			<div id="ifm" class="blank">

				<!--<span style="color:#330066; margin-left:20px; font-size:14px;">增加交易记录：</span>
				<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">
				<form style="width:720px; margin-left:20px;" action="fiscal.php" method="GET" name="add">
					<span id="addDate">
						<span style="margin-left:20px;">交易日期：</span>
						<input class="sll" style="width:80px;"
						id="trans_date" name="trans_date"
						value="2007/06/20" type="text" onchange="validate();" />&nbsp;&nbsp;&nbsp;&nbsp;
						交易类型：<select class="sll" name="trans_type" style="width:95px;">
							<option>本行存款</option>
							<option>ATM取款</option>
							<option>POS消费</option>
							<option>网上消费</option>
							<option>信用卡存款</option>
							<option>买入基金</option>$row['trans_desc']
							<option>基金赎回</option>
							<option>基金分红</option>
							<option>基金费率</option>
							<option>转账</option>
							<option>汇入汇款</option>
							<option>账户结息</option>
							<option>跨行手续费</option>
							<option>代发其它</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;
						交易金额：<input class="sll" style="width:75px;" name="trans_amount" value="0.00" type="text">&nbsp;&nbsp;&nbsp;&nbsp;	
					</span>
					<a style="margin-left:535px;" href="javascript:document.add.submit();" class="btn">增加</a><br />
                    <div id="dateMessage"></div>
					<span style="margin-left:20px;">交易备注：</span>
					<input class="sll" style="width:160px;" name="trans_desc" value="" type="text">
				</form>
				<br /><br />-->
				<span style="color:#330066; margin-left:20px; font-size:14px;">查询历史交易：</span>
				<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">
				<form style="width:720px; margin-left:20px;" action="fiscal.php" method="GET" name="query">
					<span id="queryDate">
						<span style="margin-left:20px;">起始日期：</span>
						<input class="sll" style="width:80px; margin-right:120px;" name="start_time" value="2007/06/01"type="text">
						终止日期：<input class="sll" style="width:80px;" name="end_time" value="2007/06/20" type="text"></span>
					<a style="margin-left:475px;" href="javascript:document.query.submit();" class="btn">查询</a>
				</form>
				<br />
				<table class="board" border="0" cellpadding="0" cellspacing="2" width="720" style="margin-right:10px;">
					<tbody>
<tr>
	<td class="star" align="center"
		height="24" valign="middle"
		width="0"><img src="/images/star_inactive.png"></td>
	<td align="left" bgcolor="#ffffff" height="24" width="120">交易日期&nbsp;<span class="text_property"></span></td>
	<td align="left" bgcolor="#ffffff" height="24" width="100">支出&nbsp;<span class="text_property"></span></td>
	<td align="left" bgcolor="#ffffff" height="24" width="100">存入&nbsp;<span class="text_property"></span></td>
	<td align="left" bgcolor="#ffffff" height="24" width="100">余额&nbsp;<span class="text_property"></span></td>
	<td align="left" bgcolor="#ffffff" height="24" width="100">交易类型&nbsp;<span class="text_property"></span></td>
	<td align="left" bgcolor="#ffffff" height="24" width="160">备注&nbsp;<span class="text_property"></span></td>
	</tr>					
<tr>
	<td class="star" align="center"
		height="24" valign="middle"
		width="0"><img src="/images/star_inactive.png"></td>
	<td class="date" align="left" bgcolor="#ffffff" height="24">2007-06-08&nbsp;<span class="text_property"></span></td>
	<td class="exp" align="left" bgcolor="#ffffff" height="24">200.00&nbsp;<span class="text_property"></span></td>
	<td class="tpi" align="left" bgcolor="#ffffff" height="24">300.00&nbsp;<span class="text_property"></span></td>
	<td class="bal" align="left" bgcolor="#ffffff" height="24">100.00&nbsp;<span class="text_property"></span></td>
	<td class="exp" align="left" bgcolor="#ffffff" height="24">本行CDS存款&nbsp;<span class="text_property"></span></td>
	<td class="tpi" align="left" bgcolor="#ffffff" height="24">本行CDS存款&nbsp;<span class="text_property"></span></td>
	</tr>
						<tr style="border-bottom:1px #cccccc solid;"></tr>
						<tr>
							<td></td>
							<td>支出交易笔数：</td>
							<td class="exp">4</td>
							<td></td>
							<td>存入交易笔数：</td>
							<td class="depos">3</td>
						</tr>
						<tr>
							<td></td>
							<td>支出金额合计： </td>
							<td class="exp"><?php echo $row['SUM(trans_expend)'];?></td>
							<td></td>
							<td>存入金额合计：</td>
							<td class="depos"><?php echo $row['SUM(trans_deposit)'];?></td>
						</tr>
					</tbody>
				</table>
				<a style="margin-left:40px;" href="/report/month/5.html">查看曲线图</a> | 
				<a href="#">查看直方图</a> |
				<a href="#">查看年报表</a> |
				<a href="javascript:void(window.print());">打印</a><br />
				<div id="chart">{$chart}</div>
				<div id="card">{$card}</div>
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

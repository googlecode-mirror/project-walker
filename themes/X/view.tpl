{config_load file="my.conf"}
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="/themes/{$themes}/images/favicon.ico" rel="shortcut icon" />
		<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 RSS" href="http://www.n7money.cn/feed/walker.rss" />
		<link rel="stylesheet" type="text/css" href="/themes/{$themes}/styles/style.css" />
		<script type"text/javascript" src="/themes/{$themes}/scripts/walker.js"></script>
		<script type"text/javascript" src="/themes/{$themes}/scripts/prototype.js"></script>
		<script type"text/javascript" src="/themes/{$themes}/scripts/scriptaculous.js?load=effects,dragdrop"></script>
		{literal}
		<script type"text/javascript">
		function Reply()
		{
			if($F('reply_content'))
			{
				$('pro').innerHTML = "<br /><br /><img style='margin-left:400px;position:relative; top:3px;' src='/themes/X/images/loading.gif' /><span class='tip_i'>&nbsp;正在发送请求...</span><br />";
				var request = initAjax();
				request.onreadystatechange=callback;

				var method = $F('method');
				var pid = $F('pid');
				var reply_content = $F('reply_content');

				var url = 'http://www.n7money.cn/post.php';
				var data = 'method=' + method + '&pid=' + pid + '&reply_content='  + reply_content;

				request.open('POST', url, true);
				request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
				request.send(data);
			}
			else
			{
				$('reply_content').morph('border-color:#f00; border-width:2px;');
			}
		}

		function callback()
		{
			if(request.readyState == 4)
			{
				if(request.status == 200)
				{
					if(request.responseText == 'ok')
					{
						window.location.href = '/view/73.html';
						var div = $('pro');
						div.innerHTML = '<span style="margin-left:350px;">发布成功。</span>';
					}
				}
				else
				{
					alert("Failure!");
				}
			}
		}
		</script>
		{/literal}
		<title>ξ命令提示符 - {$topic_name}</title>
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
					{section name=i loop=$logs}
					<h3><a class="var" style="color:#006699;" href="#">{$logs[i].title}</a></h3>
					<span class="gray">Posted by <a class="var" style="color:#993399;" href="http://www.v2ex.com/u/{$logs[i].author}" target="_blank">{$logs[i].author}</a> on {$logs[i].create|date_format:"%Y-%m-%d %H:%M:%S"} CST in <a class="var" style="color:#f7499c;" href="{$dns}tags/{$logs[i].tags}.html">{$logs[i].tags}</a></span>
					<br /><br />
					{$logs[i].content}
					<br /><br />
					<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">
					<span style="margin-left:485px;">
						{if $logs[i].reply == 0}
						<a class="h">这是一个自闭模式的主题</a>
						{else if}
						<a href="#" class="h">更多</a>
						<a href="#" class="h" onclick="">回复({$count_of_reply})</a>
						{/if}
					</span>
					{/section}
				</div>

{if $logs[0].reply == 1}
				<div id="reply" class="blank">
					<a name="reply" class="img"><img src="/img/spacer.gif" width="1" height="1" style="display: none;" /></a>
					<div id="vxReplyTop" style="width:650px;">
						<span class="tip_i">{$count_of_reply} 篇回复 | <a onclick="window.scrollTo(0,0);" href="#;" class="regular">回到顶部</a> | <a href="#replyForm" class="regular">回复主题</a></span>
					</div>
					{section name=i loop=$reply}
					<div class="r" style="width:650px;">
						<div style="float: right;"><span class="tip_i">{$reply[i].create}</span></div>
						<a href="/themes/X/images/1833_n.jpg"><img src="/themes/X/images/1833_s.jpg" align="absmiddle" style="margin-right: 10px;" border="0" /></a>
						<strong><a href="#" style="color: #930" class="var">{$reply[i].author}</a></strong> 
						<span class="tip_i">{$reply[i].desc}</span>
						<div style="margin-bottom: -5px;"></div>
						<div style="padding-left: 45px;">{$reply[i].content}</div>
					</div>
					<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">
					{/section}
					<div id="vxReplyTip" style="width:650px;">
						<a name="replyForm" class="img"><img src="17658_files/spacer.gif" style="display: none;" height="1" width="1"></a>
						<span class="tip_i">看完之后有话想说？那就留下一点印记吧！</span>
					</div>
					<div style="width:650px;">
						<form action="/post.php" method="post" name="form_topic_reply" id="form_topic_reply">
							<span style="color: rgb(0, 51, 153);"><img src="/themes/X/images/1833_s.jpg" style="border-left: 2px solid rgb(0, 51, 51); padding: 0px 5px;" align="absmiddle">
								<span style="color:#f7499c;">昵称:{$smarty.session.user}&nbsp;(未登陆时以guest用户发布.)</span><br><br>
								<textarea name="reply_content" id="reply_content" rows="10" class="quick" onblur="valid('reply_content');"></textarea>
								<input name="method" id="method" value="reply" type="hidden">
								<input name="pid" id="pid" value="{$pid}" type="hidden">
								<div id="pro">
								<a href="javascript:Reply();" class="btn" style="margin-top:10px;">回复主题</a>
								</div>
							</span>
						</form>
					</div>
					<div class="light_odd" style="margin-bottom:5px; width:650px; clear:both;" align="left">
						<span class="tip_i">
							<a href="#;" onclick="window.scrollTo(0,0);" class="regular">回到顶部</a> | 
							<a href="http://www.n7money.cn/" target="_blank" class="regular">返回首页</a>
						</span>
					</div>
			</div>
{/if}

				{include file="related.tpl"}

			</div><!-- main end -->

			{* Sidebar *}
			{include file="sidebar.tpl"}

			<div class="bug"></div>
		</div><!-- wrap end -->

		{* footer *}
		{include file="footer.tpl"}
	</body>
</html>

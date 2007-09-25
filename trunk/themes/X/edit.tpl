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
		window.onload=autoSave;

		function Modify()
		{
			$('pro').innerHTML = "<br /><br /><img style='margin-left:400px;position:relative; top:3px;' src='/themes/X/images/loading.gif' /><span class='tip_i'>&nbsp;正在发送请求...</span><br />";
			save();
		}

		function save()
		{
			var request = initAjax();
			request.onreadystatechange=callback;
			var method = $F('method');
			var topic_id = $F('topic_id');
			var title = $F('title');
			var reply = $F('reply');
			var show = $F('status');
			var tags = $F('tags');
			var created = $F('created');
			var content = $F('content');

			var url = 'http://www.n7money.cn/post.php';
			var data = 'method=' + method + '&topic_id=' + topic_id + '&title=' + title + '&tags=' + tags + '&reply=' + reply + '&show=' + show + '&created=' + created + '&content='  + content;
			request.open('POST', url, true);
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			request.send(data);
		}

		function call()
		{
			if(request.readyState == 4)
			{
				if(request.status == 200)
				{
					if(request.responseText == 'ok')
					{
						setMessage();
					}
				}
				else
				{
					alert("Failure!");
				}
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
						//window.location.href = '/view/' + topic_id + '.html';
						var div = $('pro');
						div.innerHTML = '<span style="margin-left:350px;">已更新。</span>';
						window.location.reload();
					}
				}
				else
				{
					alert("Failure!");
				}
			}
		}

		function autoSave()
		{
			setTimeout("saveNow();", 60000);

		}

		function saveNow()
		{
			var request = initAjax();
			request.onreadystatechange=call;

			var method = $F('method');
			var topic_id = $F('topic_id');
			var title = $F('title');
			var reply = $F('reply');
			var show = $F('status');
			var tags = $F('tags');
			var created = $F('created');
			var content = $F('content');

			var url = 'http://www.n7money.cn/post.php';
			var data = 'method=' + method + '&topic_id=' + topic_id + '&title=' + title + '&tags=' + tags + '&reply=' + reply + '&show=' + show + '&created=' + created + '&content='  + content;

			request.open('POST', url, true);
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			request.send(data);
		}

		function setMessage()
		{
			var d = new Date()
			var now = d.toUTCString();
			$('autosave').innerHTML = "<img src='/themes/X/images/accept.png' class='r' />&nbsp;<span style='font-size:12px; color:red;'>已自动保存于&nbsp;" + now + "</span>";
		}
		</script>
		{/literal}
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

             	<div id="post" class="blank">
				    <span style="font-size:18px;
						font-weight:bold;"><img style="position:relative; top:7px;" src="/themes/{$themes}/images/document-new.png" alt="" />&nbsp;撰写新文章</span>
					<table class="form" border="0" cellpadding="0" cellspacing="0">
						<form name="post" action="/post.php" method="post" id="post">
							<tbody>
								<tr>
									<td align="right" width="100">标题</td>
									<td align="left" width="400"><input class="sll" name="title" id="title" type="text" onblur="valid('title');" value="{$edit[0].title}">
									<span id="mesTitle"></span></td>
								</tr>
								<tr>
									<td align="right" width="100"</td>
									<td align="left" width="400"><div id="autosave"></div></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="100">日志内容<span id="mesContent"></span></td>
									<td align="left" width="600">
										<textarea rows="35" class="ml" name="content" id="content" onblur="valid('content');" onchange="autoSave();">{$edit[0].content}</textarea>
										<input type="hidden" name="method" id="method" value="modify">
										<input type="hidden" name="topic_id" id="topic_id" value="{$edit[0].id}">
									</td>
								</tr>
								<tr>
									<td align="right" width="100">格式</td>
									<td align="left" width="400">
										<select class="sll" name="format" id="format" style="width:150px;">
											<option>UBB</option>
											<option>超文本/XHTML</option>
											<option>UBB/Anti-GFW</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" width="100">评论许可</td>
									<td align="left" width="400">
										<select class="sll" name="reply" id="reply" style="width:200px;">
											<option>任何人都可以评论</option>
											<option>禁止评论</option>
											<option>仅允许我的好友评论</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" width="100">Tags</td>
									<td align="left" width="400">
										<input class="sll" name="tags" id="tags" type="text" style="width:200px;" onblur="valid('tags');"  value="{$edit[0].tags}">
										<span id="mesTags"></span>
									</td>
								</tr>
								<tr>
									<td align="right" width="100">状态</td>
									<td align="left" width="400">
										<select class="sll" name="status" id="status" style="width:100px;">
											<option>公开发布</option>
											<option>私有发布</option>
											<option>草稿</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right"
										width="100">发布时间</td>
									<td align="left" width="400">
										<input class="sll" name="created" id="created" type="text" style="width:200px;" value="{$edit[0].create|date_format:"%Y-%m-%d %H:%M:%S"}">
									</td>
								</tr>
							</tbody>
						</form>
					</table>
					<br />
					<div id="pro">
						<a id="btn_bug" href="javascript:Modify();" class="btn">保存</a>
						<a style="margin-left:15px;" href="{$dns}manage.html" class="btn">取消</a>
					</div>
					<div class="bug"></div>
				</div><!-- post end -->

			</div><!-- main end -->

			{* Sidebar *}
			{include file="sidebar.tpl"}

			<div class="bug"></div>
		</div><!-- wrap end -->

		{* footer *}
		{include file="footer.tpl"}
	</body>
</html>

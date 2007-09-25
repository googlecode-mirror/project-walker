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
		function newTopic()
		{
			var div = $('pro');
			div.innerHTML = '<span style="margin-left:350px;">正在发送请求...</span>';
			var request = initAjax();
			request.onreadystatechange=callback;
			var method = $F('method');
			var title = $F('title');
			var reply = $F('reply');
			var pub = $F('status');
			var tags = $F('tags');
			var content = $F('content');

			var url = 'http://www.n7money.cn/post.php';
			var data = 'method=' + method + '&title=' + title + '&tags=' + tags + '&reply=' + reply + '&public=' + pub + '&content='  + content;
			//alert(data);

			request.open('POST', url, true);
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			request.send(data);
		}

		function callback()
		{
			if(request.readyState == 4)
			{
				if(request.status == 200)
				{
					if(request.responseText == 'ok')
					{
						var div = $('pro');
						div.innerHTML = '<span style="margin-left:350px;">发布成功。</span>';
						window.location.href = '/manage.html';
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
						<form name="post" action="{$dns}post.php" method="post" id="post">
							<tbody>
								<tr>
									<td align="right" width="100">标题</td>
									<td align="left" width="400"><input class="sll" name="title" id="title" type="text" onblur="valid('title');"><span id="mesTitle"></span></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="100">日志内容<span id="mesContent"></span></td>
									<td align="left" width="600">
										<textarea rows="30" class="ml" name="content" id="content" onblur="valid('content');"></textarea>
										<input type="hidden" name="method" id="method" value="new">
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
											<option>禁止评论</option>
											<option>任何人都可以评论</option>
											<option>仅允许我的好友评论</option>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right" width="100">Tags</td>
									<td align="left" width="400">
										<input class="sll" name="tags" id="tags" type="text" style="width:200px;" onblur="valid('tags');">
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
										<input class="sll" name="created" id="created" type="text" style="width:200px;" value="{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}">
									</td>
								</tr>

							</tbody>
						</form>
					</table>
					<br />
									<!--<input name="submit" id="submit" type="submit" value="保存" style="margin-left:450px;">
									<input name="reset" id="reset" type="reset" value="取消">-->
					<div id="pro">
						<a id="btn_bug" href="javascript:newTopic();" class="btn">保存</a>
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 TRANSITIONAL//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<title>ξ命令提示符</title>
<link href="/themes/{$themes}/styles/login.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body onload="document.forms[0].elements[0].focus();">
<div id="main" align="center">

	<div id="v2ex" align="left">
		<div class="title">登录</div>

		<hr size="1" color="#EEE" style="color: #EEE; background-color: #EEE; height: 1px; border: 0;" />		<table width="100%" cellpadding="5" cellspacing="0" class="login_form_t">
			<form action="/login.php" method="post">
			<tr>
				<td width="80" align="right">用户名:</td>
				<td align="left"><input name="username" type="text" class="line" onfocus="this.style.borderColor = '#0C0'; this.style.backgroundColor = '#FFF';" onblur="this.style.borderColor = '#999'; this.style.backgroundColor = '#F5F5F5';" maxlength="100" /></td>
			</tr>
			<tr>
				<td width="80" align="right">密码:</td>

				<td align="left"><input name="password" type="password" class="line" onfocus="this.style.borderColor = '#0C0'; this.style.backgroundColor = '#FFF';" onblur="this.style.borderColor = '#999'; this.style.backgroundColor = '#F5F5F5';" maxlength="32" /></td>
			</tr>
			<tr>
				<td width="80"></td>
				<td align="left"><span class="tip"><a href="/passwd.html">我忘记了密码</a> &nbsp;|&nbsp; <a href="/signup.html">注册</a> &nbsp;|&nbsp; <a href="/">游客</a></span></td>

			</tr>
			<tr>
				<td width="80"></td>
				<td valign="middle"><input type="image" src="/themes/{$themes}/images/login.gif" alt="登录" /></td>
			</tr>
<input type="hidden" value="http://www.n7money.cn/" name="return" />			</form>
		</table>
	</div>
	
	<div id="bottom" align="center">

	&copy; 2006-2007 <a href="http://www.n7money.cn/" target="_self">V2EX</a>
	</div>

</div>
</body>
</html>


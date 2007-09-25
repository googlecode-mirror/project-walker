<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="/themes/{$themes}/images/favicon.ico" rel="shortcut icon" />
		<link rel="stylesheet" type="text/css" href="/styles/style.css" />
		<title>ξ命令提示符</title>
	</head>
	<body>
		<div id="header">
			<img id="logo" src="/themes/{$themes}/images/logo.png" alt="" />
			<div id="ititle">
				<span style="font-size:12px; color:#fff;">凌乱的住处，嗜酒，不只一台电脑，无线网络覆盖，坐在马桶上用PDA 读RSS，没有女朋友，有自己极其痴迷的事物，对任<br />
					何工作没有任何热情，不向往什么社会认同感，内心敏感，与父母关系紧张却又疏离，手淫，自言自语，喜欢用很大的声音听<br />
					X-Japan和安室奈美惠的音乐．</span>
			</div>
			<!--<div id="head_bar">
				<a class="white" href="signup.html">注册</a>&nbsp;|&nbsp;
				<a class="white" href="login.html">登录</a>&nbsp;|&nbsp;
				<a class="white" href="feture.html">新功能</a>
			</div>-->
		</div>

		<div id="wrap">
			<div id="main">
				<!--<div id="topnav" class="blank">
					topnav
				</div>-->

				<div id="content" class="blank">
					<h3><a href="#">关于这个项目</a></h3>
					<span class="gray">Posted by <a href="#">ξ命令提示符</a> on 2007-9-7 22:33:23 CST in <a href="#">乱七八糟</a></span>
					<br /><br />
					这个项目很多方面向V2EX学习，如界面UI和代码架构，因为不想使用现有的博客程序，因为感觉不适合自己，想像Livid那样写一个自己的博客程序，这在我看来是作为一个PHPer的最基本的东西。<br /><br />由于水平有限，这个项目可以说是用代码拼起来的，而且不支持IE，一个原因是目前还不想解决IE跟Firefox的兼容性问题，当然最大的原因还是因为不喜欢IE，甚至说是讨厌微软。刚学习Ajax不久，所以并没有很多地方用到了Ajax。同时使用了Apache的mod_rewrite模块，以使URL美观，也起到一点点安全性的作用：<br /><br />
					<img class="i_img" src="http://www.n7money.cn/images/uploads/htaccess.jpg" alt".htaccess" /><br /><br />自己并不擅长写博客，只是想做一个展示自己的平台。把自己喜欢的东西分享给所有人。
					到目前为止，整个项目还有很多地方没有完成，只有最基本的写文章和浏览文章的功能，而且像分类，按日期浏览的功能还没有完成。不管怎么样，这个项目不会像以前任何一个中途而费，并且会不断完善，等到合适的时候我打算将这个项目开源，这也是作为开源爱好者一个小小的想法。<br /><br />
					部分Code:<br /><br />
					<img class="i_img" src="http://www.n7money.cn/images/uploads/code.jpg" alt="Code" /><br /><br />
					这个项目采用了Apache2、PHP5、MySQL5、Smarty的架构，以后可能会用到ZendFramework的Cache部分，以加快浏览速度，也可能会使用静态页面生成技术，还会逐步将一部分功能改为Ajax实现以及增加对UBB代码的支持...	
					<br /><br />
					<span>
						<a class="var" href="#">more</a>&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="#">0 comments</a>
						<a href="#"></a>
					</span><br /><br />

                    <h3><a href="#">御宅族</a></h3>
					<span class="gray">Posted by <a href="#">ξ命令提示符</a> on 2007-9-7 22:33:23 CST in <a href="#">御宅族</a></span>
					<br /><br />
					[御宅族/日文为：おたく，音为Otaku]<br />
御宅是指一些人过份沉迷於某种事物，例如动漫画、游戏等。他们对於自己沉迷的事物无所不知，还每天不断寻找新的资料加以牢记，希望把想知道的事情尽量记入脑中，也不会主动去接触其他的事物。因此，他们完全封闭在自己的世界中，且不觉得自己的行为是没有意义，每天过著很满足的生活。从另一个角度来看，御宅族会寻找某种特别事物作为媒介从而辅助封闭自己。很多时御宅会被认为是难与异性相处， 对人欠缺普遍应有的态度，不懂适应社会。
<br /><br />
身为「宅」须具备的三个定义：<br />
一、有著高度搜寻参考资料能力的人<br />
二、拥有对这个映射资讯爆发的适应力，有跨领域的资料搜寻能力，对映射创作者所提示的暗号，一个也不漏的加以解读与研究。<br />
三、永不满足的向上心和自我表现欲<br />
上面这些，基本上都是身为一个「日系宅人」的基本条件，日系宅已养成了长期待在家，生活拉榻不管的程度！					
					<br /><br />
					<span>
						<a class="var" href="#">more</a>&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="#">0 comments</a>
						<a href="#"></a>
					</span>
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

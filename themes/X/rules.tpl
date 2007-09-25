<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
{config_load file="my.conf"}
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="/themes/{$themes}/images/favicon.ico" rel="shortcut icon" />
		<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 RSS" href="http://www.n7money.cn/feed/walker.rss" />
		<link rel="stylesheet" type="text/css" href="/themes/{$themes}/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/themes/{$themes}/styles/extra.css" />
		<title>ξ命令提示符 - 指导原则</title>
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

				<div id="rules" class="blank">
					<h3><img src="/themes/{$themes}/images/ico_smile.gif" style="position:relative; top:6px;" />&nbsp;指导原则</h3>
					首先这是一个叛逆者的博客，有着不寻常思想与生活态度的空间，有一些被鼓励与不被鼓励的。<br /><br />
					<div class="header"><img align="absmiddle" src="/themes/{$themes}/images/tick.png"/>&nbsp;被鼓励的行为</div>
					<ul class="rules">
						<li>尊重他人也尊重自己 -  每一个生命都是一场奇迹。而生命与生命之间，没有高下贵贱之分，不要把自己看得太重要，也不要轻视自己的潜力。每一个人都应该怀着平和的心态与他人相处。</li>
						<li>探索所有新的可能性 -  我们从小到大无条件地接受了太多的不明所以的说教，这些沉积于脑海中的成见让我们很多时候莫名其妙地拒绝了太多新的可能性，生命应该成为一场华丽而壮阔的冒险，我们应该有勇气去尝试各种新的可能性，没有什么是不能接受的。</li>
						<li>展示一个真正的自我 - 你活在属于自己的生活里，你用自己的时间来为属于自己的精彩生活添砖加瓦，不要浪费时间去经历别人的生活，你应该活在自己的生活里，并向别人展示一个真实的自己！</li>
					</ul>
					<br />
					<div class="header"><img align="absmiddle" src="/themes/{$themes}/images/cross.png"/>&nbsp;以下是不被鼓励的</div>
					<ul class="rules">
						<li>没有要点的提问 - 当你准备向他人提问的时候，你应该仔细考虑，你是否已经做了足够多的尝试，从而让你所提的问题中包含要点？所有人的时间都是宝贵的，你的也一样，因此，请不要提没有要点的问题。</li>
						<li>任何形式的攻击 - 不要轻易与别人进入敌对状态，你或许不知道，人的心情不舒畅的状态，对健康会有多么巨大的损害！你不喜欢心情不好的感觉，别人也同样不喜欢，因此，为了让大家都有一份轻松的心情，不要对别人进行任何形式和意义上的攻击。</li>
						<li>无聊透顶的重复 - 不要在任何主题后面回复“顶”，“好”，“坐沙发”，“mark”之类无聊文字，如果你确实喜欢一篇主题，注册会员可以使用本站的收藏夹功能，未注册会员则推荐你使用 del.icio.us 进行收藏，而至于你对主题发起者的欣赏，你或许可以采取更为有建设性的方式表达，比如在心中的默默赞叹，或者是到自己的 Blog 中写下感受，而不要采取任何的“顶”之类的方式。本社区不欢迎“看帖要回帖”之类的无聊举动。另外，也不要将同一个主题发到多个讨论区中，这在 V2EX 是非常让人讨厌的行为。</li>
						<li>内容枯燥的广告 - 本站不欢迎任何低劣的广告，个人的或者商业的。如果你打算在 V2EX 上发布广告，那么请你仔细构思之后再贴，如果你的广告文字确实言之有物，那么这些广告文字就可以在 V2EX 得以保留，否则将在第一时间内被删除。如果你实在想发广告，那么我们会推荐你到 Kijiji 上去发，中国最好的个人网络广告发布站点！</li>
						<li>浮躁地思考和行事 - Good cooking takes time, if you're made to wait, it is to serve you better, and to please you</li>
					</ul>
					<br />
					<span>本指导原则将根据实际情况而可能随时被修订，因此请保持对此指导原则的关注。如果你认为以上所说的，你完全不能赞同，那么可能这里并不适合你，那么就请你离开。</span>
				</div>
			</div><!-- main end -->

			{* Sidebar *}
			{include file="sidebar.tpl"}

			<div class="bug"></div>
		</div><!-- wrap end -->

		{* footer *}
		{include file="footer.tpl"}
	</body>
</html>

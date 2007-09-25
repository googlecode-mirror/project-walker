<?php
/** 
 * Core.class.php
 * 
 * this program is free software; you can redistribute it and/or modify
 * it under the terms of the gnu general public license as published by
 * the free software foundation; either version 2 of the license, or
 * (at your option) any later version.
 *
 * this program is distributed in the hope that it will be useful,
 * but without any warranty; without even the implied warranty of
 * merchantability or fitness for a particular purpose.  see the
 * gnu general public license for more details.
 *
 * you should have received a copy of the gnu general public license
 * along with this program; if not, write to the free software foundation,
 * inc., 51 franklin street, fifth floor, boston, ma 02110-1301 usa.
 *
 * @author always.8 <always.8@gmail.com>
 * @version $Id: Core.class.php 0 2007-09-25 16:50:49Z always.8 $
 * @copyright http://www.n7money.cn/
 * @package Core
 */

ini_set('include_path', '../:'. ini_get('include_path'));
ini_set('include_path', '../libs/ZendFramework-0.9.3-Beta:'. ini_get('include_path'));
require_once 'config.php';
require_once 'models/Flickr.class.php';
require_once 'models/Ing.class.php';
require_once 'models/Links.class.php';
require_once 'models/Post.class.php';
require_once 'models/Show.class.php';
require_once 'models/Tags.class.php';
require_once 'models/utils.php';
require_once 'zend/Cache.php';

class Core
{
	private $db;
	private $cache;
	private $cacheFlickr;
	private $cacheIng;
	public function __construct()
	{
		/* init databases */
		$this->db = mysql_connect(WALKER_DB_HOST, WALKER_DB_USERNAME, WALKER_DB_PASSWORD)
			or die('could not connect: ' . mysql_error());
		mysql_select_db(WALKER_DB_NAME);
		mysql_query('SET NAMES utf8');
		mysql_query('SET CHARACTER SET utf8');
		mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");

		/* zend_cache solution */
		$frontendOptions = array(
			'lifetime' => LIFETIME,
			'automatic_serialization' => true
		);
		$backendOptions = array(
			'cache_dir' => CACHE_DIR
		);
		$this->cache = Zend_Cache::factory('core', 'file', $frontendOptions, $backendOptions);

		$this->cacheFlickr = Zend_Cache::factory('core', 'file', 
			array('lifetime' => LIFETIME_OF_FLICKR,'automatic_serialization' => true), 
			array('cache_dir' => CACHE_DIR)
		);

		$this->cacheIng = Zend_Cache::factory('core', 'file', 
			array('lifetime' => LIFETIME_OF_ING,'automatic_serialization' => true), 
			array('cache_dir' => CACHE_DIR)
		);
	}

	public function __destruct()
	{
		mysql_close($this->db);
	}

	public function Meta()
	{
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />' . "\n";
	}

	public function Link()
	{
		echo '<link href="/themes/' . THEMES . '/images/favicon.ico" rel="shortcut icon" />' . "\n";
		echo '<link rel="alternate" type="application/rss+xml" title="ξ命令提示符 rss" href="http://www.n7money.cn/feed/walker.rss" />' . "\n";
		echo '<link rel="stylesheet" type="text/css" href="/themes/' . THEMES . '/styles/style.css" />' . "\n";
		echo '<link rel="stylesheet" type="text/css" href="/themes/' . THEMES . '/styles/extra.css" />' . "\n";
		echo '<script type"text/javascript" src="/themes/' . THEMES . '/scripts/prototype.js"></script>' . "\n";
		echo '<script type"text/javascript" src="/themes/' . THEMES . '/scripts/scriptaculous.js?load=effects,dragdrop"></script>' . "\n";
	}

	public function Title()
	{
		echo '<title>' . $title . '</title>' . "\n";
	}

	public function Head($title)
	{
		echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' . "\n";
		echo '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
		echo '<head>' . "\n";
		$this->Meta();
		$this->Link();
		$this->Title();
		echo '</head>' . "\n";
	}

	public function BodyStart()
	{
		echo '<body>' . "\n";
		echo '<div id="header">' . "\n";
		echo '<img id="logo" src="/themes/{$THEMES}/images/logo.png" alt="" />' . "\n";
		echo '<div id="ititle">' . "\n";
		echo '<span style="font-size:12px; color:#fff;">';
		echo '凌乱的住处，嗜酒，不只一台电脑，无线网络覆盖，坐在马桶上用pda 读rss，没有女朋友，有自己极其痴迷的事物，对任<br />';
		echo '何工作没有任何热情，不向往什么社会认同感，内心敏感，与父母关系紧张却又疏离，手淫，自言自语，喜欢听视觉摇滚和<br />';
		echo 'hip-hop一类的日本音乐．</span>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
	}

	public function BodyEnd()
	{
		echo '<div class="bug"></div>' . "\n";
		echo '</div><!-- wrap end -->' . "\n";
	}

	public function Footer()
	{
		echo '<div id="footer" class="blank">' . "\n";
		echo '<span class="gray">copyright &copy; 2007-2010 <a class="var" style="color:#6666dd;" href="{$dns}about.html">ξ命令提示符</a>' . "\n";
		echo '&lt;always.8@gmail.com&gt;</span>' . "\n";
		echo '<br />' . "\n";
		echo '<a class="var" style="color:#cccccc;" href="http://www.v2ex.com/" target="_blank">thanks to livid</a> <span class="gray">|</span> ' . "\n";
		echo '<a class="var" style="color:#cccccc;"' . "\n";
		echo 'href="{$dns}rules.html">规则</a> <span class="gray">|</span> ' . "\n";
		echo '<a class="var" style="color:#cccccc;" href="#">留言</a> <span class="gray">|</span> ' . "\n";
		echo '<a class="var" style="color:#cccccc;" href="{$dns}about.html">about me</a>' . "\n";
		echo '<br />' . "\n";
		echo '<a class="var" style="color:#cccccc;" href="{$dns}labs.html">project walker labs</a>' . "\n";
		echo '</div><!-- footer end -->' . "\n";
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}

	public function Container($module, $options)
	{
		$this->BodyStart();
		echo '<div id="wrap">' . "\n";
		echo '<div id="main">' . "\n";
		switch ($module)
		{
		default:
		case 'home':
			$options['module']['sidebar'] == true;
			$this->Topnav();
			$this->Home();
			$this->Flickr();
			$this->Ing();
			break;
		case 'view':
			$options['module']['sidebar'] == true;
			$this->View();
			break;
		case 'tags':
			$options['module']['sidebar'] == true;
			$this->Tags();
			$this->Flickr();
			break;
		case 'manage':
			$options['module']['sidebar'] == true;
			$this->Manage();
			$this->Ing();
			break;
		case 'post':
			$options['module']['sidebar'] == true;
			$this->Post();
			break;
		case 'edit':
			$options['module']['sidebar'] == true;
			$this->Edit();
			break;
		case 'about':
			$this->About();
			break;
		case 'help':
			$this->Help();
			break;
		case 'labs':
			$this->Labs();
			break;
		case 'rules':
			$this->Rules();
			break;
		}
		echo '</div><!-- main end -->' . "\n";
		if($options['module']['sidebar'] == true)
		{
			$this->Sidebar();
		}
		$this->BodyEnd();
		$this->Footer();
	}

	public function Flickr($datas)
	{
		echo '<div id="flickr" class="blank" style="height:160px;">' . "\n";
		echo '<img src="/themes/{$THEMES}/images/flickr_logo.gif" alt="" style="border:0px; position:relative; top:5px;" />' . "\n";
		echo '<span style="color:#577de7;">[root@localhost ~]ls *.jpg *.gif *.png</span>' . "\n";
		echo '<br /><br />' . "\n";
		echo '<ul>' . "\n";

		if(!$flickr = $this->cacheFlickr->load('flickr'))
		{
			$flickr = Flickr::output($datas);
			$this->cacheFlickr->save($flickr, 'flickr');
			for($i = 0; $i < count($flickr); $i ++)
			{
				echo '<li><a href="' . $flickr[$i][link] .'" target="_blank"><span>' . $flickr[$i][name] . '</span><img src="'
					. $flickr[$i][url] . '" alt="" />' . $flickr[$i][description] . '</a></li>' . "\n";
			}
		}
		else
		{
			/* cache hit */
			for($i = 0; $i < count($flickr); $i ++)
			{
				echo '<li><a href="' . $flickr[$i][link] .'" target="_blank"><span>' . $flickr[$i][name] . '</span><img src="'
					. $flickr[$i][url] . '" alt="" />' . $flickr[$i][description] . '</a></li>' . "\n";
			}
		}

		echo '</ul>' . "\n";
		echo '</div><!-- flickr end -->' . "\n";
	}

	public function Ing($datas)
	{
		echo '<div id="ing" class="blank">' . "\n";
		echo '<img src="/themes/{$THEMES}/images/hourglass.png" alt="" style="position:relative; top:3px;" />' . "\n";
		echo '<span style="color:#577de7;">&nbsp;[root@localhost ~]# history</span>' . "\n";
		echo '<div style="height:10px; overflow:hidden;"></div>' . "\n";
		echo '<ul class="ing">' . "\n";

		if(!$list = $this->cacheIng->load('ing'))
		{
			$ing = new Ing;
			$list = $ing->output('local');
			$this->cacheIng->save($list, 'ing');

			for($i = 0; $ < count($list); $i ++)
			{
				echo '<li><img src="' . $list[$i][img] . '" alt="" />&nbsp;&nbsp;<a style="color:' . rand_color() . '"  class="var" href="'
					. $list[$i][link] . '" target="_blank">' . $list[$i][title] . '</a>&nbsp;&nbsp;<span class="post_time">...' 
					. $list[$i][posted] . '</span></li>' . "\n";
			}
		}
		else
		{
			/* cache hit */
			for($i = 0; $ < count($list); $i ++)
			{
				echo '<li><img src="' . $list[$i][img] . '" alt="" />&nbsp;&nbsp;<a style="color:' . rand_color() . '"  class="var" href="'
					. $list[$i][link] . '" target="_blank">' . $list[$i][title] . '</a>&nbsp;&nbsp;<span class="post_time">...' 
					. $list[$i][posted] . '</span></li>' . "\n";
			}
		}

		echo '</ul>' . "\n";
		echo '</div><!-- ing end -->' . "\n";
	}

	public function Stock()
	{
		echo '<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>' . "\n";
		echo '<span class="tip_i">' . "\n";
		echo '<img src="/img/pico_right.gif" align="absmiddle" />' . "\n";
		echo '招商银行 (600036) <a href="#stock_chart" class="t">行情图表</a> | ' . "\n";
		echo '<a href="#stock_blogs" class="t"><img src="/img/googleblogsearch.gif" align="absmiddle" alt="google blog search results for 招商银行" border="0" /></a> | ' . "\n";
		echo '<a href="#stock_news" class="t">新闻资讯</a> | ' . "\n";
		echo '<a href="#stock_tn"><img src="/img/technorati.gif" align="absmiddle" alt="technorati results for 招商银行" border="0" /></a>' . "\n";
		echo '</span>' . "\n";
		echo '<hr size="1" color="#eee" style="color: #eee; background-color: #eee; height: 1px; border: 0;" />' . "\n";
		echo '<div class="notify" style="margin-bottom: 5px;">' . "\n";
		echo '<div style="float: right;">' . "\n";
		echo '<a href="#;" onclick="window.scrollto(0, 0);">回到顶部</a>' . "\n";
		echo '</div>' . "\n";
		echo '<span style="font-size: 14px;">' . "\n";
		echo '<img src="http://cdn.v2ex.com/img/icons/silk/chart_line.png" align="absmiddle" border="0" />' . "\n";
		echo '招商银行 (600036) 的行情图表 <a name="stock_chart"></a>' . "\n";
		echo '</span>' . "\n";
		echo '</div>' . "\n";
		echo '<div align="center">' . "\n";
		echo '<script type="text/javascript" src="/js/babel_stock_switcher.js"> </script>' . "\n";
		echo '<script type="text/javascript">market = "sh"; code = "600036";</script>' . "\n";
		echo '<span class="tip_i">图表切换<img src="/img/pico_right.gif" align="absmiddle" /> ' . "\n";
		echo '<a href="#;" onclick="stock_get_realtime();" class="t">分时行情</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_k_min5();" class="t">5 分钟 k 线</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_k_daily();" class="t">日 k 线</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_k_weekly();" class="t">周 k 线</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_k_monthly();" class="t">月 k 线</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_rsi();" class="o">rsi</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_macd();" class="o">macd</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_kdj();" class="o">kdj</a> | ' . "\n";
		echo '<a href="#;" onclick="stock_get_mike();" class="o">mike</a>' . "\n";
		echo '</span>' . "\n";
		echo '<br />' . "\n";
		echo '<img id="stock_chart" src="http://image.sinajs.cn/newchart/min/n/sh600036.gif?1190689481" class="code" />' . "\n";
		echo '</div>' . "\n";
		echo '<hr size="1" color="#eee" style="color: #eee; background-color: #eee; height: 1px; border: 0;" />' . "\n";
		echo '<div class="notify">' . "\n";
		echo '<div style="float: right;"><a href="#;" onclick="window.scrollto(0, 0);">回到顶部</a></div>' . "\n";
		echo '<span style="font-size: 14px;">' . "\n";
		echo '<img src="http://cdn.v2ex.com/img/icons/silk/comments.png" align="absmiddle" border="0" />' . "\n";
		echo '来自 google blog search 的关于 招商银行 (600036) 的最新消息 <a name="stock_blogs"></a>' . "\n";
		echo '</span>' . "\n";
		echo '</div>' . "\n";
	}

	public function Content()
	{
		echo '<div id="content" class="blank">' . "\n";

		if(!$content = $this->cache->load('content'))
		{
			$show = new Show();
			$show->count_of_result = DISPLAY_OF_PAGE;

			if(ROOT)
			{
				$content = $show->getByTags('ALL', true);
			}
			else
			{
				$content = $show->getByTags('ALL');
			}

			for($i = 0; $i < count($content); $i ++)
			{
				$id = $content[$i][id];
				$reply = $show->getTopReply($id);
				$content[$i][content] = format_ubb($content[$i][content]);
				$content[$i][create] = format_ubb($content[$i][content]);
				$content[$i][reply_user] = $reply[reply_user];
				$content[$i][reply_create] = make_descriptive_time($reply[reply_create]);
				$content[$i][reply_content] = $reply[reply_content];
				$content[$i][reply_desc] = $reply[reply_desc]
			}
			$this->cache->save($content, 'content');
			for($i = 0; $i < count($content); $i ++)
			{
				echo '<h3><a class="var" style="color:#006699;" href="' . DOMAIN_NAME . 'view/' . $content[$i][id] . '.html">' . $content[$i][title] . '</a></h3>' . "\n";
				echo '<span class="gray">posted by <a class="var" style="color:#993399;" href="http://www.v2ex.com/u/' 
					. $content[$i][author] . '" target="_blank">' . $content[$i][author] . '</a> on ' . $content[$i][create] 
					. ' cst in <a class="var" style="color:#f7499c;" href="' . DOMAIN_NAME . 'tags/' . $content[$i][tags] 
					. '.html">' . $content[$i][tags] . '</a></span>' . "\n";
				echo '<br /><br />' . "\n";
				echo $content[$i][content] . "\n";
				echo '<br /><br />' . "\n";
				if($content[$i][reply] == 1)
				{
					echo '<span>' . "\n";
					echo '<a class="h" href="' . DOMAIN_NAME . 'view/' . $content[i][id] . '.html">我要评论</a>' . "\n";
					if($content[$i][reply_content])
					{
						echo '<br /><br /><img class="r" src="/themes/'. THEMES . '/images/award_star_gold_1.png" />&nbsp;最新评论：' . "\n";
						echo '<a class="regular" href="' . DOMAIN_NAME . 'view/' . $content[$i][id] . '.html">' . $content[$i][reply_content]. '</a>' . "\n";
						echo '<span class="gray">by&nbsp;' . $content[$i][reply_user] . '&nbsp;' . $content[$i][reply_create] . '</span>' . "\n";
					}
					echo '</span><br /><br />' . "\n";
				}
			}
		}
		else
		{
			/* Cache hit */
			for($i = 0; $i < count($content); $i ++)
			{
				echo '<h3><a class="var" style="color:#006699;" href="' . DOMAIN_NAME . 'view/' . $content[$i][id] . '.html">' . $content[$i][title] . '</a></h3>' . "\n";
				echo '<span class="gray">posted by <a class="var" style="color:#993399;" href="http://www.v2ex.com/u/' 
					. $content[$i][author] . '" target="_blank">' . $content[$i][author] . '</a> on ' . $content[$i][create] 
					. ' cst in <a class="var" style="color:#f7499c;" href="' . DOMAIN_NAME . 'tags/' . $content[$i][tags] 
					. '.html">' . $content[$i][tags] . '</a></span>' . "\n";
				echo '<br /><br />' . "\n";
				echo $content[$i][content] . "\n";
				echo '<br /><br />' . "\n";
				if($content[$i][reply] == 1)
				{
					echo '<span>' . "\n";
					echo '<a class="h" href="' . DOMAIN_NAME . 'view/' . $content[i][id] . '.html">我要评论</a>' . "\n";
					if($content[$i][reply_content])
					{
						echo '<br /><br /><img class="r" src="/themes/'. THEMES . '/images/award_star_gold_1.png" />&nbsp;最新评论：' . "\n";
						echo '<a class="regular" href="' . DOMAIN_NAME . 'view/' . $content[$i][id] . '.html">' . $content[$i][reply_content]. '</a>' . "\n";
						echo '<span class="gray">by&nbsp;' . $content[$i][reply_user] . '&nbsp;' . $content[$i][reply_create] . '</span>' . "\n";
					}
					echo '</span><br /><br />' . "\n";
				}
			}
		}

		echo '</div>' . "\n";
	}

	public function Reply($id)
	{
		$show = new Show();
		$reply = $show->getReply($id);

		echo '<div id="reply" class="blank">' . "\n";
		echo '<a name="reply" class="img"><img src="/img/spacer.gif" width="1" height="1" style="display: none;" /></a>' . "\n";
		echo '<div id="vxreplytop" style="width:650px;">' . "\n";
		echo '<span class="tip_i">' . $count_of_reply . ' 篇回复 | <a onclick="window.scrollto(0,0);" href="#;" class="regular">回到顶部</a> | <a href="#replyform" class="regular">回复主题</a></span>' . "\n";
		echo '</div>' . "\n";

		for($i = 0; $i < count($reply); $i ++))
		{
			echo '<div class="r" style="width:650px;">' . "\n";
			echo '<div style="float: right;"><span class="tip_i">' . $reply[$i][create] . '</span></div>' . "\n";
			echo '<a href="/themes/x/images/1833_n.jpg"><img src="/themes/x/images/1833_s.jpg" align="absmiddle" style="margin-right: 10px;" border="0" /></a>' . "\n";
			echo '<strong><a href="#" style="color: #930" class="var">' . $reply[$i][author] . '</a></strong> ' . "\n";
			echo '<span class="tip_i">' . $reply[$i][desc] . '</span>' . "\n";
			echo '<div style="margin-bottom: -5px;"></div>' . "\n";
			echo '<div style="padding-left: 45px;">' . $reply[$i][content] . '</div>' . "\n";
			echo '</div>' . "\n";
			echo '<hr style="border: 0pt none ; color: rgb(238, 238, 238); background-color: rgb(238, 238, 238); height: 1px;" color="#eeeeee" size="1">' . "\n";
		}

		echo '<div id="vxreplytip" style="width:650px;">' . "\n";
		echo '<a name="replyform" class="img"><img src="17658_files/spacer.gif" style="display: none;" height="1" width="1"></a>' . "\n";
		echo '<span class="tip_i">看完之后有话想说？那就留下一点印记吧！</span>' . "\n";
		echo '</div>' . "\n";
		echo '<div style="width:650px;">' . "\n";
		echo '<form action="/post.php" method="post" name="form_topic_reply" id="form_topic_reply">' . "\n";
		echo '<span style="color: rgb(0, 51, 153);"><img src="/themes/x/images/1833_s.jpg" style="border-left: 2px solid rgb(0, 51, 51); padding: 0px 5px;" align="absmiddle">' . "\n";
		echo '<span style="color:#f7499c;">昵称:' . $_SESSION["user"] . '&nbsp;(未登陆时以guest用户发布.)</span><br><br>' . "\n";
		echo '<textarea name="reply_content" id="reply_content" rows="10" class="quick" onblur="valid("reply_content");"></textarea>' . "\n";
		echo '<input name="method" id="method" value="reply" type="hidden">' . "\n";
		echo '<input name="pid" id="pid" value="' . $pid . '" type="hidden">' . "\n";
		echo '<div id="pro">' . "\n";
		echo '<a href="javascript:reply();" class="btn" style="margin-top:10px;">回复主题</a>' . "\n";
		echo '</div>' . "\n";
		echo '</span>' . "\n";
		echo '</form>' . "\n";
		echo '</div>' . "\n";
		echo '<div class="light_odd" style="margin-bottom:5px; width:650px; clear:both;" align="left">' . "\n";
		echo '<span class="tip_i">' . "\n";
		echo '<a href="#;" onclick="window.scrollto(0,0);" class="regular">回到顶部</a> | ' . "\n";
		echo '<a href="http://www.n7money.cn/" target="_blank" class="regular">返回首页</a>' . "\n";
		echo '</span>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
	}

	public function Related()
	{
		echo '<div id="related" class="blank">' . "\n";
		echo '<img src="/themes/' . THEMES . '/images/page_world.png" alt="" style="position:relative; top:3px;"/><span style="color:#577de7;">&nbsp;&nbsp;你可能会感兴趣的连接&nbsp;...</span>' . "\n";
		echo '<div style="height:10px; overflow:hidden;"></div>' . "\n";
		echo '<ul class="related">' . "\n";
		for($i = 0; $i < count($related); $i ++)
		{
			echo '<li><img src="/themes/x/images/1833_n.jpg" alt="" />&nbsp;&nbsp;<a style="color:' . $relatedcolor[$i] . '"  class="var" href="' . DOMAIN_NAME . 'view/' . $related[$i][id] . '.html" target="_blank">' . $related[$i][title] . '</a>&nbsp;&nbsp;<span class="post_time">...&nbsp;' . $related[$i][lastmodify] . '</span></li>' . "\n";
		}
		echo '</ul>' . "\n";
		echo '</div><!-- related end -->' . "\n";

	}

	public function Topnav()
	{
		echo '<div id="topnav" class="blank">' . "\n";
		echo '<img src="/themes/' . THEMES . '/images/house.png" alt="" />' . "\n";
		echo '<span>' . "\n";
		echo '<a href="' . DOMAIN_NAME . 'index.html">[root@localhost ~]#</a>' . "\n";

		if($options['module']['view'] == true)
		{
			echo 'cat&nbsp;<a href="' . DOMAIN_NAME . 'view/' . $topic_id . '.html">' . $topic_name . '.html</a>' . "\n";
		}

		if($options['module']['tags'] == true)
		{
			echo 'cat *.html | grep "<a href="' . DOMAIN_NAME . 'tags/' . $tags_name . '.html">' . $tags_name . '</a>"' . "\n";
		}

		if($options['module']['manage'] == true)
		{
			echo 'ls -al' . "\n";
		}

		if($options['module']['edit'] == true)
		{
			echo '{*&gt;&nbsp;<a href="' . DOMAIN_NAME . 'manage.html">日志管理</a>*}' . "\n";
			echo 'vim&nbsp;' . $id . '.html"\n"';
		}

		if($options['module']['post'] == true)
		{
			echo '{*&gt;&nbsp;<a href="' . DOMAIN_NAME . 'manage.html">日志管理</a>' . "\n";
			echo 'vim' . "\n";
		}
		echo '</span>' . "\n";
		echo '</div>' . "\n";
	}

	public function Sidebar()
	{
		echo '<div id="sidebar">' . "\n";
		echo '<div class="blank">' . "\n";
		echo '<ul class="tools">' . "\n";
		echo '<li><span>&nbsp;当前用户：' . $_SESSION['user'] . '</span></li>' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/zoom.png" alt="" /><a href="' . DOMAIN_NAME . 'search.html">&nbsp;搜索</a></li>' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/feed.png" alt="" /><a href="' . DOMAIN_NAME . 'feed/walker.rss">&nbsp;rss种子输出</a></li>' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/help.png" alt="" /><a href="' . DOMAIN_NAME . 'help.html">&nbsp;帮助</a></li>' . "\n";
		echo '{if $smarty.session.user == 'guest'}' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/key.png" alt="" /><a href="' . DOMAIN_NAME . 'login.html">&nbsp;登陆</a></li>' . "\n";
		echo '{else}' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/key_go.png" alt="" /><a href="' . DOMAIN_NAME . 'logout.html">&nbsp;登出</a></li>' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/application_osx_terminal.png" alt="" /><a href="' . DOMAIN_NAME . 'manage.html">&nbsp;控制台</a></li>' . "\n";
		echo '{/if}' . "\n";
		echo '<li><img src="/themes/' . THEMES . '/images/music.png" alt="" /><span>&nbsp;最近&nbsp;top</span>' . "\n";
		echo '<ul class="music">' . "\n";
		echo '<li><a href="#">all for you</a></li>' . "\n";
		echo '<li><a href="#">alive</a></li>' . "\n";
		echo '<li><a href="#">four seasons</a></li>' . "\n";
		echo '<li><a href="#">given up</a></li>' . "\n";
		echo '</ul></li>' . "\n";
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
		echo '' . "\n";
		echo '<div class="blank">' . "\n";
		echo '<img src="/themes/' . THEMES . '/images/page_white_code.png" alt="" />' . "\n";
		echo '<span style="line-height:160%;">tags</span>' . "\n";
		echo '<ul class="tags">' . "\n";
		for($i = 0; $i < count($tag); $i ++)
		{
			echo '<li><a href="' . DOMAIN_NAME . 'tags/' .$tag[$i][tags] . '.html">' . $tag[$i][tags] . '&nbsp;(' . $tag[$i][count] . ')</a></li>' . "\n";
		}
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
		echo '' . "\n";
		echo '<div class="blank">' . "\n";
		echo '<img src="/themes/' . THEMES . '/images/world_link.png" alt="" /><span>&nbsp;链接</span>' . "\n";
		echo '<ul class="links">' . "\n";
		for()
		{
			echo '<li><a class="var" style="color:' . rand_color() . '" href="' . $links[$i][url] . '" target="_blank">' . $links[$i][title] . '</a></li>' . "\n";
		}
		echo '</ul>' . "\n";
		echo '</div>' . "\n";
		echo '</div><!-- sidebar end -->' . "\n";
	}

	public function Home()
	{
		$this->Content();
	}

	public function Manage()
	{
		echo '<div id="manage" class="blank">' . "\n";
		echo '<span style="font-size:18px;' . "\n";
		echo 'font-weight:bold;"><img style="position:relative; top:7px;" src="/themes/' . THEMES . '/images/applications-internet.png" alt="" />&nbsp;控制台</span>' . "\n";
		echo '' . "\n";
		echo '<div id="console"><img src="/themes/' . THEMES . '/images/pencil.png" alt="" />&nbsp;<a href="' . DOMAIN_NAME . 'post.html">撰写新文章</a></div>' . "\n";
		echo '<br />' . "\n";
		echo '<div style="padding:5px; border: 2px solid' . "\n";
		echo '#ccc; background-color: #f7f3f7;' . "\n";
		echo 'margin-bottom: 10px; font-size: 12px;' . "\n";
		echo '-moz-border-radius: 10px;' . "\n";
		echo '-webkit-border-radius: 10px;">' . "\n";
		echo '<span><img style="position:relative; top:2px;" src="/themes/' . THEMES . '/images/chart_bar.png" alt="" />&nbsp;' . "\n";
		echo '建立于&nbsp;2007&nbsp;年&nbsp;8&nbsp;月&nbsp;8&nbsp;日,其中&nbsp;' . $count_of_topic . '&nbsp;篇文章共获得了&nbsp;0&nbsp;条评论.</span><br />' . "\n";
		echo '<span style="padding-bottom:2px;' . "\n";
		echo 'border-bottom:1px #e5e5e5 solid;' . "\n";
		echo 'display:block; width:700px;"></span>' . "\n";
		echo '<br />' . "\n";
		echo '<ul class="list">' . "\n";
		for()
		{
			echo '<li style="clear:both;">' . "\n";
			echo '<span class="post"><img src="/themes/' . THEMES . '/images/document.png" alt="" /><a href="' . DOMAIN_NAME . 'view/' . $topic_list[$i][id] . '.html">' . $topic_list[$i][title] . '</a>&nbsp;' . "\n";
			if($topic_list[$i]['public'] == 1)
			{
				echo '<small class="status">... 已公开发布</small>' . "\n";
			}
			else
			{
				echo '<small class="status">... 已私下发布</small>' . "\n";
			}
			echo '</span>' . "\n";
			echo '<span class="process">' . "\n";
			echo '<a class="btn1" href="' . DOMAIN_NAME . 'edit/' . $topic_list[$i][id] . '.html">编辑</a>' . "\n";
			echo '<a class="btn1" href="' . DOMAIN_NAME . 'manage.html" onclick="remove(' . $topic_list[$i][id] . ');">删除</a>' . "\n";
			echo '<!--<a class="btn1" href="#">发布</a>-->' . "\n";
			echo '</span>' . "\n";
			echo '</li>' . "\n";
		}
		echo '</ul>' . "\n";
		echo '<div style="height:0px; clear:both;"></div>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
	}

	public function View()
	{
		$this->Content();
		$this->Reply();
	}

	public function Modify()
	{
		echo '<div id="post" class="blank">' . "\n";
		echo '<span style="font-size:18px;' . "\n";

		if($options['module']['post'] == true)
		{
					echo 'font-weight:bold;"><img style="position:relative; top:7px;" src="/themes/' . THEMES . '/images/document-new.png" alt="" />&nbsp;撰写新文章</span>' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
					echo 'font-weight:bold;"><img style="position:relative; top:7px;" src="/themes/' . THEMES . '/images/document-new.png" alt="" />&nbsp;编辑文章</span>' . "\n";
		}


		echo '<table class="form" border="0" cellpadding="0" cellspacing="0">' . "\n";
		echo '<form name="post" action="/post.php" method="post" id="post">' . "\n";
		echo '<tbody>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" width="100">标题</td>' . "\n";

		if($options['module']['post'] == true)
		{
			echo '<td align="left" width="400"><input class="sll" name="title" id="title" type="text" onblur="valid("title");">' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
			echo '<td align="left" width="400"><input class="sll" name="title" id="title" type="text" onblur="valid("title");" value="' . $edit[0][title] . '">' . "\n";
		}

		echo '<span id="mestitle"></span></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" width="100"</td>' . "\n";
		echo '<td align="left" width="400"><div id="autosave"></div></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" valign="top" width="100">日志内容<span id="mescontent"></span></td>' . "\n";
		echo '<td align="left" width="600">' . "\n";

		if($options['module']['post'] == true)
		{
			echo '<textarea rows="35" class="ml" name="content" id="content" onblur="valid("content");" onchange="autosave();"></textarea>' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
			echo '<textarea rows="35" class="ml" name="content" id="content" onblur="valid("content");" onchange="autosave();">' . $edit[0][content] . '</textarea>' . "\n";
		}

		echo '<input type="hidden" name="method" id="method" value="modify">' . "\n";

		if($options['module']['post'] == true)
		{
			echo '<input type="hidden" name="topic_id" id="topic_id">' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
			echo '<input type="hidden" name="topic_id" id="topic_id" value="' . $edit[0][id] . '">' . "\n";
		}

		echo '</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" width="100">格式</td>' . "\n";
		echo '<td align="left" width="400">' . "\n";
		echo '<select class="sll" name="format" id="format" style="width:150px;">' . "\n";
		echo '<option>ubb</option>' . "\n";
		echo '<option>超文本/xhtml</option>' . "\n";
		echo '<option>ubb/anti-gfw</option>' . "\n";
		echo '</select>' . "\n";
		echo '</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" width="100">评论许可</td>' . "\n";
		echo '<td align="left" width="400">' . "\n";
		echo '<select class="sll" name="reply" id="reply" style="width:200px;">' . "\n";
		echo '<option>任何人都可以评论</option>' . "\n";
		echo '<option>禁止评论</option>' . "\n";
		echo '<option>仅允许我的好友评论</option>' . "\n";
		echo '</select>' . "\n";
		echo '</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" width="100">tags</td>' . "\n";
		echo '<td align="left" width="400">' . "\n";

		if($options['module']['post'] == true)
		{
			echo '<input class="sll" name="tags" id="tags" type="text" style="width:200px;" onblur="valid("tags");">' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
			echo '<input class="sll" name="tags" id="tags" type="text" style="width:200px;" onblur="valid("tags");"  value="' . $edit[0][tags] . '">' . "\n";
		}

		echo '<span id="mestags"></span>' . "\n";
		echo '</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right" width="100">状态</td>' . "\n";
		echo '<td align="left" width="400">' . "\n";
		echo '<select class="sll" name="status" id="status" style="width:100px;">' . "\n";
		echo '<option>公开发布</option>' . "\n";
		echo '<option>私有发布</option>' . "\n";
		echo '<option>草稿</option>' . "\n";
		echo '</select>' . "\n";
		echo '</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td align="right"' . "\n";
		echo 'width="100">发布时间</td>' . "\n";
		echo '<td align="left" width="400">' . "\n";

		if($options['module']['post'] == true)
		{
			echo '<input class="sll" name="created" id="created" type="text" style="width:200px;" value="' . . '">' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
			echo '<input class="sll" name="created" id="created" type="text" style="width:200px;" value="' . $edit[0][create] . '">' . "\n";
		}

		echo '</td>' . "\n";
		echo '</tr>' . "\n";
		echo '</tbody>' . "\n";
		echo '</form>' . "\n";
		echo '</table>' . "\n";
		echo '<br />' . "\n";
		echo '<div id="pro">' . "\n";

		if($options['module']['post'] == true)
		{
			echo '<a id="btn_bug" href="javascript:newTopic();" class="btn">保存</a>' . "\n";
		}
		elseif($options['module']['edit'] == true)
		{
			echo '<a id="btn_bug" href="javascript:modify();" class="btn">保存</a>' . "\n";
		}

		echo '<a style="margin-left:15px;" href="manage.html" class="btn">取消</a>' . "\n";
		echo '</div>' . "\n";
		echo '<div class="bug"></div>' . "\n";
		echo '</div><!-- post end -->' . "\n";
	}

	public function Tags()
	{
		$this->Content();
	}

	public function Login()
	{
		echo '<!doctype html public "-//w3c//dtd xhtml 1.0 transitional//en"' . "\n";
		echo '"http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">' . "\n";
		echo '<head>' . "\n";
		echo '<meta http-equiv="content-type" content="text/html;charset=utf-8" />' . "\n";
		echo '<title>ξ命令提示符</title>' . "\n";
		echo '<link href="/themes/{$THEMES}/styles/login.css" media="screen" rel="stylesheet" type="text/css" />' . "\n";
		echo '</head>' . "\n";
		echo '<body onload="document.forms[0].elements[0].focus();">' . "\n";
		echo '<div id="main" align="center">' . "\n";
		echo '<div id="v2ex" align="left">' . "\n";
		echo '<div class="title">登录</div>' . "\n";
		echo '<hr size="1" color="#eee" style="color: #eee; background-color: #eee; height: 1px; border: 0;" />		<table width="100%" cellpadding="5" cellspacing="0" class="login_form_t">' . "\n";
		echo '<form action="/login.php" method="post">' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80" align="right">用户名:</td>' . "\n";
		echo '<td align="left"><input name="username" type="text" class="line" onfocus="this.style.bordercolor = "#0c0"; this.style.backgroundcolor = "#fff";" onblur="this.style.bordercolor = "#999"; this.style.backgroundcolor = "#f5f5f5";" maxlength="100" /></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80" align="right">密码:</td>' . "\n";
		echo '<td align="left"><input name="password" type="password" class="line" onfocus="this.style.bordercolor = "#0c0"; this.style.backgroundcolor = "#fff";" onblur="this.style.bordercolor = "#999"; this.style.backgroundcolor = "#f5f5f5";" maxlength="32" /></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80"></td>' . "\n";
		echo '<td align="left"><span class="tip"><a href="/passwd.html">我忘记了密码</a> &nbsp;|&nbsp; <a href="/signup.html">注册</a> &nbsp;|&nbsp; <a href="/">游客</a></span></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="80"></td>' . "\n";
		echo '<td valign="middle"><input type="image" src="/themes/{$THEMES}/images/login.gif" alt="登录" /></td>' . "\n";
		echo '</tr>' . "\n";
		echo '<input type="hidden" value="http://www.n7money.cn/" name="return" />			</form>' . "\n";
		echo '</table>' . "\n";
		echo '</div>	' . "\n";
		echo '<div id="bottom" align="center">' . "\n";
		echo '&copy; 2006-2007 <a href="http://www.n7money.cn/" target="_self">v2ex</a>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}

	public function Logout()
	{
		echo '<!doctype html public "-//w3c//dtd xhtml 1.0 transitional//en"' . "\n";
		echo '"http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd">' . "\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">' . "\n";
		echo '<head>' . "\n";
		echo '<meta http-equiv="content-type" content="text/html;charset=utf-8" />' . "\n";
		echo '<title>ξ命令提示符</title>' . "\n";
		echo '<link href="/themes/{$THEMES}/styles/login.css" media="screen" rel="stylesheet" type="text/css" />' . "\n";
		echo '</head>' . "\n";
		echo '<body>' . "\n";
		echo '<div id="main" align="center">' . "\n";
		echo '<div id="v2ex" align="left">' . "\n";
		echo '<div class="title">你已经从 ξ命令提示符 登出</div>' . "\n";
		echo '<hr size="1" color="#eee" style="color: #eee; background-color: #eee; height: 1px; border: 0;" />		<div id="logout">' . "\n";
		echo '<p>没有任何个人信息被留在你现在使用过的计算机上，请对你的隐私放心。</p>' . "\n";
		echo '<p>ξ命令提示符 欢迎你随时再度访问！</p>' . "\n";
		echo '<p>' . "\n";
		echo '<li><a href="/login.html">重新登录</a></li>' . "\n";
		echo '<li><a href="/index.html">返回 ξ命令提示符 首页</a></li>' . "\n";
		echo '<li><a href="/new_features.html" target="_blank">新功能</a></li>' . "\n";
		echo '<li><a href="/help.html" target="_blank">帮助</a> <!--<img src="/themes/{$THEMES}/images/ext.png" align="absmiddle" />--></li>' . "\n";
		echo '</p>' . "\n";
		echo '</div>' . "\n";
		echo '</div>	' . "\n";
		echo '<div id="bottom" align="center">' . "\n";
		echo '&copy; 2006-2007 <a href="http://www.n7money.cn/" target="_self">ξ命令提示符</a>' . "\n";
		echo '</div>' . "\n";
		echo '</div>' . "\n";
		echo '</body>' . "\n";
		echo '</html>' . "\n";
	}
}
?>

-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2007 年 08 月 13 日 15:49
-- 服务器版本: 5.0.37
-- PHP 版本: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `console_walker`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `walker_categories`
-- 

DROP TABLE IF EXISTS `walker_categories`;
CREATE TABLE IF NOT EXISTS `walker_categories` (
  `cat_id` int(10) unsigned NOT NULL auto_increment,
  `cat_name` varchar(20) NOT NULL,
  `cat_desc` varchar(60) NOT NULL,
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `walker_categories`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `walker_post`
-- 

DROP TABLE IF EXISTS `walker_post`;
CREATE TABLE IF NOT EXISTS `walker_post` (
  `post_id` int(10) unsigned NOT NULL auto_increment,
  `post_cid` int(10) unsigned NOT NULL,
  `post_title` varchar(60) NOT NULL,
  `post_create` int(10) unsigned NOT NULL,
  `post_author` varchar(25) NOT NULL,
  `post_content` text NOT NULL,
  `post_hits` int(10) unsigned NOT NULL,
  `post_show` tinyint(3) unsigned NOT NULL default '1',
  `post_public` tinyint(3) unsigned NOT NULL default '1',
  `post_desc` varchar(100) NOT NULL,
  `post_tags` varchar(50) NOT NULL,
  `post_lastmodify` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`post_id`),
  FULLTEXT KEY `post_title` (`post_title`,`post_content`),
  FULLTEXT KEY `post_tag` (`post_tags`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `walker_post`
-- 

INSERT INTO `walker_post` VALUES (1, 1, 'Project Babel v0.5 Monster Inc Released!', 1182275022, 'Walkin', '<br />\r\n				<br />\r\n				安装及升级文档：<br />\r\n				<br />\r\n				<a href="http://labs.v2ex.com/installation.php" rel="nofollow external" class="tpc">http://labs.v2ex.com/installation.php</a><br />\r\n				<br />\r\n				Project Babel 是一款构建于 LAMP 技术架构（Linux + Apache + MySQL + PHP）上的社区软件，以 GPL 2.0 协议开放源代码发布。项目网站位于 Google Code 平台：<br />\r\n				<br />\r\n				<a href="http://code.google.com/p/project-babel" rel="nofollow external" class="tpc">http://code.google.com/p/project-babel</a><br />\r\n				<br />\r\n				V2EX.com 即运行在 Project Babel 的最新版本上。<br />\r\n				<br />\r\n				<a href="http://www.v2ex.com/" rel="nofollow external" class="tpc">http://www.V2EX.com/</a><br />\r\n				<br />\r\n				v0.5 是 Project Babel 的最新发布版本（也称为严肃版本），发布代号 Monster Inc（怪物公司）。<br />\r\n				<br />\r\n				Project Babel 历次严肃版本的发布日期及代号：<br />\r\n				<br />\r\n				R500 - 2006-7-10 - Banana Co（香蕉公司）<br />\r\n				<br />\r\n				R215 - 2006-4-10 - Silver Town（白银小镇）<br />\r\n				<br />\r\n				下一个严肃版本 v0.6 将在 2007 年 10 月 10 日发布，代号 Fibonacci Farm（菲波农场）。<br />\r\n				<br />\r\n				关于 Project Babel 的安装文档及更多信息，请看在 2007 年 5 月 31 日同步更新了的 V2EX Labs：<br />\r\n				<br />\r\n				<a href="http://labs.v2ex.com/" rel="nofollow external" class="tpc">http://labs.v2ex.com/</a>\r\n				<br /><br />', 1, 1, 1, 'test', 'v2ex,babel', 1182275035);
INSERT INTO `walker_post` VALUES (2, 1, '股指期货词汇 - 股票指数', 1182275022, 'Livid', '<br><br>股票指数，是衡量和反应所选择的一组股票的价格变动指标。<br>\r\n\r\n<br>\r\n\r\n不同的股票市场有不同的股票指数，同一股票市场也可以有多个股票指数。<br>\r\n\r\n<br>\r\n\r\n不同股票指数的区别主要在于其具体的编制方法不同，即具体的抽样和计算方法不同。<br>\r\n\r\n<br>\r\n\r\n一般而言，在编制股票指数时，首先需要从所有上市股票中选取一定数量的样本股票。在选择样本股票时，通常选择那些价格变动趋势能够反应整个股票市场或某一部分市场价格变动情况的代表性股票。<br>\r\n\r\n<br>\r\n\r\n在确定了样本股票之后，还要选择一种计算简便、易于修正并能保持统计口径的一致性和连续性的计算公式作为编制的工具。<br>\r\n\r\n<br>\r\n\r\n通常的计算方法有如下三种：算术平均法、加权平均法和几何平均法。然后在此基础上，确定一个基期日，并将某一既定的整数(如100、1000等)定为该基期的股票指数。<br>\r\n\r\n<br>\r\n\r\n以后，则根据各时期的股票价格和基期股票价格的对比，计算出升降百分比，即可得出该时点的股票指数。<br>\r\n\r\n<br>', 1, 1, 1, 'test', 'livid', 1182275035);

-- --------------------------------------------------------

-- 
-- 表的结构 `walker_reply`
-- 

DROP TABLE IF EXISTS `walker_reply`;
CREATE TABLE IF NOT EXISTS `walker_reply` (
  `reply_id` int(10) unsigned NOT NULL auto_increment,
  `reply_pid` int(10) unsigned NOT NULL,
  `reply_uid` int(10) unsigned NOT NULL,
  `reply_create` int(10) unsigned NOT NULL,
  `reply_content` text NOT NULL,
  `reply_desc` varchar(60) NOT NULL,
  `reply_lastmodify` int(10) NOT NULL,
  PRIMARY KEY  (`reply_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `walker_reply`
-- 

INSERT INTO `walker_reply` VALUES (1, 1, 1, 1182275022, '很少有什么东西是只升不降的啊。', 'test', 1182275022);
INSERT INTO `walker_reply` VALUES (2, 1, 1, 1182275022, '我想一大部分的原因是访问速度的问题吧\r\n还有好多以前活跃一段时间 然后就消失了的', 'test', 1182275022);

-- --------------------------------------------------------

-- 
-- 表的结构 `walker_user`
-- 

DROP TABLE IF EXISTS `walker_user`;
CREATE TABLE IF NOT EXISTS `walker_user` (
  `usr_id` int(10) unsigned NOT NULL auto_increment,
  `usr_name` varchar(25) NOT NULL,
  `usr_nickname` varchar(20) NOT NULL,
  `usr_password` varchar(32) NOT NULL,
  `usr_sex` varchar(10) NOT NULL,
  `usr_desc` text NOT NULL,
  PRIMARY KEY  (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `walker_user`
-- 

INSERT INTO `walker_user` VALUES (1, 'always.8@gmail.com', 'ξ命令提示符', '11f7a845d64234e89d5e8612ebe0882f', '男', '凌乱的住处，嗜酒，不只一台电脑，无线网络覆盖，坐在马桶上用 PDA 读 RSS，没有女朋友，有自己极其痴迷的事物，对任何工作没有任何热情，不向往什么社会认同感，内心敏感，与父母关系紧张却又疏离，手淫，自言自语，喜欢用很大的声音听X-Japan和安室奈美惠的音乐．');


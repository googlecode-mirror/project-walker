<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet type="text/xsl" href="/xslt/rss2.xsl" media="screen"?>
<rss version="2.0"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title>Latest from ξ命令提示符</title>
		<link>http://www.n7money.cn/</link>
		<description>RSS - ξ命令提示符</description>
		<category>Technology</category>

		<language>zh_cn</language>
        {section name=i loop=$channel}
		<item>
			<title>{$channel[i].post_title}</title>
			<link>http://www.n7money.cn/view/{$channel[i].post_id}.html</link>

			<comments>http://www.n7money.cn/view/{$channel[i].post_id}.html#reply</comments>
			<dc:creator>{$channel[i].post_author}</dc:creator>
			<author>{$channel[i].post_author}</author>
			<enclosure url="http://www.v2ex.com/img/p/7374.jpg" type="image/jpeg" />
			<category>{$channel[i].post_tags}</category>

			<description>
			{$channel[i].post_content|truncate:100:"...":true|strip_tags}
			{*$channel[i].post_content|truncate:100:"...":true|strip_tags*}
			</description>
			<pubDate>{$channel[i].post_create|date_format:" %d, %b %H:%M"}</pubDate>

			<guid>http://www.n7money.cn/view/{$channel[i].post_id}.html</guid>
		</item>
        {/section}
	</channel>
</rss>

<?php
function make_descriptive_time($unix_timestamp)
{
	$now = intval(time());
	$diff = $now - $unix_timestamp;

	if ($diff > (86400 * 30)) {
		$m_span = intval($diff / (86400 * 30));
		$d_diff = $diff % ($m_span * (86400 * 30));
		if ($d_diff > 86400) {
			$d_span = intval($d_diff / 86400);
			return $m_span . ' 月 ' . $d_span . ' 天前';
		} else {
			return $m_span . ' 月前';
		}
	}

	if ($diff > 86400) {
		$d_span = intval($diff / 86400);
		$h_diff = $diff % 86400;
		if ($h_diff > 3600) {
			$h_span = intval($h_diff / 3600);
			return $d_span . ' 天 ' . $h_span . ' 小时前';
		} else {
			return $d_span . ' 天前';
		}
	}

	if ($diff > 3600) {
		$h_span = intval($diff / 3600);
		$m_diff = $diff % 3600;
		if ($m_diff > 60) {
			$m_span = intval($m_diff / 60);
			return $h_span . ' 小时 ' . $m_span . ' 分钟前';
		} else {
			return $h_span . ' 小时前';
		}
	}

	if ($diff > 60) {
		$span = floor($diff / 60);
		$secs = $diff % 60;
		if ($secs > 0) {
			return $span . ' 分 ' . $secs . ' 秒前';
		} else {
			return $span . ' 分钟前';
		}
	}

	return $diff . ' 秒前';
}

function rand_color($array = false, $count = 10)
{
	$color = array('#000033', '#000066', '#000099', '#0063dc', '#006600', 
		'#006600', '#006666', '#009966', '#333333', '#333399', '#336666', 
		'#339999', '#444444', '#505050', '#660000', '#660066', '#663300', 
		'#663366', '#666600', '#666633', '#666666', '#666677', '#666699', 
		'#669933', '#669999', '#676777', '#888888', '#990000', '#990099', 
		'#993300', '#993333', '#993366', '#999900', '#999933', '#999999',
		'#ff9900', '#0000ee', '#0063dc', 'f7499c');

	if($array == true)
	{
		shuffle($color);
		return array_splice($color, 10);
	}
	else
	{
		return $color[rand(0, 36)];
	}
}

function format_ubb($text, $emoticon = true) {
	$text = str_replace('<', '&lt;', $text);
	$text = str_replace('>', '&gt;', $text);

	$p[0] = '#\[img\]([\w]+?://[\w\#$%&~/.\-;:=,' . "'" . '?@\[\]+]*?)\[/img\]#is';

	// matches a [url]xxxx://www.livid.cn[/url] code..
	$p[1] = "#\[url\]([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*?)\[/url\]#is";

	// [url]www.livid.cn[/url] code.. (no xxxx:// prefix).
	$p[2] = "#\[url\]((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*?)\[/url\]#is";

	// [url=xxxx://www.phpbb.com]phpBB[/url] code..
	$p[3] = "#\[url=([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";

	// [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
	$p[4] = "#\[url=((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";

	// [media,width,height]xxxx://www.livid.cn/example.mp3[/media] code..
	$p[5] = "#\[media,([0-9]*),([0-9]*)\]([\w]+?://[\w\#$%&~/.\-;:=,?!@\(\)\[\]+]*?)\[\/media\]#is";

	// [email]user@domain.tld[/email] code..
	$p[6] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";

	$p[7] = '/\[url\]([^?].*?)\[\/url\]/i';

	$p[8] = '/\[b\](.*?)\[\/b\]/i';

	$p[9] = '/\[strong\](.*?)\[\/strong\]/i';

	$p[10] = '/\[i\](.*?)\[\/i\]/i';

	$p[11] = '/\[em\](.*?)\[\/em\]/i';

	$p[12] = '/\[go=([a-zA-Z_\-0-9]+)\](.*?)\[\/go\]/';

	$p[13] = '/\[s\](.*?)\[\/s\]/i';

	$r[0] = '<img class="code" src="$1" border="0" />';
	$r[1] = '<a href="$1" rel="nofollow external" class="tpc">$1</a>';
	$r[2] = '<a href="http://$1" rel="nofollow external" class="tpc">http://$1</a>';
	$r[3] = '<a href="$1" rel="nofollow external" class="tpc" target="_blank">$2</a>';
	$r[4] = '<a href="http://$1" rel="nofollow external" class="tpc">$2</a>';
	$r[5] = '<embed width="$1" height="$2" src="$3" autostart="true" loop="false" />';
	$r[6] = '<a class="tpc" href="mailto:$1">$1</a>';
	$r[7] = '<a class="tpc" href="$1">$1</a>';
	$r[8] = '<strong>$1</strong>';
	$r[9] = '<strong>$1</strong>';
	$r[10] = '<em>$1</em>';
	$r[11] = '<em>$1</em>';
	$r[12] = '讨论区 [ <a href="/go/$1" class="tpc">$2</a> ]';
	$r[13] = '<strike>$1</strike>';

	$text = preg_replace($p, $r, $text);

	preg_match('/\[code\]/i', $text, $_m_code_open);
	preg_match('/\[\/code\]/i', $text, $_m_code_close);

	preg_match('/\[quote\]/i', $text, $_m_quote_open);
	preg_match('/\[\/quote\]/i', $text, $_m_quote_close);

	$text = nl2br($text);

	if (count($_m_code_open) == count($_m_code_close)) {
		$text = str_ireplace('[code]', '<div class="code">', $text);
		$text = str_ireplace('[/code]', '</div>', $text);
	}

	if (count($_m_quote_open) == count($_m_quote_close)) {
		$text = str_ireplace("[quote]\n", '[quote]', $text);
		$text = str_ireplace("\n[/quote]", '[/quote]', $text);
		$text = str_ireplace('[quote]', '<div class="quote">', $text);
		$text = str_ireplace('[/quote]', '</div>', $text);
	}

	$text = str_ireplace('</div><br />', '</div>', $text);

	// smiles:
	/*if ($emoticon) {
		$text = str_ireplace(':)', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_smile.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace(':-)', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_smile.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace(':o', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_surprised.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace(':-o', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_surprised.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace(':(', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_unhappy.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace(':-(', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_unhappy.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_replace(':D', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_grin.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_replace(':-D', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_grin.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace(':p', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_tongue.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace('^_^', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_happy.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace('^-^', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_happy.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace('^o^', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_happy.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
		$text = str_ireplace('^^', '<img src="http://' . BABEL_DNS_DOMAIN . '/img/icons/silk/emoticon_happy.png" align="absmiddle" style="padding: 0px 2px 0px 2px;" border="0" />', $text);
	}*/
	return $text;
}

function check_login()
{
	if(isset($_SESSION['user']) && $_SESSION['user'] == 'guest')
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'login.html';
		header("Location: http://$host$uri/$extra");
	}
}
?>

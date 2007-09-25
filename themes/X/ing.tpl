				<div id="ing" class="blank">
					<img src="/themes/{$themes}/images/hourglass.png" alt="" style="position:relative; top:3px;"/><span style="color:#577DE7;">&nbsp;[root@localhost ~]# history</span>
					<div style="height:10px; overflow:hidden;"></div>
					<ul class="ing">
					{section name=i loop=$ing}
						<li><img src="{*$ing[i].img|default:"/themes/X/images/1833_n.jpg"*}/themes/X/images/1833_n.jpg" alt="" />&nbsp;&nbsp;<a style="color:{$ingColor[i]|default:"#577DE7"};"  class="var" href="{$ing[i].link}" target="_blank">{$ing[i].title}</a>&nbsp;&nbsp;<span class="post_time">...{$ing[i].posted}</span></li>
					{/section}
					</ul>
				</div><!-- ing end -->

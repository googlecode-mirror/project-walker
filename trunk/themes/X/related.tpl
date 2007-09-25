				<div id="related" class="blank">
					<img src="/themes/{$themes}/images/page_world.png" alt="" style="position:relative; top:3px;"/><span style="color:#577DE7;">&nbsp;&nbsp;你可能会感兴趣的连接&nbsp;...</span>
					<div style="height:10px; overflow:hidden;"></div>
					<ul class="related">
					{section name=i loop=$related}
						<li><img src="/themes/X/images/1833_n.jpg" alt="" />&nbsp;&nbsp;<a style="color:{$relatedColor[i]|default:"#577DE7"};"  class="var" href="{$dns}view/{$related[i].id}.html" target="_blank">{$related[i].title}</a>&nbsp;&nbsp;<span class="post_time">...&nbsp;{$related[i].lastmodify}</span></li>
					{/section}
					</ul>
				</div><!-- related end -->

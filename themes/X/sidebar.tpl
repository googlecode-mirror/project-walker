			<div id="sidebar">
				<div class="blank">
					<ul class="tools">
						<li><span>&nbsp;当前用户：{$smarty.session.user}</span></li>
						<li><img src="/themes/{$themes}/images/zoom.png" alt="" /><a href="{$dns}search.html">&nbsp;搜索</a></li>
						<li><img src="/themes/{$themes}/images/feed.png" alt="" /><a href="{$dns}feed/walker.rss">&nbsp;RSS种子输出</a></li>
						<li><img src="/themes/{$themes}/images/help.png" alt="" /><a href="{$dns}help.html">&nbsp;帮助</a></li>
						{if $smarty.session.user == 'guest'}
						<li><img src="/themes/{$themes}/images/key.png" alt="" /><a href="{$dns}login.html">&nbsp;登陆</a></li>
						{else}
						<li><img src="/themes/{$themes}/images/key_go.png" alt="" /><a href="{$dns}logout.html">&nbsp;登出</a></li>
						<li><img src="/themes/{$themes}/images/application_osx_terminal.png" alt="" /><a href="{$dns}manage.html">&nbsp;控制台</a></li>
						{/if}
						<li><img src="/themes/{$themes}/images/music.png" alt="" /><span>&nbsp;最近&nbsp;Top</span>
					    <ul class="music">
						    <li><a href="#">All for you</a></li>
							<li><a href="#">Alive</a></li>
							<li><a href="#">Four Seasons</a></li>
							<li><a href="#">Given Up</a></li>
						</ul></li>
					</ul>
				</div>

				<div class="blank">
					<img src="/themes/{$themes}/images/page_white_code.png" alt="" />
					<span style="line-height:160%;">Tags</span>
					<ul class="tags">
						{section name=i loop=$tag}
						<li><a href="{$dns}tags/{$tag[i].tags}.html">{$tag[i].tags}&nbsp;({$tag[i].count})</a></li>
						{/section}
					</ul>
				</div>

				<div class="blank">
					<img src="/themes/{$themes}/images/world_link.png" alt="" /><span>&nbsp;链接</span>
					<ul class="links">
						{section name=i loop=$links}
						<li><a {if $links[i].color} class="var" style="color:{$links[i].color|default:"#577DE7"};"{/if} href="{$links[i].url}" target="_blank">{$links[i].title}</a></li>
						{/section}
					</ul>
				</div>
			</div><!-- sidebar end -->

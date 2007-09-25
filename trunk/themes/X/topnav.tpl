				<div id="topnav" class="blank">
					<img src="/themes/{$themes}/images/house.png" alt="" />
					<span>
					<a href="{$dns}index.html">[root@localhost ~]#</a>
					{if $topic_id}
					cat&nbsp;<a href="{$dns}view/{$topic_id}.html">{$topic_name}.html</a>
					{elseif $tags_name}
					cat *.html | grep "<a href="{$dns}tags/{$tags_name}.html">{$tags_name}</a>"
					{/if}

					{if $smarty.server.REQUEST_URI == '/manage.html'}
					ls -al
					{/if}

					{if $smarty.server.REQUEST_URI|regex_replace:"/\/\d+\.html/":"" == '/edit'}
					{*&gt;&nbsp;<a href="{$dns}manage.html">日志管理</a>*}
					vim&nbsp;{$smarty.server.REQUEST_URI|replace:"/edit/":""}
					{/if}

					{if $smarty.server.REQUEST_URI == '/post.html'}
					{*&gt;&nbsp;<a href="{$dns}manage.html">日志管理</a>*}
					vim
					{/if}
					</span>
				</div>

				<div id="flickr" class="blank" style="height:160px;">
					<img src="/themes/{$themes}/images/flickr_logo.gif" alt="" style="border:0px; position:relative; top:5px;" />
					<span style="color:#577DE7;">[root@localhost ~]ls *.jpg *.gif *.png</span>
					<br /><br />
					<ul>
					{section name=i loop=$flickr}
					<li><a href="{$flickr[i].link}" target="_blank"><span>{$flickr[i].name}</span><img src="{$flickr[i].url}" alt="" />{$flickr[i].description}</a></li>
					{/section}
					</ul>
				</div><!-- flickr end -->

<?php
	$options = get_option('inove_options');

	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>

<!-- sidebar START -->
<div id="sidebar">

<!-- sidebar north START -->
<div id="northsidebar" class="sidebar">

	<!-- feeds -->
	<div class="widget widget_feeds">
		<div class="content">
		
			
			<div id="subscribe">
				<a rel="external nofollow" id="feedrss" title="<?php _e('Subscribe to this blog...', 'inove'); ?>" href="<?php echo $feed; ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'inove'); ?></a>
				<?php if($options['feed_readers']) : ?>
					<ul id="feed_readers">
						<li id="google_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Google', 'inove'); ?>" href="http://fusion.google.com/add?feedurl=<?php echo $feed; ?>"><span><?php _e('Google', 'inove'); ?></span></a></li>
						<li id="youdao_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Youdao', 'inove'); ?>" href="http://reader.youdao.com/#url=<?php echo $feed; ?>"><span><?php _e('Youdao', 'inove'); ?></span></a></li>
						<li id="xianguo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Xian Guo', 'inove'); ?>" href="http://www.xianguo.com/subscribe.php?url=<?php echo $feed; ?>"><span><?php _e('Xian Guo', 'inove'); ?></span></a></li>
						<li id="zhuaxia_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Zhua Xia', 'inove'); ?>" href="http://www.zhuaxia.com/add_channel.php?url=<?php echo $feed; ?>"><span><?php _e('Zhua Xia', 'inove'); ?></span></a></li>
						<li id="yahoo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('My Yahoo!', 'inove'); ?>"	href="http://add.my.yahoo.com/rss?url=<?php echo $feed; ?>"><span><?php _e('My Yahoo!', 'inove'); ?></span></a></li>
						<li id="newsgator_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('newsgator', 'inove'); ?>"	href="http://www.newsgator.com/ngs/subscriber/subfext.aspx?url=<?php echo $feed; ?>"><span><?php _e('newsgator', 'inove'); ?></span></a></li>
						<li id="bloglines_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('Bloglines', 'inove'); ?>"	href="http://www.bloglines.com/sub/<?php echo $feed; ?>"><span><?php _e('Bloglines', 'inove'); ?></span></a></li>
						<li id="inezha_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'inove'); _e('iNezha', 'inove'); ?>"	href="http://inezha.com/add?url=<?php echo $feed; ?>"><span><?php _e('iNezha', 'inove'); ?></span></a></li>
					</ul>
				<?php endif; ?>
			</div>
			<?php if($options['feed_email'] && $options['feed_url_email']) : ?>
				<a rel="external nofollow" id="feedemail" title="<?php _e('Subscribe to this blog via email...', 'inove'); ?>" href="<?php echo $options['feed_url_email']; ?>"><?php _e('Email feed', 'inove'); ?></a>
			<?php endif; if($options['twitter'] && $options['twitter_username']) : ?>
				<a id="followme" title="<?php _e('Follow me!', 'inove'); ?>" href="http://twitter.com/<?php echo $options['twitter_username']; ?>/"><?php _e('Twitter', 'inove'); ?></a>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
	</div>

	<!-- showcase -->
	<?php if( $options['showcase_content'] && (
		($options['showcase_registered'] && $user_ID) || 
		($options['showcase_commentator'] && !$user_ID && isset($_COOKIE['comment_author_'.COOKIEHASH])) || 
		($options['showcase_visitor'] && !$user_ID && !isset($_COOKIE['comment_author_'.COOKIEHASH]))
	) ) : ?>
		<div class="widget">
			<?php if($options['showcase_caption']) : ?>
				<h3><?php if($options['showcase_title']){echo($options['showcase_title']);}else{_e('Showcase', 'inove');} ?></h3>
			<?php endif; ?>
			<div class="content">
				<?php echo($options['showcase_content']); ?>
			</div>
		</div>
	<?php endif; ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('north_sidebar') ) : ?>

	<!-- posts -->
	<?php
		if (is_single()) {
			$posts_widget_title = 'Recent Posts';
		} else {
			$posts_widget_title = 'Random Posts';
		}
	?>

	<div class="widget">
		<h3><?php echo $posts_widget_title; ?></h3>
		<ul>
			<?php
				if (is_single()) {
					$posts = get_posts('numberposts=10&orderby=post_date');
				} else {
					$posts = get_posts('numberposts=5&orderby=rand');
				}
				foreach($posts as $post) {
					setup_postdata($post);
					echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$post = $posts[0];
			?>
		</ul>
	</div>

	<!-- recent comments -->
	<?php if( function_exists('wp_recentcomments') ) : ?>
		<div class="widget">
			<h3>Recent Comments</h3>
			<ul>
				<?php wp_recentcomments('limit=5&length=16&post=false&smilies=true'); ?>
			</ul>
		</div>
	<?php endif; ?>

	<!-- tag cloud -->
	<div id="tag_cloud" class="widget">
		<h3>Tag Cloud</h3>
		<?php wp_tag_cloud('smallest=8&largest=16'); ?>
	</div>

<?php endif; ?>
</div>
<!-- sidebar north END -->

<div id="centersidebar">

	<!-- sidebar east START -->
	<div id="eastsidebar" class="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('east_sidebar') ) : ?>

		<!-- categories -->
		<div class="widget widget_categories">
			<h3>Categories</h3>
			<ul>
				<?php wp_list_categories('sort_column=name&optioncount=0&depth=1'); ?>
			</ul>
		</div>

	<?php endif; ?>
	</div>
	<!-- sidebar east END -->

	<!-- sidebar west START -->
	<div id="westsidebar" class="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('west_sidebar') ) : ?>

		<!-- blogroll -->
		<div class="widget widget_links">
			<h3>Blogroll</h3>
			<ul>
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			</ul>
		</div>

	<?php endif; ?>
	</div>
	<!-- sidebar west END -->
	<div class="fixed"></div>
</div>

<!-- sidebar south START -->
<div id="southsidebar" class="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('south_sidebar') ) : ?>

	<!-- archives -->
	<div class="widget">
		<h3>Archives</h3>
		<?php if(function_exists('wp_easyarchives_widget')) : ?>
			<?php wp_easyarchives_widget("mode=none&limit=6"); ?>
		<?php else : ?>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		<?php endif; ?>
	</div>

	<!-- meta -->
	<div class="widget">
		<h3>Meta</h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
		</ul>
	</div>
                

<?php endif; ?>

	
        <div class="widget">
                <h3>Tag Develop</h3>
        </div>
        <div width="100%" style="padding-left:20px;">
        <div id="wpcumuluscontent3408423"><embed type="application/x-shockwave-flash" src="http://stblog.baidu-tech.com/wp-content/plugins/wp-cumulus/tagcloud.swf?r=4179456" width="225" height="200" id="tagcloudflash" name="tagcloudflash" bgcolor="#ffffff" quality="high" wmode="transparent" allowscriptaccess="always" flashvars="tcolor=0x000000&amp;tcolor2=0x68BCE2&amp;hicolor=0xE66D50&amp;tspeed=100&amp;distr=true&amp;mode=tags&amp;tagcloud=%3Ctags%3E%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e5%2589%258d%25e7%25ab%25af%27+class%3D%27tag-link-163%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E5%89%8D%E7%AB%AF%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e5%2589%258d%25e7%25ab%25af%25e6%258a%2580%25e6%259c%25af%27+class%3D%27tag-link-39%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E5%89%8D%E7%AB%AF%E6%8A%80%E6%9C%AF%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e5%259b%25bd%25e9%2599%2585%25e5%258c%2596%27+class%3D%27tag-link-105%27+title%3D%273%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+12.540540540541pt%3B%27%3E%E5%9B%BD%E9%99%85%E5%8C%96%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e5%25a4%259a%25e5%25aa%2592%25e4%25bd%2593%27+class%3D%27tag-link-109%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E5%A4%9A%E5%AA%92%E4%BD%93%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e6%2580%25a7%25e8%2583%25bd%27+class%3D%27tag-link-41%27+title%3D%275%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+19.351351351351pt%3B%27%3E%E6%80%A7%E8%83%BD%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e6%258a%25bd%25e6%25a0%25b7%25e5%25ae%259e%25e9%25aa%258c%27+class%3D%27tag-link-137%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E6%8A%BD%E6%A0%B7%E5%AE%9E%E9%AA%8C%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e6%2595%25b0%25e6%258d%25ae%25e6%258c%2596%25e6%258e%2598%27+class%3D%27tag-link-9%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E6%95%B0%E6%8D%AE%E6%8C%96%E6%8E%98%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e6%2597%25a0%25e7%25ba%25bf%27+class%3D%27tag-link-83%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E6%97%A0%E7%BA%BF%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e6%25a3%2580%25e7%25b4%25a2%25e6%2589%25a9%25e5%25b1%2595%27+class%3D%27tag-link-126%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E6%A3%80%E7%B4%A2%E6%89%A9%E5%B1%95%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e6%25b5%2581%25e9%2587%258f%25e5%2588%2587%25e5%2588%2586%27+class%3D%27tag-link-138%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E6%B5%81%E9%87%8F%E5%88%87%E5%88%86%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e8%25af%25ad%25e4%25b9%2589%25e6%2590%259c%25e7%25b4%25a2%27+class%3D%27tag-link-123%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E8%AF%AD%E4%B9%89%E6%90%9C%E7%B4%A2%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e8%25af%25ad%25e9%259f%25b3%25e8%25af%2586%25e5%2588%25ab%27+class%3D%27tag-link-110%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E%E8%AF%AD%E9%9F%B3%E8%AF%86%E5%88%AB%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D%25e8%25b4%25b4%25e5%2590%25a7%25e6%258a%2580%25e6%259c%25af%27+class%3D%27tag-link-20%27+title%3D%276%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+22pt%3B%27%3E%E8%B4%B4%E5%90%A7%E6%8A%80%E6%9C%AF%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3D3d%27+class%3D%27tag-link-48%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3E3d%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3Dhtml5%27+class%3D%27tag-link-13%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3Ehtml5%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3Djs%27+class%3D%27tag-link-47%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3Ejs%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3Djs%25e4%25bb%25a3%25e7%25a0%2581%25e5%258e%258b%25e7%25bc%25a9%27+class%3D%27tag-link-164%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3Ejs%E4%BB%A3%E7%A0%81%E5%8E%8B%E7%BC%A9%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3Dlamp%27+class%3D%27tag-link-29%27+title%3D%274%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+16.324324324324pt%3B%27%3Elamp%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3Dlinux%25e5%2586%2585%25e6%25a0%25b8%27+class%3D%27tag-link-120%27+title%3D%272%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+8pt%3B%27%3Elinux%E5%86%85%E6%A0%B8%3C%2Fa%3E%0A%3Ca+href%3D%27http%3A%2F%2Fstblog.baidu-tech.com%2F%3Ftag%3Dphp%27+class%3D%27tag-link-32%27+title%3D%274%E4%B8%AA%E4%B8%BB%E9%A2%98%27+style%3D%27font-size%3A+16.324324324324pt%3B%27%3Ephp%3C%2Fa%3E%3C%2Ftags%3E"></div>
        <div class="widget">
                <h3>&nbsp;</h3>
        </div>

        <div class="widget" style="margin-bottom:10px;">
                <h3>Tag Music</h3>
        </div>
        <div style="padding-left:30px;">
        <embed src="http://www.xiami.com/widget/8811185_151128,375188,1768986144,377528,74790,75042,3450523,3479719,1769091135,58661,1769878352,1770700059,_235_346_FF8719_494949_0/multiPlayer.swf" type="application/x-shockwave-flash" width="235" height="346" wmode="opaque"></embed>
        </div>
        </div>
        <div class="widget">
                <h3>&nbsp;</h3>
        </div>

        <div class="widget" style="margin-bottom:10px;">
                <h3>Tag Weibo</h3>
        </div>
        <div>
                <iframe width="100%" height="850" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=850&fansRow=2&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=2049178385&verifier=b53de27a&dpc=1"></iframe>
        </div>

        <div class="widget">
                <h3>&nbsp;</h3>
        </div>
                
	<div class="widget">
		<a id="saelogo" href="http://yanghome.sinaapp.com/" target="_blank">
		<img width="270" height="100"  src="http://yanghome.sinaapp.com/images/logo.png" title="Powered by Sina App Engine" /></a>
	</div>

	<div class="widget">
		<script type="text/javascript">document.write('<iframe width="300" height="210" frameborder="0" scrolling="no" src="http://widget.weibo.com/relationship/bulkfollow.php?language=zh_cn&uids=2049178385,2213749574&wide=1&color=C2D9F2,FFFFFF,0082CB,666666&showtitle=1&showinfo=1&sense=0&verified=1&count=5&refer='+encodeURIComponent(location.href)+'&dpc=1"></iframe>')</script>
	</div>
</div>
<!-- sidebar south END -->

</div>
<!-- sidebar END -->

	</div>
	<!-- main END -->

	<?php
		$options = get_option('inove_options');
		global $inove_nosidebar;
		if(!$options['nosidebar'] && !$inove_nosidebar) {
			get_sidebar();
		}
	?>
	<div class="fixed"></div>
</div>
<!-- content END -->

<!-- footer START -->
<div id="footer">
	<a id="gotop" href="#" onclick="MGJS.goTop();return false;"><?php _e('Top', 'inove'); ?></a>
	<!--<a id="powered" href="http://wordpress.org/">WordPress</a>-->
	<div id="copyright">
		<?php
			global $wpdb;
			$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes->firstyear;
				$lastpost_year = $post_datetimes->lastyear;

				$copyright = __('Copyright &copy; ', 'inove') . $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';

				echo $copyright;
				bloginfo('name');
			}
		?>
	</div>
	<div id="themeinfo">
		<span>
			联系方式 ©
			Weibo:<a href="http://www.weibo.com/yangpage">@yangpage</a>
			&nbsp;&nbsp;Msn:jiangzubin1989@hotmail.com
			&nbsp;&nbsp;Mail/Gtalk:jiangzubin1989@gmail.com
		</span>
		<!--<?php printf(__('Theme by <a href="%1$s">NeoEase</a>. Valid <a href="%2$s">XHTML 1.1</a> and <a href="%3$s">CSS 3</a>.', 'inove'), 'http://www.neoease.com/', 'http://validator.w3.org/check?uri=referer', 'http://jigsaw.w3.org/css-validator/check/referer?profile=css3'); ?>-->
	</div>
</div>
<!-- footer END -->

</div>
<!-- container END -->
</div>
<!-- wrap END -->

<?php
	wp_footer();

	$options = get_option('inove_options');
	if ($options['analytics']) {
		echo($options['analytics_content']);
	}
?>


<!--ikeepu START-->

<!--<div style="position: absolute; width: 86px; cursor: pointer; z-index: 2147483647; background-image: url(http://static.ikeepu.com/app/bm/autocheck.gif); background-attachment: scroll; background-color: transparent; top: 605px; left: 809px; height: 0px; background-position: 0px 0px; background-repeat: no-repeat no-repeat; " title="add to ikeepu"></div>

<script type="text/javascript" src="http://static.ikeepu.com/app/bm/s.js"></script>-->

<!--ikeepu END-->


</body>

<!--百度开发平台监控脚本start-->
<script src="http://app.baidu.com/static/appstore/monitor.st"></script>
<!--百度开发平台监控脚本end-->

<!--baidu tongji START-->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F820a14a69a15b9079e8d3a068b7c795f' type='text/javascript'%3E%3C/script%3E"));
</script>
<!--baidu tongji END-->

</html>

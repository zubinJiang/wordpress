<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
				<aside id="meta" class="widget">
					<a id="saelogo" href="http://yanghome.sinaapp.com" target="_blank"><img  width="270" height="100" src="http://yanghome.sinaapp.com/images/logo.png" title="Powered by Sina App Engine" /></a>
				</aside>

				<aside id="meta" class="widget">
					<script type="text/javascript">document.write('<iframe width="300" height="210" frameborder="0" scrolling="no" src="http://widget.weibo.com/relationship/bulkfollow.php?language=zh_cn&uids=2049178385,2213749574&wide=1&color=C2D9F2,FFFFFF,0082CB,666666&showtitle=1&showinfo=1&sense=0&verified=1&count=5&refer='+encodeURIComponent(location.href)+'&dpc=1"></iframe>')</script>
				</aside>

		</div><!-- #secondary .widget-area -->
<?php endif; ?>

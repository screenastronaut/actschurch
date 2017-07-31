<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/actschurchs/template-files/#template-partials
 *
 * @package actschurch
 */
// TODO: fix sitemap columns
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div id="footer-widget-area" class="chw-widget-area widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .site-info -->
		<div class="site-copyright container">
			<span><i class="fa fa-circle" aria-hidden="true"></i>copyright &copy; <?php echo date('Y');?> Acts Church. All Rights Reserved. <i class="fa fa-circle" aria-hidden="true"></i></span>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

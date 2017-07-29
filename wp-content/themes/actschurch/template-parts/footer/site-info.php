<?php
/**
 * Displays site footer if assigned
 *
 * @package actschurch
 */

?><div class="site-info">
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hygieneconcept' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'hygieneconcept' ), 'WordPress' ); ?></a>
	<span class="sep"> | </span>
	<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'hygieneconcept' ), 'hygieneconcept', '<a href="https://automattic.com/" rel="designer">Underscores.me</a>' ); ?>
</div><!-- .site-info -->
<?php
/**
 * Template Name: Page Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); ?>

<div class="splash-image">
	<h1>A Place For all</h1>
	<a href="#time-and-locations" class="button green">Time & Locations</a>
	<a href="what-to-expect" class="button blue">What to Expect</a>
</div>


<div id="content" class="site-content container">

	<div id="primary" class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
			while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/post/content', get_post_format() );

			endwhile;

			the_posts_pagination();

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();

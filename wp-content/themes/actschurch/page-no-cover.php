<?php
/**
 * Template Name: Default Template (No Cover)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$featured_video = get_field('featured_video');
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile;
				?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
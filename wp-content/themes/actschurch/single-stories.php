<?php
/**
 * The template for displaying single Stories post
 *
 * @link https://developer.wordpress.org/themes/actschurchs/template-hierarchy/#single-post
 *
 * @package actschurch
 */

get_header(); ?>

<div id="content" class="site-content container">
	<div id="primary" class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<section>
					<div class="single-story col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<?php 
						echo get_field('story');
						the_tags('<p>Tags: ', ', ', '</p>');
						echo '<p>Share this story: '.do_shortcode('[addtoany]').'</p>'; 
						?>
					</div>
					<div class="single-story-image col-lg-3 col-md-3 hidden-sm hidden-xs">
						<img src="<?php echo get_field('photo'); ?>" alt="">
					</div>
				</section>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer(); ?>
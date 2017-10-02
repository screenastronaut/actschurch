<?php
/**
 * Template Name: Our Leadership Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">
				<div class="kenneth-chin row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php if (has_post_thumbnail( $post->ID ) ): ?>
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
							<img src="<?php echo $image[0]; ?>" title="Reverend Kenneth Chin" alt="Reverend Kenneth Chin">
						<?php endif; ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="entry-content-page">
								<?php the_content(); ?> <!-- Page Content -->
							</div><!-- .entry-content-page -->
						<?php endwhile; ?>
					</div>
				</div>
			</div>

			<div class="multi-tab">
				<div class="container">
					<span class="tab-link current-link" data-tab="pastors">Pastoral Team</span>
					<span class="tab-link" data-tab="elders">Elders</span>
					<span class="tab-link" data-tab="local">Local Service Plant Coordinators</span>
					<span class="tab-link" data-tab="international">International Service Plant Coordinators</span>
				</div>
			</div>

			<div class="container">

			<div class="tab-content current-tab" id="pastors">
					<h3 class="center-text">Pastoral Team</h3>
					<?php
					$args = array(
						'post_type' => 'leaders',
						'posts_per_page' => -1,
						'meta_key' => 'category',
						'meta_value' => 'pastors',
						);
					$the_query = new WP_Query( $args );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'template-parts/page/content', 'leaders' ); 
					endwhile;
					?>
					<div class="clear"></div>
				</div>
				<div class="tab-content" id="elders">
					<h3 class="center-text">Elders</h3>
					<?php
					$args = array(
						'post_type' => 'leaders',
						'posts_per_page' => -1,
						'meta_key' => 'category',
						'meta_value' => 'elders',
						);
					$the_query = new WP_Query( $args );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'template-parts/page/content', 'leaders' ); 
					endwhile;
					?>
					<div class="clear"></div>
				</div>
				<div class="tab-content" id="local">
					<h3 class="center-text">Local Service Plant Coordinators</h3>
					<?php
					$args = array(
						'post_type' => 'leaders',
						'posts_per_page' => -1,
						'meta_key' => 'category',
						'meta_value' => 'local',
						);
					$the_query = new WP_Query( $args );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'template-parts/page/content', 'leaders' ); 
					endwhile;
					?>
					<div class="clear"></div>
				</div>
				<div class="tab-content" id="international">
					<h3 class="center-text">International Service Plant Coordinators</h3>
					<?php
					$args = array(
						'post_type' => 'leaders',
						'posts_per_page' => -1,
						'meta_key' => 'category',
						'meta_value' => 'international',
						);
					$the_query = new WP_Query( $args );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'template-parts/page/content', 'leaders' ); 
					endwhile;
					?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
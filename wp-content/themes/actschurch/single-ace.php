<?php
/**
 * The template for displaying single ACE post
 *
 * @link https://developer.wordpress.org/themes/actschurchs/template-hierarchy/#single-post
 *
 * @package actschurch
 */

get_header(); ?>

<div id="content" class="ace-content site-content container">

	<div class="ace-sidebar col-lg-3 col-md-3 col-sm-3 hidden-xs">
		<a href="/ace"><< Back to ACE Main Page</a>

		<h4>ACE Classes</h4>

		<?php
		$args = array(
			'post_type' => 'ace',
			'posts_per_page' => -1,
		);
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			echo '<a href="'.get_permalink().'" style="display:block">'.get_the_title().'</a>';
		endwhile;
		?>

		<h4>Resources</h4>
		<a href="/ace-resources" style="display:block">Download Resources Here</a>

		<h4>Register Now</h4>
		<a href="http://bit.ly/ACEcourse" target="_blank" style="display:block">Register Now</a>

	</div>

	<div id="primary" class="content-area col-lg-9 col-md-9 col-sm-9 col-xs-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<h1 style="line-height:100px"><img style="vertical-align: middle" src="<?php echo get_field('icon'); ?>" alt="" width="100px"><span style="vertical-align: middle"><?php the_title(); ?></span></h1>

				<b>Duration: </b><?php echo get_field('course_duration'); ?>

				<br><br>

				<?php echo get_field('description') ?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer(); ?>
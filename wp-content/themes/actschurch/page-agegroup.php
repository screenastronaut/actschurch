<?php
/**
 * Template Name: Age Groups Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$introduction_text = get_field('introduction_text');
$calendar_text = get_field('calendar_text');
$contact_form = get_field('contact_form');
$contact_form_image = get_field('contact_form_image');
$real_stories_text = get_field('real_stories_text');
$real_stories = get_field('real_stories');

get_template_part( 'template-parts/page/content', 'cover-photo' );

?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="container">
				<div class="col-lg-push-2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
					<h1>Acts <?php the_title(); ?></h1>
					<?=$introduction_text?><br>
					<h5>Follow Us on <a href="<?php echo get_field('facebook_link'); ?>">Facebook</a>!</h5>
				</div>
			</section>

			<section class="container-fluid" style="padding:0">
				<?php
				if(have_rows('slider')) {
					while(have_rows('slider')) : the_row();
						echo '<img class="slider-img" src="'.get_sub_field('posters').'" >';
					endwhile;
				}
				?>
			</section>

			<section class="container">
			<!-- TODO: calendar -->
				<h2>Upcoming Events</h2>
				<?=$calendar_text?>
				<?php echo do_shortcode('[tribe_events]'); ?>
			</section>

			<section class="stories container-fluid">
				<h2>Real Stories</h2>
				<div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo get_field('real_stories_text'); ?>
					<a href="stories" class="button green">Explore Stories</a>
				</div>
				<div class="clear"></div>

				<?php
				$class = 0;
				if($real_stories): 
					foreach($real_stories as $post) : setup_postdata($post);
						$class++;
						set_query_var('class',$class);
						get_template_part( 'template-parts/post/content', 'featured-stories' );
					endforeach; 
					wp_reset_postdata(); 
				endif; 
				?>

				<!-- TODO: featured stories and stories cpt -->
			</section>

			<section class="contact container-fluid">
				<div class="contact-form col-lg-6">
					<!-- TODO: age group contact form -->
					<?=$contact_form?>
				</div>
				<div class="contact-image col-lg-6" style="background:url('<?=$contact_form_image?>');background-size: cover">
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
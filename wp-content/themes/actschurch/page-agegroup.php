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
				<div class="col-lg-push-2 col-lg-8 col-md-push-1 col-md-10 col-sm-12 col-xs-12">
					<h1>Acts <?php the_title(); ?></h1>
					<?=$introduction_text?><br>
					<h5>Follow Us on <a href="<?php echo get_field('facebook_link'); ?>">Facebook</a>!</h5>
				</div>
			</section>

			<?php
			if(have_rows('slider')) { ?>
			<section class="featured-events-slider container-fluid">
				<h2>What's Happening</h2>
				<div class="slick-slider">
					<?php
					while(have_rows('slider')) : the_row();
						$link = get_sub_field('link');
						$landscape = get_sub_field('posters');
						$portrait = get_sub_field('posters_portrait'); 
						if($link) {
							echo '<a href="'.$link.'">';
						}
						?>
						
						<div class="image" style="background:url(<?=$landscape?>)"><img class="slider-img" src="<?=$landscape?>" ></div>
							<!-- <?php if($portrait) { ?>
							<div class="image hidden-lg hidden-md" style="background:url(<?=$portrait?>)"><img class="slider-img" src="<?=$portrait?>" ></div>
							<?php } ?> -->
							<?php
							if($link) {
								echo '</a>';
							}
							?>
						<?php endwhile; ?>
					</div>
				</section>
				<?php } ?>

				<?php
				$class = 0;
				if($real_stories): ?>

				<section class="stories container-fluid">
					<h2>Real Stories</h2>
					<div class="col-lg-push-2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
						<?php echo get_field('real_stories_text'); ?>
						<a href="stories" class="button green">Explore Stories</a>
					</div>
					<div class="clear"></div>
					<?php
					foreach($real_stories as $post) : setup_postdata($post);
						$class++;
						set_query_var('class',$class);
						get_template_part( 'template-parts/post/content', 'featured-stories' );
					endforeach;
					wp_reset_postdata();

					echo '</section>';
				endif;
				?>

				<section class="age-contact contact container-fluid" style="padding:0">
					<div class="contact-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?=$contact_form?>
					</div>
					<div class="contact-image col-lg-6 col-md-6 hidden-sm hidden-xs" style="background:url('<?=$contact_form_image?>');background-size: cover">
					</div>
				</section>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_footer();
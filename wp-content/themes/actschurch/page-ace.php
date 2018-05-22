<?php
/**
 * Template Name: ACE Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header();

// get_template_part( 'template-parts/page/content', 'cover-photo' );

?>

<div id="content" class="ace-page site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="container-fluid" style="background-image:url('<?php echo get_field('cover_photo');?>')">
				<div class="col-lg-push-2 col-lg-8 col-md-push-1 col-md-10 col-sm-12 col-xs-12">
					<a href="http://bit.ly/ACEcourse" target="_blank" class="inner-link button green">Register</a>
					<a href="#classes" class="button blue">Classes</a>
				</div>
			</section>

			<section class="what-is-ace container-fluid">
				<h2>What is ACE?</h2>
				<div class="left-text col-lg-push-2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
					<?php echo get_field('what_is_ace'); ?>
				</div>
			</section>

			<section class="announcements stories container-fluid">
				<h2>Schedules</h2>
				<div class="left-text col-lg-push-3 col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<?php the_field('announcements'); ?>
					<!-- <br>
					<a href="<?php echo get_field('schedule');?>" target="_blank" class="inner-link button green">Download ACE Schedules</a> -->
				</div>
			</section>

			<section id="classes" class="classes container">
				<h2>Classes</h2>
				<?php
				$classes = get_field('classes');
				if($classes) :
					foreach($classes as $post) : setup_postdata($post);
						echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">';
						echo '<a href="'.get_permalink().'" class="class-link">';
						echo '<div class="card">';
						echo '<img src="'.get_field('icon').'" class="expect-icon" aria-hidden="true">';
						echo '<h4>'.get_the_title().'</h4>';
						echo '</div></a></div>';
					endforeach;
					wp_reset_postdata();
				endif;
				?>
			</section>

			<section class="ace-contact contact container-fluid" style="padding:0">
				<div class="contact-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<?php echo get_field('contact_form'); ?>
				</div>
				<div class="contact-image col-lg-6 col-md-6 hidden-sm hidden-xs" style="background:url('<?php echo get_field('contact_form_image'); ?>');background-size: cover">
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
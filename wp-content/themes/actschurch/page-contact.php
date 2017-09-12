<?php
/**
 * Template Name: Contact Us Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

// TODO: form styling

get_header(); 

$introduction_photo = get_field('introduction_photo');
$introduction_text = get_field('introduction_text');

get_template_part( 'template-parts/page/content', 'cover-photo' );
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="contact-us container">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<?php echo get_field('contact_form'); ?>
				</div>
				<div class="col-lg-push-1 col-md-push-1 col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<?php echo get_field('aya_details'); ?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
<?php
/**
 * Template Name: Our History Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$introduction_photo = get_field('introduction_photo');
$introduction_text = get_field('introduction_text');

get_template_part( 'template-parts/page/content', 'cover-photo' );
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container" style="margin-bottom: 30px;">
				<div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
					<?php echo get_field('text'); ?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
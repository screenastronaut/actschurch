<?php
/**
 * Template Name: Page Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

// TODO: get play button image
get_header(); ?>

<div class="splash-image">
	<h1>A Place For all</h1>
	<a href="#time-and-locations" class="button green">Time & Locations</a>
	<a href="what-to-expect" class="button blue">What to Expect</a>
	<i class="main-video fa fa-5x fa-play-circle-o" aria-hidden="true"></i>
</div>


<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="introduction container">
				<div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo get_field('introduction_text'); ?>
				</div>
			</section>

			<section class="grid container-fluid">
				<div class="col-lg-6">test</div>
				<div class="col-lg-6">test</div>
			</section>

			<section class="stories">
				<div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo get_field('real_stories_text'); ?>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();

<?php
/**
 * Template Name: Page Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

// TODO: get play button image
get_header(); 

$intro_text = get_field('introduction_text');
$featured_sermon = get_field('featured_sermon');
$age_group_picture = get_field('age_group_picture');
$age_group_text = get_field('age_group_text');
$small_groups_picture = get_field('small_groups_picture');
$small_groups_text = get_field('small_groups_text');
$calendar_picture = get_field('calendar_picture');
$calendar_text = get_field('calendar_text');
$extra_picture = get_field('extra_picture');
$real_stories_text = get_field('real_stories_text');

?>

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
					<?php echo $intro_text; ?>
				</div>
			</section>

			<section class="grid-layout container-fluid">
				<!-- TODO: featured sermon and sermon cpt -->
				<div class="grid-box featured-sermon col-lg-6">sermon</div>
				<div class="grid-box grid-pic-up col-lg-3" style="background:url('<?=$small_groups_picture?>');background-size: contain">small group</div>
				<div class="grid-box col-lg-3">
					<?=$calendar_text?>
				</div>
				<div class="grid-box col-lg-3"><?=$age_group_text?></div>
				<div class="grid-box grid-pic-right col-lg-3" style="background:url('<?=$age_group_picture?>');background-size: contain">age groups</div>
				<div class="grid-box col-lg-3"><?=$small_groups_text?></div>
				<div class="grid-box grid-pic-down col-lg-3" style="background:url('<?=$calendar_picture?>');background-size: contain">calendar</div>
			</section>

			<section class="stories">
				<div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo get_field('real_stories_text'); ?>
					<a href="stories" class="button green">Explore Stories</a>
				</div>

				<!-- TODO: featured stories and stories cpt -->
			</section>

			<section class="locations">
				<h2>Service Times & Locations</h2>
				<div>You are invited to one of our <?php ?> church services across <?php ?> countries.</div>
				<a href="#" class="button red">Local Services</a>
				<a href="#" class="button white">International Services</a>

				<!-- TODO: locations and locations cpt -->
			</section>

			<section class="locate-now">
				<h3>Not sure where to go? Find a service near you.</h3>
				<a href="locations" class="button black">Locate Now</a>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();

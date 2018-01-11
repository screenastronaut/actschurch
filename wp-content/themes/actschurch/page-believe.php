<?php
/**
 * Template Name: What We Believe In Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */
// TODO: fix column heights after photos are provided
get_header(); 

$introduction_photo = get_field('introduction_photo');
$introduction_text = get_field('introduction_text');

get_template_part( 'template-parts/page/content', 'cover-photo' );
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">
				<nav class="believe-sub-menu">
					<span class="sub-menu-item active" id="vision">Our Vision</span>
					<span class="sub-menu-item" id="mission">Our Mission</span>
					<span class="sub-menu-item" id="purpose">Our Purpose</span>
					<span class="sub-menu-item" id="sof">Our Statement of Faith</span>
				</nav>
			</div>

			<div class="believe-background container-fluid">
				<div class="vision row">
					<div class="believe-text col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h3 class="red">Our Vision</h3>
						<?php echo get_field('our_vision_text'); ?>
					</div>
					<div class="believe-pic col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
						<img src="<?php echo get_field('our_vision_photo');?>" alt="">
					</div>
				</div>
				<div class="mission row">
					<div class="believe-text col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h3 class="red">Our Mission</h3>
						<?php echo get_field('our_mission_text'); ?>
					</div>
					<div class="believe-pic col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
						<img src="<?php echo get_field('our_mission_photo');?>" alt="">
					</div>
				</div>
				<div class="purpose row">
					<div class="believe-text col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h3 class="red">Our Purpose</h3>
						<?php echo get_field('our_purpose_text'); ?>
					</div>
					<div class="believe-pic col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
						<img src="<?php echo get_field('our_purpose_photo');?>" alt="">
					</div>
				</div>
				<div class="sof row">
					<div class="believe-text col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3 class="red">Our Statement of Faith</h3>
						<?php echo get_field('our_sof_text'); ?>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
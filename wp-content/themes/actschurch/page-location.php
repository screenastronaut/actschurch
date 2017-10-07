<?php
/**
 * Template Name: Location Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

// TODO: contact forms

get_header(); 

?>

<div id="content" class="site-content single-location">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container-fluid">
				<div class="row">
					<img src="<?php echo get_field('location_cover_photo'); ?>" alt="">
				</div>
			</div>

			<div class="container about">
				<div class="col-lg-push-2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
					<h2 class="red">Acts <?php the_title(); ?></h2>
					<?php echo get_field('about'); ?>
				</div>
			</div>

			<div class="container-fluid service-times">
				<div class="container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php echo get_field('service_times'); ?>
					</div>
				</div>
			</div>

			<div class="locations-map container-fluid">
				<div class="row">
					<?php 
					$marker = get_field('map');
					$lat = $marker['lat'];
					$lng = $marker['lng'];
					$html = get_field('location_details');
					?> 
					<div class="single-marker" data-lat="<?=$lat?>" data-lng="<?=$lng?>" style="display:none"><?=$html?></div>
					<div id="single-map"></div>
				</div>	
			</div>

			<div class="location-contact contact container-fluid">
				<div class="row">
					<div class="orange-bg contact-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php echo get_field('contact_lift') ?>
					</div>
					<div class="grey-bg col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
						<img src="<?php echo get_field('contact_image') ?>">
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
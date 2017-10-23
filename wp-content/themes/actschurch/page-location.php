<?php
/**
 * Template Name: Location Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

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
				<div class="col-lg-push-2 col-md-push-1 col-sm-push-1 col-lg-8 col-md-10 col-sm-10 col-xs-12">
					<?php echo get_field('about'); ?>
				</div>
			</div>

			<div class="container-fluid service-times">
				<div class="container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php echo get_field('service_times'); ?>
						<div class="button-row">
							<?php 
							$waze_link = get_field('waze_link');
							$google_map_link = get_field('google_map_link');
							if($waze_link) {
								echo '<a href="'.$waze_link.'" class="button black" target="_blank">Waze Link</a>';
							}
							if($google_map_link) {
								echo '<a href="'.$google_map_link.'" class="button black" target="_blank">Google Map Link</a>';
							}
							?>
						</div>
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
					<div class="grey-bg col-lg-6 col-md-6 hidden-sm hidden-xs no-padding">
						<img src="<?php echo get_field('contact_image') ?>">
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
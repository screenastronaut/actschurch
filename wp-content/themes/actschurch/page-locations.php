<?php
/**
 * Template Name: Locations Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$local_object = get_field_object('local');
$international_object = get_field_object('international');
$service_count = count($local_object['value']) + count($international_object['value']);

get_template_part( 'template-parts/page/content', 'cover-photo' );

?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">
				<div class="locations-page col-lg-push-1 col-lg-10 col-md-12 col-sm-12 col-xs-12">
					<h3>Join one of our <?=$service_count?> services across 8 different countries worldwide today.</h3>
				</div>

				<div class="services col-lg-push-1 col-lg-10 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h3 class="red">Malaysia</h3>
						<?php
						if(have_rows('local')) {
							while(have_rows('local')) : the_row();
							$marker = get_sub_field('google_map');
							echo '<div class="service">';
							echo '<h5>'.get_sub_field('location_name').'</h5>';
							echo '<a href="#locations-map" class="locate-map" data-lat="'.$marker['lat'].'" data-lng="'.$marker['lng'].'">Find on Map</a> | ';
							echo '<a href="'.get_sub_field('link').'">Visit Page</a>';
							echo '</div>';
							endwhile;
						}
						?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h3 class="red">International</h3>
						<?php
						if(have_rows('international')) {
							while(have_rows('international')) : the_row();
							$marker = get_sub_field('google_map');
							echo '<div class="service">';
							echo '<h5>'.get_sub_field('location_name').'</h5>';
							echo '<a href="#locations-map" class="locate-map" data-lat="'.$marker['lat'].'" data-lng="'.$marker['lng'].'">Find on Map</a> | ';
							echo '<a href="'.get_sub_field('link').'">Visit Page</a>';
							echo '</div>';
							endwhile;
						}
						?>
					</div>
				</div>
			</div>

			<div class="locations-map container-fluid" id="locations-map">
				<?php 
				global $location_markers;
				$location_markers = array();
				if(have_rows('local')) : 
					while(have_rows('local')) : the_row(); 
				$marker = get_sub_field('google_map');
				$html = get_sub_field('location_name').'<hr>'.$marker['address'];
				array_push($location_markers, array($marker['address'],$marker['lat'],$marker['lng'],$html));
				endwhile; endif; 

				if(have_rows('international')) : 
					while(have_rows('international')) : the_row(); 
				$marker = get_sub_field('google_map');
				$html = get_sub_field('location_name').'<hr>'.$marker['address'];
				array_push($location_markers, array($marker['address'],$marker['lat'],$marker['lng'],$html));
				endwhile; endif; 
				?> 
				<div id="map"></div>
				<script type="text/javascript">
					var location_markers = <?php echo json_encode($location_markers); ?>;
				</script>
			</div>		

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
<?php
/**
 * Day View Template
 * The wrapper template for day view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );
?>

<section class="featured-cal-events-slider container-fluid">
	<h2>What's Happening</h2>
	<div class="slick-slider">
		<?php
		$args = array(
			'post_type' => 'featured_events',
			'posts_per_page' => 5,
		);
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<a href="<?php echo get_field('link');?>">
					<div class="image" style="background:url('<?php echo get_field('image'); ?>');"></div>
				</a>
			</div>
		</div>
	<?php endwhile; ?>
</div>
</section>

<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<!-- Main Events Content -->
<?php tribe_get_template_part( 'day/content' ) ?>

<div class="tribe-clear"></div>

<?php
do_action( 'tribe_events_after_template' );

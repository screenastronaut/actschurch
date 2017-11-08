<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package actschurch
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon">

	<?php wp_head(); ?>

	<!--[if IE 8]>
	<script>
	document.createElement('header'); document.createElement('nav'); document.createElement('section'); document.createElement('article'); document.createElement('aside'); document.createElement('footer');
	</script>
	<p class="internetmessge">Your browser is out of date, and may not be compatible with our website. For optimal viewing, we recommend that you switch to a different browser or upgrade to the latest Internet Explorer. Upgrade <a target="_blank" href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">here</a>!</p><br />
<![endif]-->
	<!--[if IE 9]>
	<script> document.createElement('header'); document.createElement('nav'); document.createElement('section'); document.createElement('article'); document.createElement('aside'); document.createElement('footer');
	</script>
	<p class="internetmessge">Your browser is out of date, and may not be compatible with our website. For optimal viewing, we recommend that you switch to a different browser or upgrade to the latest Internet Explorer. Upgrade <a target="_blank" href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">here</a>!</p><br />
<![endif]-->
</head>

<?php
if(is_front_page()) {
	$header_class = 'transparent-header';
} elseif (is_page('homes') || is_page('kids') || is_page('teens') || is_page('campus') || is_page('young-working-adults') || is_page('family') || is_page('calendar')) {
	$header_class = 'green-header';
} elseif (is_page('stories')) {
	$header_class = 'purple-header';
} elseif (is_page('watch')) {
	$header_class = 'blue-header';
} else {
	$header_class = 'orange-header';
}
?>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'actschurch' ); ?></a>

		<header id="masthead" class="site-header <?=$header_class?> sticky-header" role="banner">
			<div class="container">
				<div class="row upper-header">

					<div class="logo col-lg-3 col-md-3 col-sm-3 col-xs-6">
						<?php
						if($header_class === 'transparent-header') {
							get_template_part( 'template-parts/header/site', 'branding-orange' );
						} else {
							get_template_part( 'template-parts/header/site', 'branding' );
						}

						?>
					</div>

					<div class="navigation-menu col-lg-9 col-md-9 col-sm-9 col-xs-6">
						<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
					</div>

				</div>
				<div class="row lower-header">
					<?php 
					if(tribe_is_month() || tribe_is_day() || tribe_is_list_view() || tribe_is_map() || tribe_is_photo() || tribe_is_week() || tribe_is_event() ) {
						echo '<h1>Calendar</h1>';
					} else {
						the_title('<h1>','</h1>'); 
					}
					?>
				</div>
			</div>
		</header><!-- #masthead -->

		<!-- <a href="#" class="scrollToTop"></a> -->
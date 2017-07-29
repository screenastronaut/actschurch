<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/actschurchs/template-files/#template-partials
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

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'actschurch' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="container">

				<div class="logo col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
				</div>

				<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">
					<div class="upper-header col-lg-12 col-md-12">
						<?php

						if ( is_active_sidebar( 'header-1' ) ) : ?>
						<div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
						<?php dynamic_sidebar( 'header-1' ); ?>
						</div>

					<?php endif; ?>

				</div>
				<div class="lower-header col-lg-12 col-md-12">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div>
			</div>


		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">

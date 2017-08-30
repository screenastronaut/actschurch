<?php
/**
 * Template part for displaying leadership page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

?>

<div class="profile col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<div class="pic" style="background:url(<?php echo get_field('picture'); ?>);background-size:cover;background-repeat:no-repeat;"></div>
	<div class="short-bio">
		<h4><?php echo get_field('name'); ?></h4>
		<h5><?php echo get_field('title'); ?></h5>
		<i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo get_field('email'); ?>">Email</a><br>
		<i class="fa fa-facebook-official" aria-hidden="true"></i><a href="<?php echo get_field('facebook_page'); ?>" target="_blank">Facebook Page</a>
	</div>
</div>

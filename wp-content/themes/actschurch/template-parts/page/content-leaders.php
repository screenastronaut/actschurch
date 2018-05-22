<?php
/**
 * Template part for displaying leadership page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

// $email = get_field('email');
// $facebook = get_field('facebook_page');

?>

<div class="profile col-lg-4 col-md-4 col-sm-6 col-xs-12">
	<div class="pic" style="background:url(<?php echo get_field('picture'); ?>);background-size:cover;background-repeat:no-repeat;"></div>
	<div class="short-bio">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="leader-name"><?php echo get_field('name'); ?></div>
				<div class="leader-title"><?php echo get_field('title'); ?></div>
				<br>
				<?php
				if($email)
					echo '<a href="mailto:'.$email.'"><i class="fa fa-envelope" aria-hidden="true"></i></a>';
				if($facebook)
					echo '<a href="'.$facebook.'" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>';
				?>		
				
			</div>
		</div>
		<!-- <div class="facts row">
			<div class="col-lg-12">
				<?php echo get_field('facts'); ?>
			</div>
		</div> -->
	</div>
</div>

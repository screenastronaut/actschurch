<?php
/**
 * Template part for displaying stories page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

?>

<div class="individual-story col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<div class="pic" style="background:url(<?php echo get_field('photo'); ?>);background-size:cover;background-repeat:no-repeat;"></div>
	<div class="text">
		<div class="story-title">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
		<div class="story-excerpt">
			<?php echo get_field('excerpt'); ?>
		</div>
		<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
	</div>
</div>

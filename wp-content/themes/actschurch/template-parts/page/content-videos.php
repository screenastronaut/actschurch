<?php
/**
 * Template part for displaying stories page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

$youtube_link = "https://www.youtube.com/watch?v=".get_field('video_link')."&rel=0";

?>

<div class="individual-video col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<a data-fancybox href="<?=$youtube_link?>" class="video-pic">
		<div class="pic" style="background:url(<?php echo get_field('photo'); ?>);background-size:cover;background-repeat:no-repeat;"></div>
		<i class="play-icon fa fa-play fa-3x" aria-hidden="true"></i>
	</a>
	<div class="text">
		<div class="video-title">
			<h4><a data-fancybox href="<?=$youtube_link?>"><?php the_title(); ?></a></h4>
		</div>
		<div class="video-excerpt">
			<?php echo get_field('description'); ?>
		</div>
		<!-- <a href="<?php the_permalink(); ?>" class="read-more">Read More</a> -->
	</div>
</div>

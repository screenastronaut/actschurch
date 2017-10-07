<?php
/**
 * Template part for displaying stories page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

$youtube_link = "https://www.youtube.com/watch?v=".get_field('video_link')."&rel=0";
$youtube_embed = '<iframe width="854" height="480" src="https://www.youtube.com/embed/'.get_field('video_link').'" frameborder="0" allowfullscreen></iframe>';
$video_id = get_the_ID();
?>

<div class="individual-video col-lg-4 col-md-4 col-sm-6 col-xs-12">
	<a data-fancybox data-src="#video-<?=$video_id?>" href="javascript:;" class="video-pic">
		<div class="pic" style="background:url(<?php echo get_field('photo'); ?>);background-size:cover;background-repeat:no-repeat;">
		</div>
		<i class="play-icon fa fa-play fa-3x" aria-hidden="true"></i>
	</a>
	<div class="text">
		<div class="video-title">
			<h5><a data-fancybox data-src="#video-<?=$video_id?>" href="javascript:;"><?php the_title(); ?></a></h5>
		</div>
	</div>

	<div style="display:none" class="watch-fancybox" id="video-<?=$video_id?>">
		<?=$youtube_embed?>
		<div class="clear"></div>
		<?php echo '<h5>'.get_the_title().'</h5>'; ?>
		<div class="clear"></div>
		<?php echo 'Speaker: '.get_field('speaker'); ?>
		<div class="clear"></div>
		<?php echo 'Time: '.get_field('timing'); ?>
		<div class="clear"></div>
		<?php the_tags('<p>Tags: ', ', ', '</p>'); ?>
		<?php echo 'Share this video: '.do_shortcode('[addtoany]'); ?>
	</div>
</div>

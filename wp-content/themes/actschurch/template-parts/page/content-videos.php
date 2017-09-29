<?php
/**
 * Template part for displaying stories page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

$youtube_link = "https://www.youtube.com/watch?v=".get_field('video_link')."&rel=0";
$youtube_embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.get_field('video_link').'" frameborder="0" allowfullscreen></iframe>';
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
			<h4><a data-fancybox data-src="#video-<?=$video_id?>" href="javascript:;"><?php the_title(); ?></a></h4>
		</div>
	</div>

	<div style="display:none" class="watch-fancybox" id="video-<?=$video_id?>">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom:15px;">
			<?=$youtube_embed;?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<?php 
			echo get_the_title();
			echo '<div class="clear"></div>';
			echo get_field('description'); 
			?>
			
		</div>
	</div>
</div>

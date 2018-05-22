<?php
/**
 * Template part for displaying featured stories content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

$story_title = get_the_title();
$story_pic = get_field('photo');
$story_url = get_permalink();
?>

<a href="<?=$story_url?>" class="real-story-link">
	<div class="real-story col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<div class="text text-<?=$class?>">
			<div class="story-title">
				<h5><?=$story_title?></h5>
			</div>
		</div>
		<div class="pic" style="background-image:url(<?=$story_pic?>);"></div>
	</div>
</a>
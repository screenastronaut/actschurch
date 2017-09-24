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

<div class="real-story col-lg-3 col-md-3 col-sm-12 col-xs-12">
	<div class="text text-<?=$class?>">
		<div class="story-title">
			<h4><a href="<?=$story_url?>"><?=$story_title?></a></h4>
		</div>
	</div>
	<div class="pic" style="background:url(<?=$story_pic?>);background-size:cover;background-repeat:no-repeat;"></div>
</div>
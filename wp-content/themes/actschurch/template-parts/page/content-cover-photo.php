<?php
/**
 * Template part for displaying cover photo
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

?>

<div class="cover-photo" style="background:url('<?php echo get_field('cover_photo');?>');background-size: cover">
	<?php the_title('<h1>','</h1>'); ?>
</div>
<?php
/**
 * Template part for displaying cover photo
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

?>

<div class="splash-image cover-photo" style="background-image:url('<?php echo get_field('cover_photo');?>')">
	<img src="<?php echo get_field('cover_photo');?>" >
	<div class="text-overlay">
		<?php the_title('<h1>','</h1>'); ?>
	</div>
</div>
<?php
/**
 * Template part for displaying homepage location content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

$name = get_sub_field('name');
$address = get_sub_field('address');
$service_times = get_sub_field('service_times');
$waze_link = get_sub_field('waze_link');
$google_map_links = get_sub_field('google_map_links');
$page_link = get_sub_field('page_link');
if($id % 2 == 0) {
	echo '<div class="location col-lg-offset-1 col-md-offset-1 col-lg-5 col-md-5 col-sm-12 col-xs-12">';
} else {
	echo '<div class="row"><div class="location col-lg-5 col-md-5 col-sm-12 col-xs-12">';
}
?>

<div class="location-name" id="<?=$id?>">
	<h4><?=$name?></h4><div class="triangle triangle-down t-<?=$id?>"></div>
</div>
<div class="more-info a-<?=$id?>">
	<h5><?=$address?></h5>
	<div><?=$service_times?></div>
	<div class="links">
		<?php 
		if($waze_link)
			echo '<a href="'.$waze_link.'" target="_blank">Waze</a>';
		if($google_map_links)
			echo '<a href="'.$google_map_links.'" target="_blank">Google Maps</a>';
		?>
		<a href="<?=$page_link?>">Find out more</a>
	</div>
</div>

<?php
if($id % 2 == 0) {
	echo '</div></div>';
} else {
	echo '</div>';
}
?>
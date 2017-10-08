<?php
/**
 * Template part for displaying locations content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

$marker = get_sub_field('google_map');
$lat = $marker['lat'];
$lng = $marker['lng'];
$location_name = get_sub_field('location_name');
$page_link = get_sub_field('link');
?>

<div class="service">
	<h5><?=$location_name?></h5>
	<a href="#locations-map" class="locate-map" data-lat="<?=$lat?>" data-lng="<?=$lng?>">Find on Map</a> | <a href="<?=$page_link?>">Visit Page</a>
</div>
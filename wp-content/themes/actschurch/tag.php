<?php
/**
 * The template for displaying tag pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$tags = get_queried_object();
$tag_name = $tags->name;

$query1 = new WP_Query(array(
	'post_type' => 'stories',
	'tag_slug__in' => $tag_name,
));
$query2 = new WP_Query(array(
	'post_type' => 'videos',
	'tag_slug__in' => $tag_name,
));

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">

			<?php
			if ( $query1->have_posts() || $query2->have_posts() ) : 
				echo '<h1 class="page-title">Tag: '.single_tag_title('', false).'</h1>';

				while ( $query1->have_posts() ) : $query1->the_post();
					the_title( '<p><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' );
				endwhile;

				while ( $query2->have_posts() ) : $query2->the_post();
					$youtube_link = "https://www.youtube.com/watch?v=".get_field('video_link')."&rel=0";
					the_title( '<p><a data-fancybox href="' . $youtube_link . '" rel="bookmark">', '</a></p>' );
				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
			<br><br>
			<div class="clear"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	get_sidebar();
	get_footer();

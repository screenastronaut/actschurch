<?php
/**
 * Template Name: Stories Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$featured_story = get_field('featured_story');
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container featured-story">
				<?php 
				if($featured_story): 
					foreach($featured_story as $post) : setup_postdata($post);
				?>
				<div class="featured-left col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<h2><?php echo get_the_title(); ?></h2>
					<?php echo get_field('excerpt'); ?>
					<div class="by-person"><?php echo get_field('name'); ?></div>
					<div class="category">Category: 
						<?php 
						$category = get_field('category');
						if($category) {
							foreach($category as $cat) {
								echo $cat.', ';
							}
						}
						?>
					</div>
					<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
				</div>
				<div class="featured-right col-lg-6 col-md-6 col-sm-12 col-xs-12"">
					<img src="<?php echo get_field('photo'); ?>" alt="">
				</div>
			<?php endforeach; endif; ?>
		</div>

		<hr>

		<div class="container stories-container">
			<div class="search-stories col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<form id="storysearchform">
					<input type="text" name="storysearch" id="storysearch" placeholder="Search">
					<label for="storydate">Date: </label><input type="month" name="storydate" id="storydate">
					<label for="storycat">Category: </label>
					<?php
					$allcats = get_field_object('category');
					if( $allcats )
					{
						echo '<select name="' . $allcats['key'] . '" name="storycat" id="storycat">';
						echo '<option default value="All">All</option>';
						foreach( $allcats['choices'] as $k => $v )
						{
							echo '<option value="' . $k . '">' . $v . '</option>';
						}
						echo '</select>';
					}
					?>
					<input type="submit" name="submit" id="submit" value="Search">
				</form>
			</div>

			<div class="all-stories">

				<?php

				$args = array(
					'post_type' => 'stories',
					'posts_per_page' => -1,
					);
				$the_query = new WP_Query( $args );
				while ( $the_query->have_posts() ) : $the_query->the_post();
				get_template_part( 'template-parts/page/content', 'stories' ); 
				endwhile;
				?>
			</div>

			<!-- TODO: load more button -->
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
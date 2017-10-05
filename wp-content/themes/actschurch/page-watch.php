<?php
/**
 * Template Name: Watch Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$featured_video = get_field('featured_video');
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php the_title('<h1 class="page-title">','</h1>'); ?>
				</div>
			</div>

			<div class="container featured-video">
				<?php 
				if($featured_video): 
					foreach($featured_video as $post) : setup_postdata($post);
						?>
						<div class="featured-left col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h2><?php echo get_the_title(); ?></h2>
							<?php echo get_field('description'); ?>
							<?php echo 'Share this video: '.do_shortcode('[addtoany]'); ?>
						</div>
						<div class="featured-right col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="embed-responsive embed-responsive-4by3">
								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field('video_embed'); ?>?rel=0"></iframe>
							</div>

					<!-- <a href="<?php echo get_field('url');?>" class="featured-container">
						<img src="<?php echo get_field('photo'); ?>" alt="" class="featured-photo">
						<i class="featured-play fa fa-play fa-3x" aria-hidden="true"></i>
					</a> -->
				</div>
			<?php endforeach; endif; ?>
		</div>

		<hr>

		<div class="container videos-container">
			<!-- <div class="search-video col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
			</div> -->

			<div class="all-videos">

				<?php

				$args = array(
					'post_type' => 'videos',
					'posts_per_page' => -1,
				);
				$the_query = new WP_Query( $args );
				while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'template-parts/page/content', 'videos' ); 
				endwhile;
				?>
			</div>

			<!-- TODO: load more button -->
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
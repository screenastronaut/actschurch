<?php
/**
 * Template Name: Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header();

$intro_text = get_field('introduction_text');
$age_group_picture = get_field('age_group_picture');
$age_group_text = get_field('age_group_text');
$small_groups_picture = get_field('small_groups_picture');
$small_groups_text = get_field('small_groups_text');
$calendar_picture = get_field('calendar_picture');
$calendar_text = get_field('calendar_text');
$extra_picture = get_field('extra_picture');
$real_stories_text = get_field('real_stories_text');
$real_stories = get_field('real_stories');

$watchpage = get_page_by_path('watch');
$watchID = $watchpage->ID;

$featured_video=get_field('featured_video',$watchID);

if($featured_video):
	foreach($featured_video as $post) : setup_postdata($post);
		$featured_sermon = get_field('photo');
		$video_link = "https://www.youtube.com/watch?v=".get_field('video_link')."&rel=0";
	endforeach;
	wp_reset_postdata();
endif;

?>

<div class="splash-image" style="background-image:url('<?php echo get_field('cover_photo');?>')">
	<img src="<?php echo get_field('cover_photo');?>" >
	<div class="text-overlay">
		<h1>A Place For <span class="special">all</span></h1>

		<a href="#time-and-locations" class="inner-link button green">Time & Locations</a>
		<a href="what-to-expect" class="button blue">What to Expect</a>
	</div>
</div>


<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="introduction container">
				<div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<?php echo $intro_text; ?>
				</div>
			</section>

			<section class="grid-layout container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
						<a href="<?=$video_link?>" data-fancybox><div class="grid-box featured-sermon col-lg-6 col-md-6" style="background:url('<?=$featured_sermon?>') no-repeat;background-size: cover;background-position:center;"><i class="main-video fa fa-3x fa-play-circle-o" aria-hidden="true"></i></div></a>
						<div class="grid-box grid-pic-up col-lg-3 col-md-3" style="background:url('<?=$small_groups_picture?>') no-repeat;background-size: cover;background-position:center;"></div>
						<div class="grid-box col-lg-3 col-md-3" style="padding:0">
							<div class="grid-half grid-pic-up" style="background:url('<?=$calendar_picture?>') no-repeat;background-size: cover;background-position:center;"></div>
							<div class="grid-half"><?=$calendar_text?></div>
						</div>
						<div class="grid-box col-lg-3 col-md-3"><?=$age_group_text?></div>
						<div class="grid-box grid-pic-right col-lg-3 col-md-3" style="background:url('<?=$age_group_picture?>') no-repeat;background-size: cover;background-position:center;"></div>
						<div class="grid-box col-lg-3 col-md-3"><?=$small_groups_text?></div>
						<div class="grid-box col-lg-3 col-md-3" style="background:url('<?=$extra_picture?>') no-repeat;background-size: cover;background-position:center;"></div>
					</div>
				</div>

				<!-- responsive -->
				<div class="hidden-lg hidden-md col-sm-12 col-xs-12">
					<a href="<?=$video_link?>" data-fancybox>
						<div class="grid-box grid-box-small featured-sermon col-sm-12 col-xs-12" style="background:url('<?=$featured_sermon?>') no-repeat;background-size: contain">
							<img src="<?=$featured_sermon?>">
							<i class="main-video fa fa-3x fa-play-circle-o" aria-hidden="true"></i>
						</div>
					</a>

					<div class="grid-box grid-box-small grid-pic-up col-sm-12 col-xs-12" style="background:url('<?=$small_groups_picture?>') no-repeat;background-size: cover;background-position:center;">
						<img src="<?=$small_groups_picture?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12"><?=$small_groups_text?></div>

					<div class="grid-box grid-box-small grid-pic-up col-sm-12 col-xs-12" style="background:url('<?=$age_group_picture?>') no-repeat;background-size: cover;background-position:center;">
						<img src="<?=$age_group_picture?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12"><?=$age_group_text?></div>

					<div class="grid-box grid-box-small grid-pic-up col-sm-12 col-xs-12" style="background:url('<?=$calendar_picture?>') no-repeat;background-size: cover;background-position:center;">
						<img src="<?=$calendar_picture?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12"><?=$calendar_text?></div>
				</div>
			</section>

			<section class="stories">
				<div class="col-lg-push-2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
					<?php echo $real_stories_text; ?>
					<a href="stories" class="button green">Explore Stories</a>
				</div>
				<div class="clear"></div>

				<?php
				$class = 0;
				if($real_stories):
					foreach($real_stories as $post) : setup_postdata($post);
						$class++;
						set_query_var('class',$class);
						get_template_part( 'template-parts/post/content', 'featured-stories' );
					endforeach;
					wp_reset_postdata();
				endif;
				?>
			</section>

			<section class="featured-events-slider container-fluid">
				<div class="slick-slider">
					<?php
					if(have_rows('featured_events_slider')) :
						while(have_rows('featured_events_slider')) : the_row();
							?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<a href="<?php echo get_sub_field('link');?>">
									<img src="<?php echo get_sub_field('image'); ?>">
								</a>
							</div>
						<?php endwhile; endif;?>
					</div>
				</section>

				<section class="locations" id="time-and-locations">
					<h2>Service Times & Locations</h2>
					<div>You are invited to one of our <?php ?> church services across <?php ?> countries.</div>
					<a href="#" class="local-button button red">Local Services</a>
					<a href="#" class="international-button button no-red">International Services</a>

					<div class="clear"></div>

					<div class="local-services container">
						<div class="col-lg-offset-1 col-lg-10">
							<?php
							global $id;
							$id = 0;
							if(have_rows('local_locations')) :
								while(have_rows('local_locations')) : the_row();
									$id++;
									get_template_part( 'template-parts/post/content', 'homepage-location' );
								endwhile; 
							endif;
							if($id % 2 != 0) {
								echo '</div>';
							}
							?>
						</div>
					</div>

					<div class="international-services container">
						<div class="col-lg-offset-1 col-lg-10">
							<?php
							global $id;
							$id = 0;
							if(have_rows('international_locations')) :
								while(have_rows('international_locations')) : the_row();
									$id++;
									get_template_part( 'template-parts/post/content', 'homepage-location' );
								endwhile; 
							endif;
							if($id % 2 != 0) {
								echo '</div>';
							}
							?>
						</div>
					</div>
				</section>

				<section class="locate-now container-fluid">
					<h3>Not sure where to go? Find a service near you.</h3>
					<a href="locations" class="button black">Locate Now</a>
				</section>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_footer();

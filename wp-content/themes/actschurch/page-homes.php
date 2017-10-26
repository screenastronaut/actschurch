<?php
/**
 * Template Name: Homes Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$what_is_homes = get_field('what_is_homes');
$bible_quote = get_field('bible_quote');
$photo_1 = get_field('photo_1');
$photo_2 = get_field('photo_2');
$photo_3 = get_field('photo_3');
$photo_4 = get_field('photo_4');
$photo_5 = get_field('photo_5');
$contact_form = get_field('contact_form');
$contact_form_image = get_field('contact_form_image');
$real_stories = get_field('real_stories');

get_template_part( 'template-parts/page/content', 'cover-photo' );

?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="what-is-homes container">
				<h1>What is Homes?</h1>
				<div class="col-lg-push-1 col-lg-10 col-md-12 col-sm-12 col-xs-12">
					
					<div class="left-text col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?=$what_is_homes?>
						<br>
						<div class="button-row">
							<a href="#find-homes" class="button green">Find a Home</a>
							<a href="#join-homes" class="button green">Join a Home</a>
						</div>
					</div>
					<div class="right-text col-lg-5 col-md-5 hidden-sm hidden-xs">
						<?=$bible_quote?>						
					</div>
				</div>
			</section>

			<section class="grid-layout container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
						<div class="grid-box col-lg-6 col-md-6" style="background:url('<?=$photo_1?>');background-size: cover; background-position: center">MEALS</div>
						<div class="grid-box grid-pic-up col-lg-3 col-md-3" style="background:url('<?=$photo_2?>');background-size: cover; background-position: center"></div>
						<div class="grid-box col-lg-3 col-md-3" style="padding:0">
							<div class="grid-half grid-pic-up" style="background:url('<?=$photo_3?>');background-size: cover; background-position: center"></div>
							<div class="grid-half">FELLOWSHIP</div>
						</div>
						<div class="grid-box grey col-lg-3 col-md-3">WORSHIP</div>
						<div class="grid-box grid-pic-right col-lg-3 col-md-3" style="background:url('<?=$photo_4?>');background-size: cover; background-position: center"></div>
						<div class="grid-box col-lg-3 col-md-3" style="padding:0">
							<div class="grid-half">SUPPORT</div>
							<div class="grid-half grey">WORD</div>
						</div>
						<div class="grid-box col-lg-3 col-md-3" style="background:url('<?=$photo_5?>');background-size: cover; background-position: center"></div>
					</div>
				</div>

				<!-- responsive -->
				<div class="hidden-lg hidden-md col-sm-12 col-xs-12">
					<div class="grid-box grid-box-small col-sm-12 col-xs-12" style="background:url('<?=$photo_1?>');background-size: cover; background-position: center">
						<img src="<?=$photo_1?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12 grey">MEALS</div>
					
					<div class="grid-box grid-box-small col-sm-12 col-xs-12" style="background:url('<?=$photo_2?>');background-size: cover; background-position: center">
						<img src="<?=$photo_2?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12 grey">SUPPORT</div>

					<div class="grid-box grid-box-small col-sm-12 col-xs-12" style="background:url('<?=$photo_3?>');background-size: cover; background-position: center">
						<img src="<?=$photo_3?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12 grey">FELLOWSHIP</div>

					<div class="grid-box grid-box-small grid-pic-right col-sm-12 col-xs-12" style="background:url('<?=$photo_4?>');background-size: cover; background-position: center">
						<img src="<?=$photo_4?>">
					</div>
					<div class="grid-box grid-box-small grey col-sm-12 col-xs-12 grey">WORSHIP</div>

					<div class="grid-box grid-box-small col-sm-12 col-xs-12" style="background:url('<?=$photo_5?>');background-size: cover; background-position: center">
						<img src="<?=$photo_5?>">
					</div>
					<div class="grid-box grid-box-small col-sm-12 col-xs-12 grey">WORD</div>
				</div>
			</section>

			<section id="find-homes" class="find-homes">
				<div class="container">
					<h2>Find a Homes</h2>

					<label for="plant">Church Plant: </label>
					<select name="plant" id="homes-plant">
						<option disabled selected value="">By Church Plant</option>
						<option value="All">All</option>
						<option value="Ampang">Ampang</option>
						<option value="Cheras">Cheras</option>
						<option value="Cyberjaya">Cyberjaya</option>
						<option value="Klang">Klang</option>
						<option value="Nilai">Nilai</option>
						<option value="Petaling Jaya">Petaling Jaya</option>
						<option value="Semenyih">Semenyih</option>
						<option value="Subang Jaya">Subang Jaya</option>
					</select>

					<div class="table-div">
					<?php echo do_shortcode('[gdoc key="'.get_field('homes_listing').'" class="homes-table" use_cache="no"]'); ?>
					</div>
					<script type="text/javascript">
						var homes_listing = <?php echo json_encode(get_field('homes_listing')); ?>;
					</script>
				</div>
			</section>

			<section class="contact container-fluid" style="padding:0">
				<div class="contact-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<?=$contact_form?>
				</div>
				<div class="contact-image col-lg-6 col-md-6 hidden-sm hidden-xs" style="background:url('<?=$contact_form_image?>');background-size: cover">
				</div>
			</section>

			<section class="stories container-fluid">
				<h2>Real Stories</h2>
				<div class="col-lg-push-2 col-lg-12 col-md-8 col-sm-12 col-xs-12">
					<?php echo get_field('real_stories_text'); ?>
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

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
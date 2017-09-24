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
				<div class="col-lg-push-1 col-lg-10">
					
					<div class="left-text col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<?=$what_is_homes?>
						<br>
						<a href="#find-homes" class="button green">Find a Home</a>
						<a href="#join-homes" class="button green">Join a Home</a>
					</div>
					<div class="right-text col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<?=$bible_quote?>						
					</div>
				</div>
			</section>

			<section class="grid-layout container-fluid">
				<div class="grid-box col-lg-6" style="background:url('<?=$photo_1?>');background-size: contain">meals</div>
				<div class="grid-box grid-pic-up col-lg-3" style="background:url('<?=$photo_2?>');background-size: contain">support</div>
				<div class="grid-box col-lg-3" style="padding:0">
					<div class="grid-half grid-pic-up" style="background:url('<?=$photo_3?>');background-size: contain">fellowship</div>
					<div class="grid-half">fellowship</div>
				</div>
				<div class="grid-box grey col-lg-3">worship</div>
				<div class="grid-box grid-pic-right col-lg-3" style="background:url('<?=$photo_4?>');background-size: contain">worship</div>
				<div class="grid-box col-lg-3" style="padding:0">
					<div class="grid-half">support</div>
					<div class="grid-half grey">word</div>
				</div>
				<div class="grid-box col-lg-3" style="background:url('<?=$photo_5?>');background-size: contain">word</div>
			</section>

			<section id="find-homes" class="find-homes container">
				<h2>Find a Homes</h2>
				<!-- TODO: excel and custom city/state -->

				<label for="city">City/State: </label>
				<select name="city" id="homes-city" >
					<option disabled selected value="">By City</option>
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

				<table class="homes-table">
					<tr class="table-header">
						<td>City/State</td>
						<td>Location</td>
						<td>Homes Leader(s)</td>
						<td>Homes Code</td>
					</tr>
					<?php
					if(have_rows('homes_repeater')) {
						while(have_rows('homes_repeater')) : the_row();
						echo '<tr class="'.get_sub_field('city_state').'">';
						echo '<td>'.get_sub_field('city_state').'</td>';
						echo '<td>'.get_sub_field('location').'</td>';
						echo '<td>'.get_sub_field('homes_leaders').'</td>';
						echo '<td>'.get_sub_field('homes_code').'<br>'.'</td>';
						echo '</tr>';
						endwhile;
					}
					?>
				</table>
			</section>

			<section class="contact container-fluid">
				<div class="contact-form col-lg-6">
					<!-- TODO: homes contact form -->
					<?=$contact_form?>
				</div>
				<div class="contact-image col-lg-6" style="background:url('<?=$contact_form_image?>');background-size: contain">
				</div>
			</section>

			<section class="stories container-fluid">
				<h2>Real Stories</h2>
				<div class="col-lg-push-2 col-md-push-2 col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
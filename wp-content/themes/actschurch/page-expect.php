<?php
/**
 * Template Name: What To Expect Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header(); 

$introduction_photo = get_field('introduction_photo');
$introduction_text = get_field('introduction_text');

get_template_part( 'template-parts/page/content', 'cover-photo' );
?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="welcome-message container">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<img src="<?=$introduction_photo?>" title="Welcome Message Photo" alt="Welcome Message Photo">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<?=$introduction_text?>						
					</div>
			</section>

			<!-- TODO: replace icons -->
			<section class="what-to-expect">
				<div class="container">
					<h2>What can I expect from my first visit?</h2>
					<?php 
					if(have_rows('what_to_expect')) {
						while(have_rows('what_to_expect')) : the_row();
							echo '<div class="expect-box col-lg-4 col-md-4 col-sm-6 col-xs-6">';
							echo '<img src="'.get_sub_field('icon').'" class="expect-icon" aria-hidden="true">';
							echo '<h4>'.get_sub_field('title').'</h4>';
							echo '<div>'.get_sub_field('text').'</div>';
							echo '</div>';
						endwhile;
					}
					?>
				</div>
			</section>

			<section class="faqs">
				<div class="container">
					<h2>Frequently Asked Questions (FAQs)</h2>
					<?php 
					if(have_rows('faqs')) {
						$i=0;
						while(have_rows('faqs')) : the_row();
							$i++;
							echo '<div class="question" id="'.$i.'"><h3>'.get_sub_field('question').'</h3><div class="triangle triangle-down t-'.$i.'"></div></div>';
							echo '<div class="answer a-'.$i.'">'.get_sub_field('answer').'</div>';
						endwhile;
					}
					?>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();

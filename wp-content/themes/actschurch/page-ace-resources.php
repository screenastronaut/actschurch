<?php
/**
 * Template Name: ACE Resources Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package actschurch
 */

get_header();

// get_template_part( 'template-parts/page/content', 'cover-photo' );

?>

<div id="content" class="ace-page site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!-- <section class="container-fluid" style="background-image:url('<?php echo get_field('cover_photo');?>')">
				<div class="col-lg-push-2 col-lg-8 col-md-push-1 col-md-10 col-sm-12 col-xs-12">
					<a href="http://bit.ly/ACEcourse" target="_blank" class="inner-link button green">Register</a>
					<a href="/academy-christian-education-ace" class="button blue">Classes</a>
				</div>
			</section> -->

			<section class="what-is-ace container">
				<?php
				if(have_rows('resources')) :
					while(have_rows('resources')) : the_row();
						$aceclass = get_sub_field('ace_class');
						if($aceclass) {
							$post = $aceclass;
							setup_postdata($post);
							$aceclasstitle = get_the_title();
							$aceclasslink = get_permalink();
							wp_reset_postdata();
						} else {
							$title = '';
						}
						
						echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">';
						echo '<div class="card" style="height:200px;padding:30px">';
						echo '<a href="'.get_sub_field('resource_file').'" class="class-link" target="_blank">';
						echo '<i class="fa fa-file fa-2x" aria-hidden="true"></i>';
						echo '<h4>'.get_sub_field('file_name').'</h4></a>';
						echo '<p>Resource For </p>';
						echo '<a href="'.$aceclasslink.'"><p>'.$aceclasstitle.'</p></a>';
						echo '</div></div>';
					endwhile;
				endif;
				?>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
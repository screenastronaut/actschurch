<?php
/**
 * The Search Form containing the main form
 *
 *
 * @package actschurch
 */ ?>

 <form role="search" method="get" id="search-form" action="<?php echo home_url( '/' ); ?>">
 	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
 	<input type="hidden" id="searchsubmit" />
 	<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/icon-search-white.png" class="searchicon" alt="Submit Form" />
 </form>
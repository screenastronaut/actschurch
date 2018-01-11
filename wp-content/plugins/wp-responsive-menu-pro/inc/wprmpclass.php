<?php
class MgWprmp {

	protected $options = '';
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'check_wpr_exists' ) );
		add_action( 'wp_enqueue_scripts',  array( $this, 'wprm_enque_scripts' ) );
		add_action( 'wp_footer', array( $this, 'wprmenu_menu' ) );
		$this->options = get_option( 'wprmenu_options' );
		
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'wpr_cart_count_fragments' ), 10, 1 );

	}

	public function option( $option ){
		if( isset( $this->options[$option] ) && $this->options[$option] != '' )
			return $this->options[$option];
		return '';
	}

	//convert hex color codes into RGB color
	function hex2rgba($color, $opacity = false) {
		$default = 'rgb(0,0,0)';
 
		//Return default if no color provided
		if(empty($color))
    	return $default; 
 
		//Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
    	$color = substr( $color, 1 );
    }
 
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
    	$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
    	$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
    	return $default;
    }
 
    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
    	if(abs($opacity) > 1)
    		$opacity = 1.0;
    	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
    	$output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
	}

	/**
	*
	* Check if responsive menu free version is installed and activated and if not
	* If free version is installed and activated then show notice to make that disable
	*
	*/
	public function check_wpr_exists() {
		if( is_plugin_active('wp-responsive-menu/wp-responsive-menu.php') ) { 
			$notice = __('<p>It seems like you are using the free version of <a href="https://wordpress.org/plugins/wp-responsive-menu/" target="_blank">WP Responsive Menu</a>. Make sure to deactivate and remove the free version of the plugin to use the pro version. All your settings of free version will automatically be transferred to pro version.</p>');
			?>
			<div id="message" class="error">
      			<?php echo $notice; ?>
      		</div>
		<?php
		deactivate_plugins( 'wp-responsive-menu-pro/wp-responsive-menu-pro.php' );
		}
	}

	//inline style for responsive menu
	public function wpr_inline_css() {
		$inlinecss = '';
		if( $this->option('enabled') ) :
			$how_wide = $this->option('how_wide') !='' ? $this->option('how_wide') : '40';
			$menu_max_width = $this->option('menu_max_width') != '' ? $this->option('menu_max_width') : '';
			$from_width = $this->option('from_width') != '' ? $this->option('from_width') : '768';
			$inlinecss .= '@media only screen and ( max-width: '.$from_width.'px ) {';
			$border_top_color = $this->hex2rgba($this->option("menu_border_top"), $this->option("menu_border_top_opacity"));

			$border_bottom_color = $this->hex2rgba($this->option("menu_border_bottom"), $this->option("menu_border_bottom_opacity"));

			//manu background image
			if( $this->option('menu_bg') != '' ) :
				$inlinecss .= '#mg-wprm-wrap {
					background-image: url( '.$this->option("menu_bg").' ) !important;
					background-size: '.$this->option("menu_bg_size").' !important;
					background-repeat: '.$this->option("menu_bg_rep").' !important;
			}';
			endif;

			if( $this->option('menu_border_bottom_show') == 'yes' ):
				$inlinecss .= '
				#mg-wprm-wrap ul li {
					border-top: solid 1px '.$border_top_color.';
					border-bottom: solid 1px '.$border_bottom_color.';
				}
				';
			endif;

			if( $this->option('submenu_alignment') == 'right' ):
				$inlinecss .= '
				#mg-wprm-wrap li.menu-item-has-children ul.sub-menu li a {
					text-align: right;
					margin-right: 44px;
				}
				';
			endif;

			if( $this->option('submenu_alignment') == 'center' ):
				$inlinecss .= '
				#mg-wprm-wrap li.menu-item-has-children ul.sub-menu li a {
					text-align: center;
				}
				';
			endif;

			if( $this->option('menu_bar_bg') != '' ) :
				$inlinecss .= '
					#wprmenu_bar {
					background-image: url( '.$this->option("menu_bar_bg").' ) !important;
					background-size: '.$this->option("menu_bar_bg_size").' !important;
					background-repeat: '.$this->option("menu_bar_bg_rep").' !important;
				}
				';
			endif;
			
			$inlinecss .= '
				#wprmenu_bar {
					background-color: '.$this->option("bar_bgd").';
				}
				html body div#mg-wprm-wrap .wpr_submit .icon.icon-search {
					color: '.$this->option("search_icon_color").';
				}
				#wprmenu_bar .menu_title, #wprmenu_bar .wprmenu_icon_menu {
					color: '.$this->option("bar_color").';
				}
				#wprmenu_bar .menu_title {
					font-size: '.$this->option('menu_title_size').'px;
					font-weight: '.$this->option('menu_title_weight').';
				}
				#mg-wprm-wrap li.menu-item a {
					font-size: '.$this->option('menu_font_size').'px;
					text-transform: '.$this->option('menu_font_text_type').';
					font-weight: '.$this->option('menu_font_weight').';
				}
				#mg-wprm-wrap li.menu-item-has-children ul.sub-menu a {
					font-size: '.$this->option('sub_menu_font_size').'px;
					text-transform: '.$this->option('sub_menu_font_text_type').';
					font-weight: '.$this->option('sub_menu_font_weight').';
				}
				#mg-wprm-wrap li.current-menu-item > a {
					color: '.$this->option('active_menu_color').';
					background: '.$this->option('active_menu_bg_color').';
				}
				#mg-wprm-wrap, div.wpr_search form {
					background-color: '.$this->option("menu_bgd").';
				}
				#mg-wprm-wrap {
					width: '.$how_wide.'%;
					max-width: '.$menu_max_width.'px;
				}
				#mg-wprm-wrap ul#wprmenu_menu_ul li.menu-item a,
				div#mg-wprm-wrap ul li span.wprmenu_icon {
					color: '.$this->option("menu_color").';
				}
				#mg-wprm-wrap ul#wprmenu_menu_ul li.menu-item a:hover {
					background: '.$this->option("menu_textovrbgd").'!important;
					color: '.$this->option("menu_color_hover").';
				}
				div#mg-wprm-wrap ul>li:hover>span.wprmenu_icon {
					color: '.$this->option("menu_color_hover").';
				}				
				.wprmenu_bar .hamburger-inner, .wprmenu_bar .hamburger-inner::before, .wprmenu_bar .hamburger-inner::after {
					background: '.$this->option("menu_icon_color").';
				}

				.wprmenu_bar .hamburger:hover .hamburger-inner, .wprmenu_bar .hamburger:hover .hamburger-inner::before,
			 .wprmenu_bar .hamburger:hover .hamburger-inner::after {
				background: '.$this->option("menu_icon_hover_color").';
				}
			';

			if( $this->option("menu_symbol_pos") == 'right' ) :
				$inlinecss .= '
					html body .wprmenu_bar .hamburger {
						float: '.$this->option("menu_symbol_pos").'!important;
					}
					.wprmenu_bar #custom_menu_icon.hamburger, .wprmenu_bar.custMenu .wpr-custom-menu {
						top: '.$this->option("custom_menu_top").'px;
						right: '.$this->option("custom_menu_left").'px;
						float: right !important;
						background-color: '.$this->option("custom_menu_bg_color").' !important;
					}
				';
			endif;
			if( $this->option("menu_symbol_pos") == 'left' ) :
				$inlinecss .= '
					.wprmenu_bar .hamburger {
						float: '.$this->option("menu_symbol_pos").'!important;
					}
					.wprmenu_bar #custom_menu_icon.hamburger, .wprmenu_bar.custMenu .wpr-custom-menu {
						top: '.$this->option("custom_menu_top").'px;
						left: '.$this->option("custom_menu_left").'px;
						float: '.$this->option("menu_symbol_pos").'!important;
						background-color: '.$this->option("custom_menu_bg_color").' !important;
					}
					

				';
			endif;

			if( $this->option('google_font_type') != '' && $this->option('google_font_type') == 'standard' ) :
				$inlinecss .= 'body #mg-wprm-wrap *,#wprmenu_bar .menu_title,#wprmenu_bar input {font-family: '.$this->option('google_font_family').' }';
			endif;

			if( $this->option('google_font_type') != '' && $this->option('google_font_type') == 'web_fonts' ) {
				$font = str_replace('+', ' ', $this->option('google_web_font_family') );
				$inlinecss .= 'body #mg-wprm-wrap *,#wprmenu_bar .menu_title,#wprmenu_bar input {font-family: '.$font.' }';
			}
			if( $this->option('hide') != '' ):
				$inlinecss .= $this->option('hide').'{ display:none!important; }';
			endif;
			if( $this->option("menu_type") == 'default' ) : 
				$inlinecss .= 'html { padding-top: 42px!important; }';
			endif;
			$inlinecss .= '#wprmenu_bar,.wprmenu_bar.custMenu .wpr-custom-menu { display: block!important; }
			div#wpadminbar { position: fixed; }';
		
		endif;

		$inlinecss .= 'div#mg-wprm-wrap .wpr_social_icons > a { color: '.$this->option('social_icon_color').' !important}';
		$inlinecss .= 'div#mg-wprm-wrap .wpr_social_icons > a:hover { color: '.$this->option('social_icon_hover_color').' !important}';
		$inlinecss .= '#wprmenu_bar .menu-elements.search-icon .toggle-search i { color: '.$this->option('search_icon_color').' !important}';
		$inlinecss .= '#wprmenu_bar .wpr-custom-menu  {float: '.$this->option('menu_symbol_pos').';}';
		$inlinecss .= '.wprmenu_bar .wpr-custom-menu i { font-size: '.$this->option('custom_menu_font_size').'px !important;  top: '.$this->option('custom_menu_icon_top').'px !important; color: '.$this->option('menu_icon_color').'}';
		$inlinecss .= '#mg-wprm-wrap div.wpr_social_icons i {font-size: '.$this->option('social_icon_font_size').'px !important}';
		if( $this->woocommerce_installed() && $this->option('woocommerce_integration') == 'yes' ){
			$inlinecss .= 'div.wpr_cart_icon .wpr-cart-item-contents{ background: '.$this->option('cart_contents_bubble_color').' !important; color: '.$this->option('cart_contents_bubble_text_color').' !important; font-size: '.$this->option('cart_contents_bubble_text_size').'px !important}';
			$inlinecss .= '#wprmenu_bar .menu-elements.cart-icon i { color: '.$this->option('cart_icon_color').' !important}';
			$inlinecss .= '#wprmenu_bar .menu-elements.cart-icon i:hover{color: '.$this->option('cart_icon_active_color').' !important}';
		}
		$inlinecss .= '#wprmenu_bar .menu-elements.search-icon .toggle-search i:hover{color: '.$this->option('search_icon_hover_color').' !important}';
		$inlinecss .= '#mg-wprm-wrap .wpr_submit i::before {color: '.$this->option('search_icon_color').' !important }';

		$inlinecss .=	'}';
		
		return $inlinecss;

	}

	public function wprm_enque_scripts() {

		//hamburger menu icon style
		wp_enqueue_style( 'hamburger.css' , plugins_url().'/wp-responsive-menu-pro/css/wpr-hamburger.css', array(), '1.0' );

		if( $this->option('google_font_type') != '' && $this->option('google_font_type') == 'web_fonts' ) {
			wp_enqueue_style('wprmenu-font', '//fonts.googleapis.com/css?family='.$this->option('google_web_font_family'));
		}
		
		wp_enqueue_style( 'wprmenu.fonts.css' , plugins_url().'/wp-responsive-menu-pro/inc/icons/style.css', array(), '1.0' );

		wp_enqueue_style( 'wprmenu.css' , plugins_url().'/wp-responsive-menu-pro/css/wprmenu.css', array(), '1.0' );

		if( $this->option('rtlview') == 1 ) :
			wp_enqueue_style( 'wprmenu-rtl.css' , plugins_url().'/wp-responsive-menu-pro/css/wprmenu-rtl.css', array(), '1.0' );
		endif;

		//menu css
		wp_enqueue_style( 'wpr_icons', plugins_url().'/wp-responsive-menu-pro/inc/icons/style.css', array(),  '1.0' );

		wp_add_inline_style( 'wprmenu.css', $this->wpr_inline_css() );

    
		wp_enqueue_script( 'modernizr', plugins_url(). '/wp-responsive-menu-pro/js/modernizr.custom.js', array( 'jquery' ), '1.0' );
		//touchswipe js
		wp_enqueue_script( 'touchSwipe', plugins_url(). '/wp-responsive-menu-pro/js/jquery.touchSwipe.min.js', array( 'jquery' ), '1.0' );

		wp_enqueue_script( 'wprmenu.js', plugins_url(). '/wp-responsive-menu-pro/js/wprmenu.js',  array( 'jquery' ), '1.0' );

		$wpr_options = array(
		 		'zooming' 		=> $this->option('zooming'),
		 		'from_width' 	=> $this->option('from_width'),
		 		'parent_click' 	=>  $this->option('parent_click'),
		 		'swipe' 		=> $this->option('swipe'),
		 		'push_width' 	=> $this->option('menu_max_width'),
		 		'menu_width' 	=> $this->option('how_wide'),
		 		'submenu_open_icon' => $this->option('submenu_open_icon'),
		 		'submenu_close_icon' => $this->option('submenu_close_icon'), 
		 		'SubmenuOpened' => $this->option('submenu_opened') != '' ? $this->option('submenu_opened') : '0'
		 	);
		wp_localize_script( 'wprmenu.js', 'wprmenu', $wpr_options );
	}

	public function wpr_cart_count_fragments( $fragments ) {
	    $fragments['span.wpr-cart-item-contents'] = '<span class="wpr-cart-item-contents">' . WC()->cart->get_cart_contents_count() . '</span>';
	    return $fragments;
	}
	
	public function woocommerce_installed() {
		if (  class_exists( 'woocommerce' ) ) {
			return true;
		}
	}

	public function wpr_search_form() {

		$search_placeholder = $this->option('search_box_text');
		$unique_id = esc_attr( uniqid( 'search-form-' ) );
		$woocommerce_search = '';

		if( $this->woocommerce_installed() && $this->option('woocommerce_integration') == 'yes' && $this->option('woocommerce_product_search') == 'yes' ) {
			$woocommerce_search = '<input type="hidden" name="post_type" value="product" />';
		}

		echo '<form role="search" method="get" class="wpr-search-form" action="' . site_url() . '"><label for="'.$unique_id.'"></label><input type="search" class="wpr-search-field" placeholder="' . $search_placeholder . '" value="" name="s" title="Search for:"><button type="submit" class="wpr_submit"><i class="wpr-icon-search"></i></button>'.$woocommerce_search.'</form>';
	}

	public function show_menu_bar_element() {
		$html = '';

		if( $this->option('search_box_menubar') == 1 ) : 
			$html = '<div class="wpr-search-wrap menu-bar-elements menu-elements search-icon"><div class="toggle-search"><i class="'.$this->option('search_icon').'"></i></div></div>';
		endif;
		
		if( $this->option('cart-icon') != '' ) : 
			//show woocommerce cart icon if woocommerce and cart is enabled
			if( $this->option('woocommerce_integration') == 'yes' && $this->woocommerce_installed() ) :
				global $woocommerce;
				$cart_url = wc_get_cart_url(); 
				$html .='<div class="wpr-cart-wrap menu-bar-elements menu-elements cart-icon"><div class="wpr_cart_icon"><a class="wpr_cart_item" href="'.$cart_url.'"><i class='.$this->option('cart-icon').'></i>';
				
				if( WC()->cart->get_cart_contents_count() > 0 ) :
					$html .= '<span class="wpr-cart-item-contents">'.WC()->cart->get_cart_contents_count().'</span>';
				else :
					$html .= '<span class="wpr-cart-item-contents">0</span>';
				endif;
					$html .= '</a></div></div>';
			endif; 
		endif;
		echo $html;
	}
	

	public function wpr_social_icons() {

		$socials = json_decode( $this->option('social') );
		
		if( $this->option('social') !='' && !empty($socials) ){
			$output = '';
			if( is_array ( $socials ) && count( $socials ) > 0 ) {
				foreach( $socials as $social ) {
					$output .= '<a href="'.$social->link.'" target="_blank"><i class="'.$social->icon.'"></i></a>';
				}
			}
		}
		return $output;
	}
	
	public function wprmenu_menu() {

		if( $this->option('enabled') ) :
			$menu_title = $this->option('bar_title');
			$logo_link = $this->option('logo_link') != '' ? $this->option('logo_link') : get_site_url();
			$openDirection = $this->option('position');
			$menu_icon_animation = $this->option('menu_icon_animation') != '' ? $this->option('menu_icon_animation') : 'hamburger--slider';
			
			if( $this->option('menu_type') == 'custom' ) : ?>
				<div class="wprmenu_bar custMenu <?php if ( $this->option('slide_type') == 'bodyslide' ) { echo $this->option('slide_type'); echo ' '.$this->option('position'); } ?>">
					<?php
					$menu_icon_type = $this->option('menu_icon_type') != '' ? $this->option('menu_icon_type') : 'custom';

					if( $menu_icon_type !== 'custom' ) : //show default menu
				?>
					<div id="custom_menu_icon" class="hamburger <?php echo $menu_icon_animation; ?>">
  					<span class="hamburger-box">
    					<span class="hamburger-inner"></span>
  					</span>
					</div>
				<?php
					endif;
				 ?>

				 <?php if( $menu_icon_type == 'custom' ) : ?>
				 	<div class="wpr-custom-menu">
				 		<i class="wpr_open <?php echo $this->option('menu_icon'); ?>"></i>
						<i class="wpr_close <?php echo $this->option('menu_close_icon'); ?>"></i>
					</div>
				 <?php endif; ?>

				</div>
		<?php 
			else:
				$logo_class = ' wpr-logo-' . $this->option( 'bar_logo_pos' ); 
		?>
			<div id="wprmenu_bar" class="wprmenu_bar <?php echo $this->option('slide_type'); echo ' '.$this->option('position'); echo $logo_class;  ?>">

				<!-- menu search box -->
				<div class="search-expand">
					<div class="wpr_search">
						<?php echo $this->wpr_search_form(); ?>
					</div>
				</div>

				<?php
					$this->show_menu_bar_element();
					$menu_icon_type = $this->option('menu_icon_type') != '' ? $this->option('menu_icon_type') : 'custom';

					if( $menu_icon_type !== 'custom' ) : //show default menu
				 		?>

					<div class="hamburger <?php echo $menu_icon_animation; ?>">
  					<span class="hamburger-box">
    					<span class="hamburger-inner"></span>
  					</span>
					</div>
				<?php
					endif;
				  
				  if( $menu_icon_type == 'custom' ) : 
				  	?>
				 		<div class="wpr-custom-menu">
				 			<i class="wpr_open <?php echo $this->option('menu_icon'); ?>"></i>
							<i class="wpr_close <?php echo $this->option('menu_close_icon'); ?>"></i>
						</div>
				 <?php endif; ?>
				

				 <?php if( !empty($menu_title) ) : ?>
					<div class="menu_title">
						<?php echo $menu_title; ?>
					</div>
				<?php endif; ?>	
						
				<?php 
					if( $this->option('bar_logo') != '' ) :
						echo '<span class="wpr-logo-wrap menu-elements"><a href="'.$logo_link.'"><img  src="'.$this->option('bar_logo').'"/></a></span>';
					endif; 
				?>
		</div>
		<?php endif; ?>


		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-<?php echo $openDirection; ?> <?php echo $this->option('menu_type'); ?> " id="mg-wprm-wrap">
			<?php 
				$search_position = $this->option('order_menu_items') != '' ? $this->option('order_menu_items') : 'Menu,Search,Social';
			?>

				<ul id="wprmenu_menu_ul">
					<?php
					foreach( explode(',', $search_position) as $element_position ) :
						//show search element
						if( $element_position == 'Search'  ) :
							if( $this->option('search_box_menu_block') != '' && $this->option('search_box_menu_block') == 1  ) : 
							?>
							<li class="search-menu">
								<div class="wpr_search">
									<?php echo $this->wpr_search_form(); ?>
								</div>
							</li>
							<?php
							endif;
						endif;

						//show social block
						if( $element_position == 'Social' ) :
							$socials = json_decode( $this->option('social') );
							if( !empty($socials) ) : ?> 
								<li>
									<div class="wpr_social_icons">
										<?php echo $this->wpr_social_icons(); ?>
									</div>
								</li>
							<?php
							endif;
						endif;

						//show menu elements
						if( $element_position == 'Menu' ) :
							$menus = get_terms( 'nav_menu',array( 'hide_empty'=>false ) );
							if( $menus ) : foreach( $menus as $m ) :
								if( $m->term_id == $this->option('menu') ) $menu = $m;
								endforeach; endif;
								if( is_object( $menu ) ) :
									wp_nav_menu( array( 'menu'=>$menu->name,'container'=>false,'items_wrap'=>'%3$s' ) );
							endif;
					endif;

					endforeach;
					?>
				</ul>
			</div>
			<?php
		endif;
	}

}
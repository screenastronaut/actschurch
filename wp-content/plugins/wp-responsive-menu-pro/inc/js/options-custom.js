/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {
	$('select#google_web_font_family').select2();
	$('select#google_font_family').select2();

	// Loads the color pickers
	$('.of-color').wpColorPicker();

	$('[data-toggle="tooltip"]').tooltip();

	// Image Options
	$('.of-radio-img-img').click( function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	} );

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	$('#wpr-sortable').sortable({
  	update: function(event, ui) {
      var order = []; 
      $('#wpr-sortable li').each( function(e) {
      	order.push( $(this).attr('id'));
      });
      $('#wpr_optionsframework').find('input#order_menu_items').val(order);
     }
  });
	$("#wpr-sortable").disableSelection();
	

	// Loads tabbed sections if they exist
	if ( $( '.nav-tab-wrapper').length > 0 ) {
		options_framework_tabs();
	}

	function options_framework_tabs() {
		var $group = $('.group'),
			$navtabs = $('.nav-tab-wrapper a'),
			active_tab = '';

		// Hides all the .group sections to start
		$group.hide();

		// Find if a selected tab is saved in localStorage
		if (  typeof( localStorage ) != 'undefined'  ) {
			active_tab = localStorage.getItem( 'active_tab' );
		}

		// If active tab is saved and exists, load it's .group
		if ( active_tab != '' && $( active_tab ).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
		}

		// Bind tabs clicks
		$navtabs.click( function( e ) {

			e.preventDefault();

			// Remove active class from all tabs
			$navtabs.removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			if (typeof( localStorage ) != 'undefined') {
				localStorage.setItem('active_tab', $(this).attr('href'));
			}

			var selected = $(this).attr('href');

			$group.hide();
			$(selected).fadeIn();
		} );
	}
	


	var slideOpt = $('#section-slide_type option:selected').val();
	if (slideOpt == 'bodyslide') {
		$('#section-position option:eq( 2 )').css('display', 'none');
		$('#section-position option:eq( 3 )').css('display', 'none');
	}
	$('#slide_type').change( function() {
		if ($( this ).val() == 'bodyslide') {
			$('#section-position option:eq( 2 )').css('display', 'none');
			$('#section-position option:eq( 3 )').css('display', 'none');
		}
		else {
			$('#section-position option:eq( 2 )').css('display', 'block');
			$('#section-position option:eq( 3 )').css('display', 'block');			
		}
	});

  var menutype = $("input[name='wprmenu_options[menu_type]']:checked").val();
	if ( menutype == 'default' ) {
		$( '#section-custom_menu_top' ).css(  'display', 'none' );
		$( '#section-custom_menu_left' ).css(  'display', 'none' );
		$( '#section-custom_menu_bg_color' ).css(  'display', 'none' );   			
	}


	$('#section-menu_icon_type input').on('change', function() {
  	var menuIconType = $('input[name="wprmenu_options[menu_icon_type]"]:checked', '#section-menu_icon_type').val(); 
   		if ( menuIconType == 'default' ) {
   			$( '#section-menu_icon' ).css(  'display', 'none' );
   			$( '#section-custom_menu_icon_top' ).css(  'display', 'none' ); 
   			$( '#section-custom_menu_font_size' ).css(  'display', 'none' );
   			$( '#section-menu_close_icon' ).css(  'display', 'none' ); 		
   		}
   		else {
   			$( '#section-menu_icon' ).css(  'display', 'block' );
   			$( '#section-custom_menu_font_size' ).css(  'display', 'block' );
   			$( '#section-custom_menu_icon_top' ).css(  'display', 'block' );
   			$( '#section-menu_close_icon' ).css(  'display', 'block' ); 		   			
   		}
	});

	var menu_icon_type = $("input[name='wprmenu_options[menu_icon_type]']:checked").val();
	if ( menu_icon_type == 'default' ) {
		$( '#section-menu_icon' ).css(  'display', 'none' );
		$( '#section-custom_menu_font_size' ).css(  'display', 'none' );
   		$( '#section-custom_menu_icon_top' ).css(  'display', 'none' );
   		$( '#section-menu_close_icon' ).css(  'display', 'none' );
	}
	else {
		$( '#section-menu_icon' ).css(  'display', 'block' );
		$( '#section-custom_menu_font_size' ).css(  'display', 'block' );
   		$( '#section-custom_menu_icon_top' ).css(  'display', 'block' );
   		$( '#section-menu_close_icon' ).css(  'display', 'block' ); 	
	}


	$('#section-woocommerce_integration input').on('change', function() {
  		var woocommerce_integration = $("input[name='wprmenu_options[woocommerce_integration]']:checked").val();

   		if ( woocommerce_integration == 'no' ) {
   			$('#section-woocommerce_product_search').css('display', 'none');
   			$('#section-woocommerce_show_cart').css('display', 'none'); 
   			$('#section-cart_container').css('display', 'none');
   			$('#section-cart_container_padding').css('display', 'none');
   			$('#section-cart_top_position').css('display', 'none');
   			$('#section-cart_icon_position').css('display', 'none');
   			$('#section-cart_left_position').css('display', 'none');
   			$('#section-cart_icon_color').css('display', 'none');
   			$('#section-cart_icon_active_color').css('display', 'none');
   			$('#section-menu_cart_container_bg').css('display', 'none');
   			$('#section-menu_cart_container_text_color').css('display', 'none');
   			$('#section-cart-icon').css('display', 'none');
   		}
   		else {
   			$('#section-woocommerce_product_search').css('display', 'block');
   			$('#section-woocommerce_show_cart').css('display', 'block');
   			$('#section-cart_container').css('display', 'block');
   			$('#section-cart_icon_position').css('display', 'block');
   			$('#section-cart_container_padding').css('display', 'block');
   			$('#section-cart_top_position').css('display', 'block');
   			$('#section-cart_left_position').css('display', 'block');
   			$('#section-cart_icon_color').css('display', 'block');
   			$('#section-cart_icon_active_color').css('display', 'block');
   			$('#section-menu_cart_container_bg').css('display', 'block');
   			$('#section-menu_cart_container_text_color').css('display', 'block');
   			$('#section-cart-icon').css('display', 'block');  			   			
   		}
	});
  
  $('#section-menu_type input').on('change', function() {
  	var menuType = $('input[name="wprmenu_options[menu_type]"]:checked', '#section-menu_type').val(); 
   		if ( menuType == 'default' ) {
   			$( '#section-custom_menu_top' ).css(  'display', 'none' );
   			$( '#section-custom_menu_left' ).css(  'display', 'none' );
   			$( '#section-custom_menu_bg_color' ).css(  'display', 'none' );   			
   		}
   		else {
   			$( '#section-custom_menu_top' ).css(  'display', 'block' );
   			$( '#section-custom_menu_left' ).css(  'display', 'block' );
   			$( '#section-custom_menu_bg_color' ).css(  'display', 'block' );   			   			
   		}
	});

	jQuery('body').on( 'click', '.wpr-add-new', function(){
		field = '<div class="wpr-new-fields"><input type="text" name="wprmenu_options[social][icon][]" class="wpr-icon-picker" value=""><input type="text" name="wprmenu_options[social][link][]" placeholder="Enter your url here" class="social_link form-control" value=""><input type="button" value="Remove" class="wpr-remove-field btn btn-danger"></div>';
		jQuery('.wpr-social-fields').append(field);
		createIconpicker();
	});

	jQuery(document).on('click', '#section-google_api a', function(e){ 
    	e.preventDefault(); 
    	var url = $(this).attr('href'); 
    	window.open(url, '_blank');
	});
	
	jQuery('body').on( 'click', '.wpr-new-fields .btn', function(){
		if ( confirm('Do you really want to remove this social link?') )
			jQuery(this).parent().remove();
	});

	jQuery('select#google_font_type').on('change', function() {
		var Selected = $(this).val();
		if( Selected == 'standard' ) {
			$('div.wpr_web_font_family').hide();
			$('div.wpr_font_family').show();
		}
		else {
			$('div.wpr_web_font_family').show();
			$('div.wpr_font_family').hide();
		}
	});

	if( wprOption.font_type == 'web_fonts' ) {
		$('div.wpr_web_font_family').show();
		$('div.wpr_font_family').hide();
	}
	else {
		$('div.wpr_web_font_family').hide();
		$('div.wpr_font_family').show();
	}

	$('div#section-google_font_family').find('span.select2-container').width('100%');

	$('select#google_web_font_family').on('change', function() {
		var SelectedFont = $(this).val();
	});

	function createIconpicker() {
		var iconPicker = $('.wpr-icon-picker').fontIconPicker({
			theme: 'fip-bootstrap'
		}),icomoon_json_icons = [],
		icomoon_json_search = [];
		// Get the JSON file
		$.ajax({
			url: wprOption.options_path + '/icons/selection.json',
			type: 'GET',
			dataType: 'json'
		})
		.done(function(response) {
			// Get the class prefix
			var classPrefix = response.preferences.fontPref.prefix;
			
			$.each(response.icons, function(i, v) {
				// Set the source
				icomoon_json_icons.push( classPrefix + v.properties.name );
	
				// Create and set the search source
				if ( v.icon && v.icon.tags && v.icon.tags.length ) {
					icomoon_json_search.push( v.properties.name + ' ' + v.icon.tags.join(' ') );
				} else {
					icomoon_json_search.push( v.properties.name );
				}
			});
		
			setTimeout(function() {
				// Set new fonts
				iconPicker.setIcons(icomoon_json_icons, icomoon_json_search);
				
			}, 1000);
		})
		.fail(function() {
			// Show error message and enable
			alert('Failed to load the icons, Please check file permission.');
		});
	}
	createIconpicker();
	
});
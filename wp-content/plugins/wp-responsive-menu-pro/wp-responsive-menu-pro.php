<?php
/*
Plugin Name: WP Responsive Menu Pro
Plugin URI: http://magnigenie.com/wp-responsive-menu-mobile-menu-plugin-wordpress/
Description: WP Responsive Menu Pro is a simple plugin that lets you add a highly customizable responsive menu to any WordPress site in no time at all.
Version: 3.0.3
Author: MagniGenie
Author URI: http://magnigenie.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 *
 * Enable Localization
 *
 */
define( 'MG_WPRMP_FILE', __FILE__ );
define( 'MG_WPRMP_PATH', plugin_dir_path( __FILE__ ) );
define( 'MG_WPRMP_BASE', plugin_basename( __FILE__ ) );
define( 'MG_WPRMP_BASE_NAME', basename( dirname( __FILE__ ) ) );

load_plugin_textdomain( 'wprmenu', false, MG_WPRMP_BASE_NAME . '/lang' );

/**
 *
 * Add admin settings
 *
 */
define( 'WPR_PRO_OPTIONS_FRAMEWORK_DIRECTORY', plugins_url( '/inc/', __FILE__ ) );
define( 'WPR_PRO_OPTIONS_FRAMEWORK_PATH', dirname( __FILE__ ) . '/inc/' );

require_once dirname( __FILE__ ) . '/inc/options-framework.php';
require MG_WPRMP_PATH . 'licensing/license.php';

require_once dirname( __FILE__ ) . '/inc/wprmpclass.php';

new MgWprmp();

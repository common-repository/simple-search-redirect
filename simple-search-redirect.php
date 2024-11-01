<?php
/*
Plugin Name: Simple Search Redirect
Plugin URI: http://momnt.co/simple-search-redirect
Description: A widget and shortcode that let you simply redirect users to various search engine's <code>site:</code> search filters, often more accurate than your default WordPress search functionality.
Version: 1.1.1
Author: momnt
Author URI: http://momnt.co/
Text Domain: simple-search-redirect
License: GNU General Public License v2.0 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
.
Copyright 2012 momnt (email : hi@momnt.co) */



/**
 *  Setup and text domain
 *  @since 1.0.0
 */
if( !defined('SSR_PATH') )
    define( 'SSR_PATH', plugin_dir_path(__FILE__));

if( !defined('SSR_VERSION') )
    define( 'SSR_VERSION', '1.1.1' );



/**
 *  Load plugin files
 *  @since 1.0.0
 */
require_once(SSR_PATH . '/inc/widget.php');
require_once(SSR_PATH . '/inc/shortcode.php');



/**
 *  Let's get goin', Chief
 *  @since 1.0.0
 */
function simple_search_redirect_init() {
    load_plugin_textdomain('simple-search-redirect', false, basename(dirname(__FILE__)) . '/lang');
    new Simple_Search_Redirect_Shortcode();
}

function simple_search_redirect_widget_init() {
    register_widget('Simple_Search_Redirect_Widget');
}

add_action('init', 'simple_search_redirect_init');
add_action('widgets_init', 'simple_search_redirect_widget_init');



/**
 *  add meta links in plugins page
 *  @since 1.0.0
 */
function simple_search_redirect_meta_links($links, $file) {

    $plugin = plugin_basename(__FILE__);

    if ( $file == $plugin ) :
        return array_merge($links, array( 
            sprintf( __('<a href="%s">Rate plugin</a>', 'simple-search-redirect'), 'http://wordpress.org/extend/plugins/simple-search-redirect/'),
            sprintf( __('<a href="%s">Get support</a>', 'simple-search-redirect'), 'http://wordpress.org/support/plugin/simple-search-redirect')
        ));
    endif;
    
    return $links;
}

add_filter( 'plugin_row_meta', 'simple_search_redirect_meta_links', 10, 2 ); ?>
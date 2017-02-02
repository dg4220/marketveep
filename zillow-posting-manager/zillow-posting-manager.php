<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Zillow_Posting_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Zillow Posting Manager
 * Plugin URI:        http://fgpsn.com/zillow-posting-manager-uri/
 * Description:       This plugin creates a custom post type and all meta data fields for for generating a valid Zillow Broker Feed
 * Version:           1.0.0
 * Author:            Dennis Gannon
 * Author URI:        http://fgpsn.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zillow-posting-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zillow-posting-manager-activator.php
 */
function activate_zillow_posting_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zillow-posting-manager-activator.php';
	Zillow_Posting_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zillow-posting-manager-deactivator.php
 */
function deactivate_zillow_posting_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zillow-posting-manager-deactivator.php';
	Zillow_Posting_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zillow_posting_manager' );
register_deactivation_hook( __FILE__, 'deactivate_zillow_posting_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zillow-posting-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zillow_posting_manager() {

	$plugin = new Zillow_Posting_Manager();
	$plugin->run();

}
//run_zillow_posting_manager();


//flush rewrite rules so perma links work 
function fgpsn_rewrite_flush() {

	// ATTENTION: This is *only* done during plugin activation hook in this example!
	// You should *NEVER EVER* do this on every page load!!
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'fgpsn_rewrite_flush' );



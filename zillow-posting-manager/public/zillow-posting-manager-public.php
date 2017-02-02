<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Zillow_Posting_Manager
 * @subpackage Zillow_Posting_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zillow_Posting_Manager
 * @subpackage Zillow_Posting_Manager/public
 * @author     Your Name <email@example.com>
 */
class Zillow_Posting_Manager_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $zillow_posting_manager    The ID of this plugin.
	 */
	private $zillow_posting_manager;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $zillow_posting_manager       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $zillow_posting_manager, $version ) {

		$this->zillow_posting_manager = $zillow_posting_manager;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zillow_Posting_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zillow_Posting_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->zillow_posting_manager, plugin_dir_url( __FILE__ ) . 'css/zillow-posting-manager-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zillow_Posting_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zillow_Posting_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->zillow_posting_manager, plugin_dir_url( __FILE__ ) . 'js/zillow-posting-manager-public.js', array( 'jquery' ), $this->version, false );

	}

}

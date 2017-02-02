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



if(!class_exists('fgpsn_Property_Class'))
{
    class fgpsn_Property_Class
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
        } // END public function __construct
        
        
        /**
		 * hook into WP's admin_init action hook
		 */
        public function admin_init()
{
			// Set up the settings for this plugin
			$this->init_settings();
			// Possibly do additional admin_init tasks
		}
		
		
		/**
		 * Initialize some custom settings
		 */     
		public function init_settings()
		{
			// register the settings for this plugin
			register_setting('fgpsn_property_class-group', 'fgpsn_agent_email');
			register_setting('fgpsn_property_class-group', 'fgpsn_agent_mlsid');
		} // END public function init_custom_settings()



    
        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // Do nothing
        } // END public static function activate
    
        /**
         * Deactivate the plugin
         */     
        public static function deactivate()
        {
            // Do nothing
        } // END public static function deactivate
    } // END class fgpsn_Property_Class
} // END if(!class_exists('fgpsn_Property_Class'))


if(class_exists('fgpsn_Property_Class'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('fgpsn_Property_Class', 'activate'));
    register_deactivation_hook(__FILE__, array('fgpsn_Property_Class', 'deactivate'));

    // instantiate the plugin class
    $fgpsn_property_class = new fgpsn_property_class();
}





/*********************************************************************************/


if(!class_exists('fgpsnPropertyPostType'))
{
    /**
     * A PostTypeTemplate class that provides 3 additional meta fields
     */
    class fgpsnPropertyPostType
    {
        const POST_TYPE = "fgpsn-property-post-type";
        
        
        
        /**
		 * The Constructor
		 */
		public function __construct()
		{
			// register actions
			add_action('init', array(&$this, 'init'));
			add_action('admin_init', array(&$this, 'admin_init'));
		} // END public function __construct()
        
        
        /**
		 * hook into WP's init action hook
		 */
		public function init()
		{
			// Initialize Post Type
			$this->create_post_type();
			$this->fgpsn_zillow_property_feed_update();
			$this->fgpsn_zillow_property_info_save();
			$this->fgpsn_zillow_required_data_save();
			$this->fgpsn_repeatable_meta_box_save();
			$this->fgpsn_zillow_location_save();
			$this->fgpsn_zillow_listing_save();
			$this->fgpsn_zillow_rental_details_save();
			//add_action('save_post', array(&$this, 'save_post'));
			add_action( 'save_post', 'fgpsn_zillow_property_feed_update' );
			add_action( 'save_post', 'fgpsn_zillow_property_info_save' );
			add_action( 'save_post', 'fgpsn_zillow_required_data_save' );
			add_action( 'save_post', 'fgpsn_repeatable_meta_box_save');
			add_action( 'save_post', 'fgpsn_zillow_location_save' );
			add_action( 'save_post', 'fgpsn_zillow_listing_save' );
			add_action( 'save_post', 'fgpsn_zillow_rental_details_save' );
			
			
		} // END public function init()

		/**
		 * Create the post type
		 */
		public function create_post_type()
		{
			register_post_type(self::POST_TYPE,
				array(
					'labels' => array(
						'name'               => _x( 'Rental Properties', 'post type general name' ),
						'singular_name'      => _x( 'Rental Property', 'post type singular name' ),
						'add_new'            => _x( 'Add Rental', 'fgpsn_zillowlisting' ),
						'add_new_item'       => __( 'Add New Rental' ),
						'edit_item'          => __( 'Edit Property Data' ),
						'new_item'           => __( 'New Rental Property' ),
						'all_items'          => __( 'All Rental Properties' ),
						'view_item'          => __( 'View Rental Property' ),
						'search_items'       => __( 'Search Rental Properties' ),
						'not_found'          => __( 'No Properties Found' ),
						'not_found_in_trash' => __( 'No Properties found in the Trash' ),
						'parent_item_colon'  => '',
						'menu_name'          => 'Rental Properties'
					),
					'description'   => 'Rental Data',
					'public'        => true,
					'menu_position' => 7,
					'supports'      => array( 'title',
												'editor',
												'author',
												'revisions',
												'page-attributes',
												'excerpt',
												'thumbnail',
												'trackbacks',
												'comments' ),
												
					'taxonomies'      => array( 'property_features'  ),
					'hierarchical' => true,
					'has_archive'   => true
				)
			);
		}

		/**
		 * Save the metaboxes for this custom post type
		 */
		public function fgpsn_zillow_property_feed_update($post_id)
		{
			//var_dump($_POST);
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
				return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			}
			
			//var_dump($_POST);
			/* check if the custom field is submitted (checkboxes that aren't marked, aren't submitted) */
			if(isset($_POST['fgpsn_update_zillow_feed'])){
				/* build the feed here */
				update_post_meta($post_id, 'fgpsn_update_zillow_feed_result', 'Feed Updated' );
				add_post_meta($postid, 'fgpsn_update_zillow_feed_result', 1, true );
			}
			else{
				/* not marked? delete the value in the database */
				update_post_meta($post_id, 'fgpsn_update_zillow_feed_result', 'No Feed Update' );
				add_post_meta($postid, 'fgpsn_update_zillow_feed_result', 0, true );
			}
		   // var_dump($_POST);
		
		
		} // END public function fgpsn_zillow_property_feed_update($post_id)
        
        
        
		public function fgpsn_zillow_property_info_save( $post_id ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

			if ( !wp_verify_nonce( $_POST['fgpsn_zillow_property_info_content_nonce'], plugin_basename( __FILE__ ) ) )
			return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
				return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			}

			update_post_meta( $post_id, 'fgpsn_property_address_1', $_POST['fgpsn_property_address_1'] );
			update_post_meta( $post_id, 'fgpsn_property_address_2', $_POST['fgpsn_property_address_1'] );
			update_post_meta( $post_id, 'fgpsn_property_city', $_POST['fgpsn_property_address_1'] );
			update_post_meta( $post_id, 'fgpsn_property_state', $_POST['fgpsn_property_address_1'] );
			update_post_meta( $post_id, 'fgpsn_property_zip', $_POST['fgpsn_property_address_1'] );
			update_post_meta( $post_id, 'property_hmy', $_POST['fgpsn_property_address_1'] );
			update_post_meta( $post_id, 'fgpsn_site_id', $_POST['fgpsn_property_address_1'] );


			if ( ! wp_is_post_revision( $post_id ) ){

				// unhook this function so it doesn't loop infinitely
				remove_action('save_post', 'fgpsn_zillow_property_info_save');

				// update the post, which calls save_post again
				wp_update_post( $my_post );

				// re-hook this function
				add_action('save_post', 'fgpsn_zillow_property_info_save');
				
			}

		}// END public function fgpsn_zillow_property_info_save($post_id)
        
	
	
	
	
        function fgpsn_zillow_required_data_save( $post_id ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

			if ( !wp_verify_nonce( $_POST['fgpsn_required_zillow_data_nonce'], plugin_basename( __FILE__ ) ) )
			return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
				return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			}
			/*all required for xilloq */
			//echo '<H3>ID: ' . $post_id . ', ' . $_POST['fgpsn_PropertyType'] . '</H3>';
			update_post_meta( $post_id, 'fgpsn_StreetAddress', $_POST['fgpsn_StreetAddress'] );
			update_post_meta( $post_id, 'fgpsn_PropertyType', $_POST['fgpsn_PropertyType'] );
			update_post_meta( $post_id, 'fgpsn_UnitNumber', $_POST['fgpsn_UnitNumber'] );
			update_post_meta( $post_id, 'fgpsn_City', $_POST['fgpsn_City'] );
			update_post_meta( $post_id, 'fgpsn_State', $_POST['fgpsn_State'] );
			update_post_meta( $post_id, 'fgpsn_Zip', $_POST['fgpsn_Zip'] );

			update_post_meta( $post_id, 'fgpsn_ListingEmail', $_POST['fgpsn_ListingEmail'] );
			update_post_meta( $post_id, 'fgpsn_Price', $_POST['fgpsn_Price'] );
			update_post_meta( $post_id, 'fgpsn_Status', $_POST['fgpsn_Status'] );
			update_post_meta( $post_id, 'fgpsn_Bathrooms', $_POST['fgpsn_Bathrooms'] );
			update_post_meta( $post_id, 'fgpsn_Bedrooms', $_POST['fgpsn_Bedrooms'] );


			if ( ! wp_is_post_revision( $post_id ) ){

				// unhook this function so it doesn't loop infinitely
				remove_action('save_post', 'fgpsn_zillow_required_data_save');

				// update the post, which calls save_post again
				wp_update_post( $my_post );

				// re-hook this function
				add_action('save_post', 'fgpsn_zillow_required_data_save');
			}

			
		} // END public function fgpsn_zillow_required_data_save($post_id)

        
               
        
        public function fgpsn_repeatable_meta_box_save($post_id) {
	
			if ( ! isset( $_POST['fgpsn_repeatable_meta_box_nonce'] ) ||
			! wp_verify_nonce( $_POST['fgpsn_repeatable_meta_box_nonce'], 'fgpsn_repeatable_meta_box_nonce' ) )
				return;
			
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
				return;
			
			if (!current_user_can('edit_post', $post_id))
				return;
			
			$old = get_post_meta($post_id, 'fgpsn_Room', true);
			$new = array();
			$old_appliance = get_post_meta($post_id, 'fgpsn_Appliance', true);
			$new_appliance = array();
			$options = fgpsn_get_sample_options();
			//echo "<H1>Old: " . $old[0] . "</H1>";
			//echo "<H1>old_appliance: " . $old_appliance[0] . "</H1>";
			$fgpsn_Room = $_POST['fgpsn_Room'];
			$fgpsn_Appliance = $_POST['fgpsn_Appliance'];
			//echo "<H1>Room: " . $fgpsn_Room[0] . "</H1>";
			//echo "<H1>Appliance: " . $fgpsn_Appliance[0] . "</H1>";
			//$fgpsn_Room = count( $fgpsn_Room );
			
			for ( $i = 0; $i < count( $fgpsn_Room ); $i++ ) {
				if ( $fgpsn_Room[$i] != '' ) :
					$new[$i]['fgpsn_Room'] = stripslashes( strip_tags( $fgpsn_Room[$i] ) );
				endif;
			}
			if ( !empty( $new ) && $new != $old )
				update_post_meta( $post_id, 'fgpsn_Room', $new );
			elseif ( empty($new) && $old )
				delete_post_meta( $post_id, 'fgpsn_Room', $old );
				
			
			for ( $i = 0; $i < count( $fgpsn_Appliance ); $i++ ) {
				//echo "<H1>Appliance: " . $fgpsn_Appliance[$i] . "</H1>";
				if ( $fgpsn_Appliance[$i] != '' ) :
					$new_appliance[$i]['fgpsn_Appliance'] = stripslashes( strip_tags( $fgpsn_Appliance[$i] ) );
				endif;
			}
			if ( !empty( $new_appliance ) && $new_appliance != $old_appliance )
				update_post_meta( $post_id, 'fgpsn_Appliance', $new_appliance );
				
			elseif ( empty($new_appliance) && $old_appliance )
				delete_post_meta( $post_id, 'fgpsn_Appliance', $old_appliance );
				
				
				
			if ( ! wp_is_post_revision( $post_id ) ){

				// unhook this function so it doesn't loop infinitely
				remove_action('save_post', 'fgpsn_repeatable_meta_box_save');

				// update the post, which calls save_post again
				wp_update_post( $my_post );

				// re-hook this function
				add_action('save_post', 'fgpsn_repeatable_meta_box_save');
			}

		}  // END public function fgpsn_repeatable_meta_box_save($post_id)
		
		
		
		
		
		public function fgpsn_zillow_location_save( $post_id ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

			if ( !wp_verify_nonce( $_POST['fgpsn_zillow_location_nonce'], plugin_basename( __FILE__ ) ) )
			return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
				return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			}

			
			update_post_meta( $post_id, 'fgpsn_Lat', $_POST['fgpsn_Lat'] );
			update_post_meta( $post_id, 'fgpsn_Long', $_POST['fgpsn_Long'] );
			update_post_meta( $post_id, 'fgpsn_DisplayAddress', $_POST['fgpsn_DisplayAddress'] );


				if ( ! wp_is_post_revision( $post_id ) ){

					//$my_post = array();
					//$my_post['ID'] = $post_id;
					//$my_post['post_title'] = $post_title;


					// unhook this function so it doesn't loop infinitely
					remove_action('save_post', 'fgpsn_zillow_location_save');

					// update the post, which calls save_post again
					wp_update_post( $my_post );

					// re-hook this function
					add_action('save_post', 'fgpsn_zillow_location_save');
			}

		}  // END public function fgpsn_zillow_location_save($post_id)
		
		
		public function fgpsn_zillow_listing_save( $post_id ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

			if ( !wp_verify_nonce( $_POST['fgpsn_zillow_listing_nonce'], plugin_basename( __FILE__ ) ) )
			return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
				return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			}

			
			/* ListingUrl is the post permalink so, no worries */
			update_post_meta( $post_id, 'fgpsn_MlsId', $_POST['fgpsn_MlsId'] );
			update_post_meta( $post_id, 'fgpsn_MlsName', $_POST['fgpsn_MlsName'] );
			update_post_meta( $post_id, 'fgpsn_VirtualTourUrl', $_POST['fgpsn_VirtualTourUrl'] );
			update_post_meta( $post_id, 'fgpsn_ListingEmail', $_POST['fgpsn_ListingEmail'] );
			update_post_meta( $post_id, 'fgpsn_AlwaysEmailAgent', $_POST['fgpsn_AlwaysEmailAgent'] );


			if ( ! wp_is_post_revision( $post_id ) ){

				// unhook this function so it doesn't loop infinitely
				remove_action('save_post', 'fgpsn_zillow_listing_save');

				// update the post, which calls save_post again
				wp_update_post( $my_post );

				// re-hook this function
				add_action('save_post', 'fgpsn_zillow_listing_save');
			}

		} // END public function fgpsn_zillow_listing_save($post_id)




		public function fgpsn_zillow_rental_details_save( $post_id ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

			if ( !wp_verify_nonce( $_POST['fgpsn_zillow_rental_details_nonce'], plugin_basename( __FILE__ ) ) )
			return;

			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) )
				return;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			}

			update_post_meta( $post_id, 'fgpsn_Availability', $_POST['fgpsn_Availability'] );
			update_post_meta( $post_id, 'fgpsn_LeaseTerm', $_POST['fgpsn_LeaseTerm'] );
			update_post_meta( $post_id, 'fgpsn_DepositFees', $_POST['fgpsn_DepositFees'] );
			update_post_meta( $post_id, 'fgpsn_Water', $_POST['fgpsn_Water'] );
			update_post_meta( $post_id, 'fgpsn_Sewage', $_POST['fgpsn_Sewage'] );
			update_post_meta( $post_id, 'fgpsn_Garbage', $_POST['fgpsn_Garbage'] );
			update_post_meta( $post_id, 'fgpsn_Electricity', $_POST['fgpsn_Electricity'] );

			update_post_meta( $post_id, 'fgpsn_Gas', $_POST['fgpsn_Gas'] );
			update_post_meta( $post_id, 'fgpsn_Internet', $_POST['fgpsn_Internet'] );
			update_post_meta( $post_id, 'fgpsn_Cable', $_POST['fgpsn_Cable'] );
			update_post_meta( $post_id, 'fgpsn_SatTV', $_POST['fgpsn_SatTV'] );
			update_post_meta( $post_id, 'fgpsn_Sewage', $_POST['fgpsn_Sewage'] );
			update_post_meta( $post_id, 'fgpsn_Garbage', $_POST['fgpsn_Garbage'] );
			update_post_meta( $post_id, 'fgpsn_Electricity', $_POST['fgpsn_Electricity'] );

			update_post_meta( $post_id, 'fgpsn_NoPets', $_POST['fgpsn_NoPets'] );
			update_post_meta( $post_id, 'fgpsn_Cats', $_POST['fgpsn_Cats'] );
			update_post_meta( $post_id, 'fgpsn_SmallDogs', $_POST['fgpsn_SmallDogs'] );
			update_post_meta( $post_id, 'fgpsn_LargeDogs', $_POST['fgpsn_LargeDogs'] );
			
			
			if ( ! wp_is_post_revision( $post_id ) ){

				// unhook this function so it doesn't loop infinitely
				remove_action('save_post', 'fgpsn_zillow_rental_details_save');

				// update the post, which calls save_post again
				wp_update_post( $my_post );

				// re-hook this function
				add_action('save_post', 'fgpsn_zillow_rental_details_save');
			}

		}// END public function fgpsn_zillow_rental_details_save($post_id)



		

        
    } // END class PostTypeTemplate
} // END if(!class_exists('PostTypeTemplate'))

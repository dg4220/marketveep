<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Zillow_Posting_Manager
 * @subpackage Zillow_Posting_Manager/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Zillow_Posting_Manager
 * @subpackage Zillow_Posting_Manager/includes
 * @author     Your Name <email@example.com>
 */
class Zillow_Posting_Manager {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Zillow_Posting_Manager_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $zillow_posting_manager    The string used to uniquely identify this plugin.
	 */
	protected $zillow_posting_manager;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->zillow_posting_manager = 'zillow-posting-manager';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Zillow_Posting_Manager_Loader. Orchestrates the hooks of the plugin.
	 * - Zillow_Posting_Manager_i18n. Defines internationalization functionality.
	 * - Zillow_Posting_Manager_Admin. Defines all hooks for the admin area.
	 * - Zillow_Posting_Manager_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-zillow-posting-manager-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-zillow-posting-manager-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-zillow-posting-manager-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-zillow-posting-manager-public.php';

		$this->loader = new Zillow_Posting_Manager();

	}

	
	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Zillow_Posting_Manager_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Zillow_Posting_Manager_i18n();
		$plugin_i18n->set_domain( $this->get_zillow_posting_manager() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Zillow_Posting_Manager_Admin( $this->get_zillow_posting_manager(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Zillow_Posting_Manager_Public( $this->get_zillow_posting_manager(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_zillow_posting_manager() {
		return $this->zillow_posting_manager;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Zillow_Posting_Manager_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	

	
}

/* end creating class */




function createZillowPropertyType() {
	
	$labels = array(
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
		);

		$args = array(
			'labels'        => $labels,
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
		);

	register_post_type( 'fgpsn_zillowlisting', $args );
}
add_action( 'init', 'createZillowPropertyType' );
//flush_rewrite_rules();
//add taxonomy
add_action( 'init', 'create_property_features' );

function create_property_features() {
 $labels = array(
    'name' => _x( 'Property Features', 'taxonomy general name' ),
    'singular_name' => _x( 'Property Feature', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Property Features' ),
    'all_items' => __( 'All Property Features' ),
    'parent_item' => __( 'Parent Feature' ),
    'parent_item_colon' => __( 'Parent Feature:' ),
    'edit_item' => __( 'Edit Feature' ),
    'update_item' => __( 'Update Feature' ),
    'add_new_item' => __( 'Add New Feature' ),
    'new_item_name' => __( 'New Feature Name' ),
  );

  register_taxonomy('property_features','fgpsn_zillowlisting',array(
    'hierarchical'	=> true,
    'labels'		=> $labels,
    query_vars		=> true

  ));
}

/* add functionality to create update zillow XML file */
add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions' );

function my_post_submitbox_misc_actions(){
	?>
	<div class="misc-pub-section my-options">
		<input type="checkbox" id="fgpsn_update_zillow_feed" name="fgpsn_update_zillow_feed">
		<label for="fgpsn_update_zillow_feed">Update Zillow Feed</label>
		
		<label for="fgpsn_update_zillow_feed_result">Updated?</label><br />
		<input type="text" size="20" id="fgpsn_update_zillow_feed_result" name="fgpsn_update_zillow_feed_result" value="<?PHP echo get_post_meta(get_the_ID(), 'fgpsn_update_zillow_feed_result', true); ?>">
	
	<?php	
	
	$fgpsn_zillow_xml_string = "<Listings>
	<Listing>
		<Location>
			<StreetAddress>"
			. 
			$_POST['fgpsn_StreetAddress']
			. 
			"</StreetAddress>
			<UnitNumber>"
			. 
			$_POST['fgpsn_update_UnitNumber']
			. 
			"</UnitNumber>
			<City>"
			. 
			$_POST['fgpsn_City']
			. 
			"</City>
			<State>"
			. 
			$_POST['fgpsn_State']
			. 
			"</State>
			<Zip>"
			. 
			$_POST['fgpsn_Zip']
			. 
			"</Zip>
			<Lat> "
			. 
			$_POST['fgpsn_Lat']
			. 
			"</Lat>
			<Long> "
			. 
			$_POST['fgpsn_Long']
			. 
			"</Long>
			<DisplayAddress>"
			. 
			$_POST['fgpsn_DisplayAddress']
			. 
			"</DisplayAddress>
		</Location>
		<ListingDetails>
			<Status>"
			. 
			$_POST['fgpsn_Status']
			. 
			"</Status>
			<Price>"
			. 
			$_POST['fgpsn_Price']
			. 
			"</Price>
			<ListingUrl>"
			. 
			$_POST['fgpsn_ListingUrl']
			. 
			"</ListingUrl>
			<MlsId>"
			. 
			$_POST['fgpsn_MlsId']
			. 
			"</MlsId>
			<MlsName>"
			. 
			$_POST['fgpsn_MlsName']
			. 
			"</MlsName>
			<VirtualTourUrl>"
			. 
			$_POST['fgpsn_VirtualTourUrl']
			. 
			"</VirtualTourUrl >
			<ListingEmail>"
			. 
			$_POST['fgpsn_ListingEmail']
			. 
			"</ListingEmail >
			<AlwaysEmailAgent>"
			. 
			$_POST['fgpsn_AlwaysEmailAgent']
			. 
			"</AlwaysEmailAgent>
		</ListingDetails>
		<RentalDetails/>
			<Availability>"
			. 
			$_POST['fgpsn_Availability']
			. 
			"</Availability>
			<LeaseTerm>"
			. 
			$_POST['fgpsn_LeaseTerm']
			. 
			"</LeaseTerm>
			<DepositFees>"
			. 
			$_POST['fgpsn_DepositFees']
			. 
			"<DepositFees>
			<UtilitiesIncluded>
				<Water>"
				. 
				$_POST['fgpsn_UtilitiesIncluded']
				. 
				"</Water>
				<Sewage>"
			. 
			$_POST['fgpsn_Sewage']
			. 
			"</Sewage>
				<Garbage>"
			. 
			$_POST['fgpsn_Garbage']
			. 
			"</Garbage>
				<Electricity>"
			. 
			$_POST['fgpsn_Electricity']
			. 
			"</Electricity>
				<Gas>"
			. 
			$_POST['fgpsn_Gas']
			. 
			"</Gas>
				<Internet>"
			. 
			$_POST['fgpsn_Internet']
			. 
			"</Internet>
				<Cable>"
			. 
			$_POST['fgpsn_Cable']
			. 
			"</Cable>
				<SatTV>"
			. 
			$_POST['fgpsn_SatTV']
			. 
			"</SatTV>
			</UtilitiesIncluded>
			<PetsAllowed>
			<NoPets>"
			. 
			$_POST['fgpsn_NoPets']
			. 
			"</NoPets>
			<Cats>"
			. 
			$_POST['fgpsn_Cats']
			. 
			" </Cats>
			<SmallDogs>"
			. 
			$_POST['fgpsn_SmallDogs']
			. 
			"</SmallDogs>
			<LargeDogs>"
			. 
			$_POST['fgpsn_LargeDogs']
			. 
			"</LargeDogs>
			</PetsAllowed>
		</RentalDetails/>
		<BasicDetails>
			<PropertyType>"
			. 
			$_POST['fgpsn_PropertyType']
			. 
			"</PropertyType>
			<Title>"
			. 
			$_POST['fgpsn_Title']
			. 
			"</Title>
			<Description>"
			. 
			$_POST['fgpsn_Description']
			. 
			"</Description>
			<Bedrooms>"
			. 
			$_POST['fgpsn_Bedrooms']
			. 
			"</Bedrooms>
			<Bathrooms>"
			. 
			$_POST['fgpsn_Bathrooms']
			. 
			"</Bathrooms>
			<LivingArea>"
			. 
			$_POST['fgpsn_LivingArea']
			. 
			"</LivingArea>
			<LotSize>"
			. 
			$_POST['fgpsn_LotSize']
			. 
			"</LotSize>
			<YearBuilt>"
			. 
			$_POST['fgpsn_YearBuilt']
			. 
			"</YearBuilt>
		</BasicDetails>
		<Pictures>
			<Picture>
				<PictureUrl>"
			. 
			$_POST['fgpsn_PictureUrl']
			. 
			"</PictureUrl>
				<Caption>"
			. 
			$_POST['fgpsn_Caption']
			. 
			"</Caption>
			</Picture>
			<Picture>
				<PictureUrl>"
			. 
			$_POST['fgpsn_PictureUrl']
			. 
			"</PictureUrl>
				<Caption"
			. 
			$_POST['fgpsn_Caption']
			. 
			"</Caption>
			</Picture>
		</Pictures>
		<Agent>
			<FirstName>"
			. 
			$_POST['fgpsn_FirstName']
			. 
			"</FirstName>
			<LastName>"
			. 
			$_POST['fgpsn_LastName']
			. 
			"</LastName>
			<EmailAddress>"
			. 
			$_POST['fgpsn_EmailAddress']
			. 
			"</EmailAddress>
			<PictureUrl>"
			. 
			$_POST['fgpsn_PictureUrl']
			. 
			"</PictureUrl>
			<OfficeLineNumber>"
			. 
			$_POST['fgpsn_OfficeLineNumber']
			. 
			"</OfficeLineNumber>
			<MobilePhoneLineNumber>"
			. 
			$_POST['fgpsn_Long']
			. 
			"</MobilePhoneLineNumber>
			<FaxLineNumber>"
			. 
			$_POST['fgpsn_FaxLineNumber']
			. 
			"</FaxLineNumber>
		</Agent>
		<Office>
			<BrokerageName>"
			. 
			$_POST['BrokerageName_Long']
			. 
			"</BrokerageName>
			<BrokerPhone>"
			. 
			$_POST['BrokerPhone_Long']
			. 
			"</BrokerPhone>
			<StreetAddress>"
			. 
			$_POST['fgpsn_StreetAddress']
			. 
			"</StreetAddress>
			<UnitNumber>"
			. 
			$_POST['fgpsn_UnitNumber']
			. 
			"</UnitNumber>
			<City>"
			. 
			$_POST['fgpsn_City']
			. 
			"</City>
			<State>"
			. 
			$_POST['fgpsn_State']
			. 
			"</State>
			<Zip>"
			. 
			$_POST['fgpsn_Zip']
			. 
			"</Zip>
		</Office>
		<OpenHouses>
		</OpenHouses>
		<Neighborhood>
			<Name>"
			. 
			$_POST['fgpsn_Name']
			. 
			"</Name>
			<Description>"
			. 
			$_POST['fgpsn_Description']
			. 
			"</Description>
		</Neighborhood>
		<RichDetails>
			<AdditionalFeatures>"
			. 
			$_POST['fgpsn_AdditionalFeatures']
			. 
			"</AdditionalFeatures>
			<Appliances>
				<Appliance>"
			. 
			$_POST['fgpsn_Appliance']
			. 
			"</Appliance>
				<Appliance>"
			. 
			$_POST['fgpsn_Appliance']
			. 
			"</Appliance>
			</Appliances>
			<ArchitectureStyle>"
			. 
			$_POST['fgpsn_ArchitectureStyle']
			. 
			"</ArchitectureStyle>
			<Attic>"
			. 
			$_POST['fgpsn_Attic']
			. 
			"</Attic>
			<Basement>"
			. 
			$_POST['fgpsn_Basement']
			. 
			"</Basement>
			<CableReady>"
			. 
			$_POST['fgpsn_CableReady']
			. 
			"</CableReady>
			<CoolingSystems>
				<CoolingSystem>"
			. 
			$_POST['fgpsn_CoolingSystem']
			. 
			"</CoolingSystem>
			</CoolingSystems>
			<Deck>"
			. 
			$_POST['fgpsn_Deck']
			. 
			"</Deck>
			<DoublePaneWindows>"
			. 
			$_POST['fgpsn_DoublePaneWindows']
			. 
			"</DoublePaneWindows>
			<ExteriorTypes>
				<ExteriorType>"
			. 
			$_POST['fgpsn_ExteriorType']
			. 
			"</ExteriorType>
				<ExteriorType>"
			. 
			$_POST['fgpsn_ExteriorType']
			. 
			"</ExteriorType>
			</ExteriorTypes>
			<Fireplace>"
			. 
			$_POST['fgpsn_Fireplace']
			. 
			"</Fireplace>
			<FloorCoverings>
				<FloorCovering>"
			. 
			$_POST['fgpsn_FloorCovering']
			. 
			"</FloorCovering>
				<FloorCovering>"
			. 
			$_POST['fgpsn_FloorCovering']
			. 
			"</FloorCovering>
				<FloorCovering>"
			. 
			$_POST['fgpsn_FloorCovering']
			. 
			"</FloorCovering>
			</FloorCoverings>
			<Garden>"
			. 
			$_POST['fgpsn_Garden']
			. 
			"</Garden>
			<HeatingFuels>
				<HeatingFuel>"
			. 
			$_POST['fgpsn_HeatingFuel']
			. 
			"</HeatingFuel>
			</HeatingFuels>
			<HeatingSystems>
				<HeatingSystem>"
			. 
			$_POST['fgpsn_HeatingSystem']
			. 
			"</HeatingSystem>
			</HeatingSystems>
			<JettedBathTub>"
			. 
			$_POST['fgpsn_JettedBathTub']
			. 
			"</JettedBathTub>
			<Lawn>"
			. 
			$_POST['fgpsn_Lawn']
			. 
			"</Lawn>
			<MotherInLaw>"
			. 
			$_POST['fgpsn_MotherInLaw']
			. 
			"</MotherInLaw>
			<NumFloors>"
			. 
			$_POST['fgpsn_NumFloors']
			. 
			"</NumFloors>
			<NumParkingSpaces>"
			. 
			$_POST['fgpsn_NumParkingSpaces']
			. 
			"</NumParkingSpaces>
			<ParkingTypes>
				<ParkingType>"
			. 
			$_POST['fgpsn_ParkingType']
			. 
			"</ParkingType>
				<ParkingType>"
			. 
			$_POST['fgpsn_ParkingType']
			. 
			"</ParkingType>
			</ParkingTypes>
			<Patio>"
			. 
			$_POST['fgpsn_Patio']
			. 
			"</Patio>
			<Porch>"
			. 
			$_POST['fgpsn_Porch']
			. 
			"</Porch>
			<RoofTypes>
				<RoofType>"
			. 
			$_POST['fgpsn_RoofType']
			. 
			"</RoofType>
			</RoofTypes>
			<RoomCount>"
			. 
			$_POST['fgpsn_RoomCount']
			. 
			"</RoomCount>
			<Rooms>
				<Room>"
			. 
			$_POST['fgpsn_Room']
			. 
			"</Room>
				<Room>"
			. 
			$_POST['fgpsn_Room']
			. 
			"</Room>
				<Room>"
			. 
			$_POST['fgpsn_Room']
			. 
			"</Room>
				<Room>"
			. 
			$_POST['fgpsn_Room']
			. 
			"</Room>
				<Room>"
			. 
			$_POST['fgpsn_Room']
			. 
			"</Room>
			</Rooms>
			<SecuritySystem>"
			. 
			$_POST['fgpsn_SecuritySystem']
			. 
			"</SecuritySystem>
			<Skylight>"
			. 
			$_POST['fgpsn_Skylight']
			. 
			"</Skylight>
			<SprinklerSystem>"
			. 
			$_POST['fgpsn_SprinklerSystem']
			. 
			"</SprinklerSystem>
			<ViewTypes>
				<ViewType>"
			. 
			$_POST['fgpsn_ViewType']
			. 
			"</ViewType>
				<ViewType>"
			. 
			$_POST['fgpsn_ViewType']
			. 
			"</ViewType>
			</ViewTypes>
			<Waterfront>"
			. 
			$_POST['fgpsn_Waterfront']
			. 
			"</Waterfront>
			<WhatOwnerLoves>"
			. 
			$_POST['fgpsn_WhatOwnerLoves']
			. 
			"</WhatOwnerLoves>
			<YearUpdated>"
			. 
			$_POST['fgpsn_YearUpdated']
			. 
			"</YearUpdated>
			<FitnessCenter>"
			. 
			$_POST['fgpsn_FitnessCenter']
			. 
			"<FitnessCenter>
			<BasketballCourt>"
			. 
			$_POST['fgpsn_BasketballCourt']
			. 
			"</BasketballCourt>
			<TennisCourt>"
			. 
			$_POST['fgpsn_TennisCourt']
			. 
			"</TennisCourt/>
			<NearTransportation>"
			. 
			$_POST['fgpsn_NearTransportation']
			. 
			"</NearTransportation>
			<ControlledAccess>"
			. 
			$_POST['fgpsn_ControlledAccess']
			. 
			"</ControlledAccess>
			<Over55ActiveCommunity>"
			. 
			$_POST['fgpsn_Over55ActiveCommunity']
			. 
			"</Over55ActiveCommunity>
			<AssistedLivingCommunity>"
			. 
			$_POST['fgpsn_AssistedLivingCommunity']
			. 
			"</AssistedLivingCommunity>
			<Storage>"
			. 
			$_POST['fgpsn_Storage']
			. 
			"</Storage>
			<FencedYard>"
			. 
			$_POST['fgpsn_FencedYard']
			. 
			"</FencedYard>
			<PropertyName>"
			. 
			$_POST['fgpsn_PropertyName']
			. 
			"</PropertyName>
			<Furnished>"
			. 
			$_POST['fgpsn_Furnished']
			. 
			"</Furnished>
			<HighspeedInternet>"
			. 
			$_POST['fgpsn_HighspeedInternet']
			. 
			"</HighspeedInternet>
			<OnsiteLaundry>"
			. 
			$_POST['fgpsn_OnsiteLaundry']
			. 
			"</OnsiteLaundry>
			<CableSatTV>"
			. 
			$_POST['fgpsn_CableSatTV']
			. 
			"</CableSatTV>
		</RichDetails>
	</Listing>
</Listings>";
	

	
	?>
	</div>
	<?php
}


add_action( 'save_post', 'fgpsn_zillow_property_feed_update' );
function fgpsn_zillow_property_feed_update( $post_id ) {
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
}
/*include meta boxes from fgpsn_properties
 * better to do it here rather than including fgpsn_zillowlisting in the $screens
 * array in the meta boc call back
 */
 
//add_action( 'add_meta_boxes', 'fgpsn_zillow_property_info' );
function fgpsn_zillow_property_info() {

	$screens = array( 'fgpsn_zillowlisting', );
    foreach ($screens as $screen) {
		add_meta_box(
			'fgpsn_zillow_property_info',
			__( 'Property Data', 'zillow-posting-manager' ),
			'fgpsn_zillow_property_info_content',
			$screen,
			'normal',
			'high'
		);
	}
}


function fgpsn_zillow_property_info_content( $post ) {


	wp_nonce_field( plugin_basename( __FILE__ ), 'fgpsn_zillow_property_info_content_nonce' );

	echo '<FIELDSET><DIV ID="meta_col_left_third" STYLE="position: relative; display: inline; float: left; width: 30%;">
	<P><label for="property_hmy" STYLE="width: 110px;">Property HMY</label>';

	$property_hmy = get_post_meta(get_the_ID(), 'property_hmy', true);
	echo '<input id="property_hmy" name="property_hmy" size=5 value="' . $property_hmy . '" type="text"></P>
	<P><label for="fgpsn_site_id" STYLE="width: 110px;">Site ID</label>';

	$fgpsn_site_id = get_post_meta(get_the_ID(), 'fgpsn_site_id', true);
	echo '<input id="fgpsn_site_id" name="fgpsn_site_id" size=5 value="' . $fgpsn_site_id . '" type="text"></P>

	<P><label for="fgpsn_property_address_1" STYLE="width: 110px;">Address 1</label>';

	$fgpsn_property_address_1 = get_post_meta(get_the_ID(), 'fgpsn_property_address_1', true);
	echo '<input id="fgpsn_property_address_1" name="fgpsn_property_address_1" size=5 value="' . $fgpsn_property_address_1 . '" type="text"></P>

	<P><label for="fgpsn_property_address_2" STYLE="width: 110px;">Address 2</label>';

	$fgpsn_property_address_2 = get_post_meta(get_the_ID(), 'fgpsn_property_address_2', true);
	echo '<input id="fgpsn_property_address_2" name="fgpsn_property_address_2" size=5 value="' . $fgpsn_property_address_2 . '" type="text"></P>

	<P><label for="fgpsn_property_city" STYLE="width: 110px;">City</label>';

	$fgpsn_property_city = get_post_meta(get_the_ID(), 'fgpsn_property_city', true);
	echo '<input id="fgpsn_property_city" name="fgpsn_property_city" size=5 value="' . $fgpsn_property_city . '" type="text"></P>

	<P><label for="state" STYLE="width: 110px;">State</label>';

	$fgpsn_property_state = get_post_meta(get_the_ID(), 'fgpsn_property_state', true);
	echo '<input id="sfgpsn_property_tate" name="fgpsn_property_state" size=5 value="' . $fgpsn_property_state . '" type="text"></P>

	<P><label for="fgpsn_property_zip" STYLE="width: 110px;">Zipcode</label>';

	$fgpsn_property_zip = get_post_meta(get_the_ID(), 'fgpsn_property_zip', true);
	echo '<input id="fgpsn_property_zip" name="fgpsn_property_zip" size=5 value="' . $fgpsn_property_zip . '" type="text"></P>';


     echo "</DIV></FIELDSET>";


}


add_action( 'save_post', 'fgpsn_zillow_property_info_save' );
function fgpsn_zillow_property_info_save( $post_id ) {

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
//echo "<H1>LINE 268 - " . $post_id . " - " . $_POST['unit_occupant_id'] . "</H1>";

	$address_1 = $_POST['fgpsn_property_address_1'];
	$address_2 = $_POST['fgpsn_property_address_2'];
	$city = $_POST['fgpsn_property_city'];
	$state = $_POST['fgpsn_property_state'];
	$zip = $_POST['fgpsn_property_zip'];
	$property_hmy = $_POST['property_hmy'];
	$fgpsn_site_id = $_POST['fgpsn_site_id'];


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

}


//adding required property data
add_action( 'add_meta_boxes', 'fgpsn_zillow_requiredData' );
function fgpsn_zillow_requiredData() {

	$screens = array( 'fgpsn_zillowlisting', );
    foreach ($screens as $screen) {
		add_meta_box(
			'fgpsn_zillow_required_data',
			__( 'Required Zillow Listing Data', 'zillow-posting-manager' ),
			'fgpsn_required_zillow_data',
			$screen,
			'side',
			'high'
		);
	}
}


function fgpsn_required_zillow_data( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'fgpsn_required_zillow_data_nonce' );
	
	$cur_type = get_post_meta(get_the_ID(), 'fgpsn_PropertyType', true);
	$cur_status = get_post_meta(get_the_ID(), 'fgpsn_Status', true);
	echo '<FIELDSET><DIV>
	
	<P><label for="fgpsn_PropertyType">Property Types </label>
	<select name="fgpsn_PropertyType">
		<option value="SingleFamily" ';
		if ( $cur_type == 'SingleFamily' ) {
			echo ' selected';
		}
		echo '>SingleFamily</option>
		<option value="Condo" ';
		if ( $cur_type == 'Condo' ) {
			echo ' selected';
		}
		echo '>Condo</option>
		<option value="Townhouse" ';
		if ( $cur_type == 'Townhouse' ) {
			echo ' selected';
		}
		echo '>Townhouse</option>
		<option value="Coop" ';
		if ( $cur_type == 'Coop' ) {
			echo ' selected';
		}
		echo '>Coop</option>
		<option value="MultiFamily" ';
		if ( $cur_type == 'MultiFamily' ) {
			echo ' selected';
		}
		echo '>MultiFamily</option>
		<option value="Manufactured" ';
		if ( $cur_type == 'Manufactured' ) {
			echo ' selected';
		}
		echo '>Manufactured</option>
		<option value="VacantLand" ';
		if ( $cur_type == 'VacantLand' ) {
			echo ' selected';
		}
		echo '>VacantLand</option>
		<option value="Other" ';
		if ( $cur_type == 'Other' ) {
			echo ' selected';
		}
		echo '>Other</option>
		<option value="Apartment" ';
		if ( $cur_type == 'Apartment' ) {
			echo ' selected';
		}
		echo '>Apartment</option>
		
	</select>
	
	<P><label for="fgpsn_StreetAddress">Street Address</label>
	<input id="fgpsn_StreetAddress" name="fgpsn_StreetAddress" size=20 value="' . get_post_meta(get_the_ID(), 'fgpsn_StreetAddress', true) . '" type="text"></P>
	
	<P><label for="fgpsn_UnitNumber">Unit Number</label>
	<input id="fgpsn_UnitNumber" name="fgpsn_UnitNumber" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_UnitNumber', true) . '" type="text"></P>
	
	<P><label for="fgpsn_ListingEmail">Contact Email</label>
	<input id="fgpsn_ListingEmail" name="fgpsn_ListingEmail" size=20
	value="' . get_post_meta(get_the_ID(), 'fgpsn_ListingEmail', true) . '" type="text"></P>
	
	<P><label for="fgpsn_Price">Monthly Rent</label>
	<input id="fgpsn_Price" name="fgpsn_Price" size=6 value="' . get_post_meta(get_the_ID(), 'fgpsn_Price', true) . '" type="text"></P>
	
	<P><label for="fgpsn_Status">Status</label><select name="fgpsn_Status">
		<option value="Active" ';
		if ( $cur_status == 'Active' ) {
			echo ' selected';
		}
		echo '>Active</option>
		<option value="Contingent" ';
		if ( $cur_status == 'Contingent' ) {
			echo ' selected';
		}
		echo '>Contingent</option>
		<option value="Pending" ';
		if ( $cur_status == 'Pending' ) {
			echo ' selected';
		}
		echo '>Pending</option>
		<option value="Ror Rent" ';
		if ( $cur_status == 'For Rent' ) {
			echo ' selected';
		}
		echo '>For Rent</option>
		
	</select></P>

	<P><label for="fgpsn_Bedrooms" >Bedrooms</label>
	<input id="fgpsn_Bedrooms" name="fgpsn_Bedrooms" size=2 value="' . get_post_meta(get_the_ID(), 'fgpsn_Bedrooms', true) . '" type="text"></P>
	
	<P><label for="fgpsn_Bathrooms">Bathrooms</label>
	<input id="fgpsn_Bathrooms" name="fgpsn_Bathrooms" size=2 value="' . get_post_meta(get_the_ID(), 'fgpsn_Bathrooms', true) . '" type="text"></P>
     </DIV></FIELDSET>';

}		

add_action( 'save_post', 'fgpsn_zillow_required_data_save' );
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

			//$my_post = array();
			//$my_post['ID'] = $post_id;
			//$my_post['post_title'] = $post_title;


			// unhook this function so it doesn't loop infinitely
			remove_action('save_post', 'fgpsn_zillow_required_data_save');

			// update the post, which calls save_post again
			wp_update_post( $my_post );

			// re-hook this function
			add_action('save_post', 'fgpsn_zillow_required_data_save');
	}

	
}





add_action('admin_init', 'fgpsn_add_multi_meta_boxes', 1);
function fgpsn_add_multi_meta_boxes() {
	add_meta_box( 'repeatable-fields', 'Repeatable Fields', 'fgpsn_repeatable_meta_box_display', 'fgpsn_zillowlisting', 'side', 'high');
}
function fgpsn_repeatable_meta_box_display() {
	global $post;
	$repeatable_fields = get_post_meta($post->ID, 'fgpsn_Room', true);
	$repeatable_apps = get_post_meta($post->ID, 'fgpsn_Appliance', true);
	
	
	
	$repeatable_PictueUrl = get_post_meta($post->ID, 'fgpsn_PictueUrl', true);
	$options = fgpsn_get_sample_options();
	wp_nonce_field( 'fgpsn_repeatable_meta_box_nonce', 'fgpsn_repeatable_meta_box_nonce' );
	?>
	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-row screen-reader-text' );
			row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
			return false;
		});
  	
		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
		
		$( '#add-app' ).on('click', function() {
			var row = $( '.empty-app.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-app screen-reader-app' );
			row.insertBefore( '#repeatable-fieldset-app tbody>tr:last' );
			return false;
		});
  	
		$( '.remove-app' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
		
		
		$( '#add-PictueUrl' ).on('click', function() {
			var row = $( '.empty-PictueUrl.screen-reader-PictueUrl' ).clone(true);
			row.removeClass( 'empty-PictueUrl screen-reader-PictueUrl' );
			row.insertBefore( '#repeatable-fieldset-PictueUrl tbody>tr:last' );
			return false;
		});
  	
		$( '.remove-PictueUrl' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>
  
	<table id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th colspan=2>Rooms: (Kitchen, Bedroom, eg.)</th>
			<th width="8%"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	if ( $repeatable_fields ) :
	
	foreach ( $repeatable_fields as $field ) {
	?>
	<tr>
		<td><input type="text" class="widefat" name="fgpsn_Room[]" value="<?php if($field['fgpsn_Room'] != '') echo esc_attr( $field['fgpsn_Room'] ); ?>" /></td>
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
		<td><input type="text" class="widefat" name="fgpsn_Room[]" /></td>
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-text">
		<td><input type="text" class="widefat" name="fgpsn_Room[]" /></td>
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	
	<p><a id="add-row" class="button" href="#">Add another</a></p>
	
	<table id="repeatable-fieldset-app" width="100%">
	<thead>
		<tr>
			<th colspan=2>Appliances: (Kitchen, Bedroom, eg.)</th>
			<th width="8%"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	if ( $repeatable_apps ) :
	
	foreach ( $repeatable_apps as $app ) {
	?>
	<tr>
		<td><input type="text" class="widefat" name="fgpsn_Appliance[]" value="<?php if($app['fgpsn_Appliance'] != '') echo esc_attr( $app['fgpsn_Appliance'] ); ?>" /></td>
		<td><a class="button remove-app" href="#">Remove</a></td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
		<td><input type="text" class="widefat" name="fgpsn_Appliance[]" /></td>
		<td><a class="button remove-app" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	
	<!-- empty hidden one for jQuery -->
	<tr class="empty-app screen-reader-app">
		<td><input type="text" class="widefat" name="fgpsn_Appliance[]" /></td>
		<td><a class="button remove-app" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	
	<p><a id="add-app" class="button" href="#">Add another</a></p>
	
	
	<table id="repeatable-fieldset-PictueUrl" width="100%">
	<thead>
		<tr>
			<th colspan=2>Image Urls: </th>
			<th width="8%"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	
	
	
	$test_str = $post->post_content;
	if (strpos($test_str, 'gallery')) {
		$start_ids = strpos($test_str, 'ids="');
		$start_ids = strpos($test_str, '"', $start_ids);
		$end_ids = strpos($test_str, '"', $start_ids + 6);
		$length = $end_ids - $start_ids;
		
		$id_string = substr( $test_str, $start_ids, $length);
		$images_array = explode(',', $id_string);
		foreach($images_array as $k=>$v) {
			echo '<tr>
		<td><input type="text" class="widefat" name="fgpsn_PictueUrl[]" value="';
		
		if(trim($v, '"') != '') {
			echo get_permalink(trim($v, '"'));
		} 
		
		
		echo '" /></td>
		<td><a class="button remove-PictueUrl" href="#">Remove</a></td>
	</tr>';
	
	
	
		}
		
	}
	
	if ( $repeatable_PictueUrl ) :
	
	foreach ( $repeatable_PictueUrl as $PictueLink ) {
	?>
	<tr>
		<td><input type="text" class="widefat" name="fgpsn_PictueUrl[]" value="<?php if($PictueLink['fgpsn_PictueUrl'] != '') echo esc_attr( $PictueLink['fgpsn_PictueUrl'] ); ?>" /></td>
		<td><a class="button remove-PictueUrl" href="#">Remove</a></td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
		<td><input type="text" class="widefat" name="fgpsn_PictueUrl[]" /></td>
		<td><a class="button remove-PictueUrl" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-PictueUrl">
		<td><input type="text" class="widefat" name="fgpsn_PictueUrl[]" /></td>
		<td><a class="button remove-PictueUrl" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	
	<p><a id="add-PictueUrl" class="button" href="#">Add another</a></p>
	
	
	
	<?php
}
add_action('save_post', 'fgpsn_repeatable_meta_box_save');
function fgpsn_repeatable_meta_box_save($post_id) {
	
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
		
	
	
	
	//$options = fgpsn_get_sample_options();
	
	
	
	//$fgpsn_Room = count( $fgpsn_Room );
	
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
}


/* put the required and most common data in other meta boxes and use this as a catchall
 * 
 * 
 * 
 * 
 * 
 * 
 * The only fields required are: 
 * property type - added in,
 *  address (including unit number when applicable) - added in,
 * contact e-mail and
phone number, price, status, number of bedrooms (when applicable), and number of bathrooms (when
applicable); all of these fields are shown in bold in the XML below. While these are the minimum requirements
for each individual listing, feeds must have the ability to exceed those minimum requirements when the
information is available by including photos, descriptions, and other details. Please note that Coming Soon
listings have other requirements. Only feeds that include high quality listings will be accepted.
* 
* 
*  */



//adding property location information
add_action( 'add_meta_boxes', 'fgpsn_zillow_propertyData' );
function fgpsn_zillow_propertyData() {

	$screens = array( 'fgpsn_zillowlisting', );
    foreach ($screens as $screen) {
		add_meta_box(
			'fgpsn_zillow_location_data',
			__( 'Location Data', 'zillow-posting-manager' ),
			'fgpsn_zillow_location',
			$screen,
			'normal',
			'high'
		);
	}
}


function fgpsn_zillow_location( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'fgpsn_zillow_location_nonce' );

	echo '<FIELDSET><DIV>
	
	<P><label for="fgpsn_StreetAddress"">Street Address</label>
	<input id="fgpsn_StreetAddress" name="fgpsn_StreetAddress" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_StreetAddress', true) . '" type="text"></P>
	
	<P><label for="fgpsn_UnitNumber">Unit Number</label>
	<input id="fgpsn_UnitNumber" name="fgpsn_UnitNumber" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_UnitNumber', true) . '" type="text"></P>
	
	<P><label for="fgpsn_City" STYLE="width: 110px;">City</label>
	<input id="fgpsn_City" name="fgpsn_City" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_City', true) . '" type="text"></P>
	
	<P><label for="fgpsn_State">State</label>
	<input id="fgpsn_State" name="fgpsn_State" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_State', true) . '" type="text"></P>
	
	<P><label for="fgpsn_Zip">Zipcode</label>
	<input id="fgpsn_Zip" name="fgpsn_Zip" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_Zip', true) . '" type="text"></P>

	<P><label for="fgpsn_Lat" STYLE="width: 110px;">Latitude</label>
	<input id="fgpsn_Lat" name="fgpsn_Lat" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_Lat', true) . '" type="text"></P>
	
	<P><label for="fgpsn_Long">Longitude</label>
	<input id="fgpsn_Long" name="fgpsn_Long" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_Long', true) . '" type="text"></P>
	
	<P><label for="fgpsn_DisplayAddress">Display Address</label>
	<input id="fgpsn_DisplayAddress" name="fgpsn_DisplayAddress" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_DisplayAddress', true) . '" type="text"></P>
     </DIV></FIELDSET>';

}		

add_action( 'save_post', 'fgpsn_zillow_location_save' );
function fgpsn_zillow_location_save( $post_id ) {

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

}


/*
<ListingDetails>
			<Status>For Rent</Status>
			<Price>1200</Price>
			<ListingUrl>http://ForRentSite.com/listing1111</ListingUrl>
			<MlsId>456790</MlsId>
			<MlsName>NWMLS</MlsName>
			<VirtualTourUrl> http://Site.com/VirTour123.wmv</VirtualTourUrl >
			<ListingEmail> realtor18203892@trackingsystem.com</ListingEmail >
			<AlwaysEmailAgent>1</AlwaysEmailAgent>
		</ListingDetails>

*/



//adding listing details for zillow bound property
add_action( 'add_meta_boxes', 'fgpsn_zillow_ListingDetails' );

/*
 * function fgpsn_zillow_ListingDetails() {

	$screens = array( 'fgpsn_zillowlisting' );
    foreach ($screens as $screen) {
		add_meta_box(
			'fgpsn_zillow_listing_details',
			__( 'Listing Details', 'zillow-posting-manager' ),
			'fgpsn_zillow_listing',
			$screen,
			'normal',
			'high'
		);
	}
}
*/

function fgpsn_zillow_listing( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'fgpsn_zillow_listing_nonce' );

	echo '<FIELDSET><DIV>
	
	<P><label for="fgpsn_Status" STYLE="width: 110px;">Listing Status</label>
	<input id="fgpsn_Status" name="fgpsn_Status" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_Status', true) . '" type="text"></P>
	
	<P><label for="fgpsn_Price">Monthly Rent</label>
	<input id="fgpsn_Price" name="fgpsn_Price" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_Price', true) . '" type="text"></P>
	
	<P><label for="fgpsn_MlsId" STYLE="width: 110px;">MLS ID Number</label>
	<input id="fgpsn_MlsId" name="fgpsn_MlsId" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_MlsId', true) . '" type="text"></P>
	
	<P><label for="fgpsn_MlsName">MLS Name</label>
	<input id="fgpsn_MlsName" name="fgpsn_MlsName" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_MlsName', true) . '" type="text"></P>
	
	<P><label for="fgpsn_VirtualTourUrl">Link to Virtual Tour</label>
	<input id="fgpsn_VirtualTourUrl" name="fgpsn_VirtualTourUrl" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_VirtualTourUrl', true) . '" type="text"></P>

	<P><label for="fgpsn_ListingEmail" STYLE="width: 110px;">Contact Email</label>
	<input id="fgpsn_ListingEmail" name="fgpsn_ListingEmail" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_ListingEmail', true) . '" type="text"></P>
	
	<P><label for="fgpsn_AlwaysEmailAgent">Email Agent?</label>
	<input id="fgpsn_Long" name="fgpsn_Long" size=5 value="' . get_post_meta(get_the_ID(), 'fgpsn_Long', true) . '" type="text"></P>
	
     </DIV></FIELDSET>';

}		

add_action( 'save_post', 'fgpsn_zillow_listing_save' );
function fgpsn_zillow_listing_save( $post_id ) {

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

}




/*		<RentalDetails/>
			<Availability>3/1/2010</Availability>
			<LeaseTerm>OneYear</LeaseTerm>
			<DepositFees>$30 Application Fee, First and Last Rent, $500 pet
			deposit<DepositFees>
			<UtilitiesIncluded>
				<Water>Yes</Water>
				<Sewage>Yes</Sewage>
				<Garbage>Yes</Garbage>
				<Electricity>No</Electricity>
				<Gas>No</Gas>
				<Internet>Yes</Internet>
				<Cable>No</Cable>
				<SatTV>No</SatTV>
			</UtilitiesIncluded>
			<PetsAllowed>
				<NoPets></NoPets>
				<Cats>Yes </Cats>
				<SmallDogs>Yes</SmallDogs>
				<LargeDogs>No</LargeDogs>
			</PetsAllowed>
		</RentalDetails/>
*/




//adding rental details for zillow bound property
add_action( 'add_meta_boxes', 'fgpsn_zillow_RentalDetails' );
function fgpsn_zillow_RentalDetails() {

	$screens = array( 'fgpsn_zillowlisting' );
    foreach ($screens as $screen) {
		add_meta_box(
			'fgpsn_zillow_rentalDetails',
			__( 'Rental Details', 'zillow-posting-manager' ),
			'fgpsn_zillow_rental_details',
			$screen,
			'normal',
			'high'
		);
	}
}


function fgpsn_zillow_rental_details( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'fgpsn_zillow_rental_details_nonce' );

	echo '<FIELDSET><DIV>
	
	<P><label for="fgpsn_Availability" STYLE="width: 110px;">Availability Date</label>
	<input id="fgpsn_Availability" name="fgpsn_Availability" size=50 value="' . get_post_meta(get_the_ID(), 'fgpsn_Availability', true) . '" type="text"></P>
	
	<P><label for="fgpsn_LeaseTerm">Lease Term</label>
	<input id="fgpsn_LeaseTerm" name="fgpsn_LeaseTerm" size=70 value="' . get_post_meta(get_the_ID(), 'fgpsn_LeaseTerm', true) . '" type="text"></P>
	
	<P><label for="fgpsn_DepositFees">Fees and Deposits</label>
	<input id="fgpsn_DepositFees" name="fgpsn_DepositFees" size=80 value="' . get_post_meta(get_the_ID(), 'fgpsn_DepositFees', true) . '" type="text"></P>
	
	<DIV>Utilities Included:
	
		<P><label for="fgpsn_Water">Water</label>
		<input id="fgpsn_Water" name="fgpsn_Water" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Water', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Sewage">Sewage</label>
		<input id="fgpsn_Sewage" name="fgpsn_Sewage" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Sewage', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Garbage">Garbage</label>
		<input id="fgpsn_Garbage" name="fgpsn_Garbage" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Garbage', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Electricity">Electricity</label>
		<input id="fgpsn_Electricity" name="fgpsn_Electricity" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Electricity', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Gas">Gas</label>
		<input id="fgpsn_Gas" name="fgpsn_Gas" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Gas', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Internet">Internet</label>
		<input id="fgpsn_Internet" name="fgpsn_Internet" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Internet', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Cable">Cable</label>
		<input id="fgpsn_Cable" name="fgpsn_Cable" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Cable', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_SatTV">Satality TV</label>
		<input id="fgpsn_SatTV" name="fgpsn_SatTV" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_SatTV', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
	
	</DIV>
	
	<DIV>Pets Allowed:
	
		<P><label for="fgpsn_NoPets">No Pets</label>
		<input id="fgpsn_NoPets" name="fgpsn_NoPets" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_NoPets', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_Cats">Cats</label>
		<input id="fgpsn_Cats" name="fgpsn_Cats" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_Cats', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_SmallDogs">Small Dogs</label>
		<input id="fgpsn_SmallDogs" name="fgpsn_SmallDogs" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_SmallDogs', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
		
		<P><label for="fgpsn_LargeDogs">Large Dogs</label>
		<input id="fgpsn_LargeDogs" name="fgpsn_LargeDogs" value="true" type="checkbox"';
		if ( get_post_meta(get_the_ID(), 'fgpsn_LargeDogs', true) == 'true') {
			echo ' checked';
		}
		echo '></P>
	
	</DIV></FIELDSET>';

}		

add_action( 'save_post', 'fgpsn_zillow_rental_details_save' );
function fgpsn_zillow_rental_details_save( $post_id ) {

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

}









//adding ALL THE DATA
//add_action( 'add_meta_boxes', 'fgpsn_zillow_FullDetails' );
function fgpsn_zillow_FullDetails() {

	$screens = array( 'fgpsn_zillowlisting' );
    foreach ($screens as $screen) {
		add_meta_box(
			'fgpsn_zillow_ful_details',
			__( 'All Rental Details', 'zillow-posting-manager' ),
			'fgpsn_zillow_all_rental_details',
			$screen,
			'normal',
			'high'
		);
	}
}





function fgpsn_zillow_all_rental_details( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'fgpsn_zillow_rental_details_nonce' );
	the_Meta();
	
	/* put the required and most common data in other meta boxes and use this as a catchall
	 *  
	 * 
	 * 
	 * The only fields required are: 
	 * property type - added in,
	 *  address (including unit number when applicable) - added in,
	 * contact e-mail and
	phone number, price, status, number of bedrooms (when applicable), and number of bathrooms (when
	applicable); all of these fields are shown in bold in the XML below. While these are the minimum requirements
	for each individual listing, feeds must have the ability to exceed those minimum requirements when the
	information is available by including photos, descriptions, and other details. Please note that Coming Soon
	listings have other requirements. Only feeds that include high quality listings will be accepted.
	* 
	* 
	*
	*/

$feedstring = '<Listings>
	<Listing>
		<Location>
			<StreetAddress>125 Main St</StreetAddress>
			<UnitNumber>14</UnitNumber>
			<City>Seattle</City>
			<State>WA</State>
			<Zip>98117</Zip>
			<Lat> 30.406706</Lat>
			<Long> -86.905379</Long>
			<DisplayAddress>Yes</DisplayAddress>
		</Location>
		<ListingDetails>
			<Status>For Rent</Status>
			<Price>1200</Price>
			<ListingUrl>http://ForRentSite.com/listing1111</ListingUrl>
			<MlsId>456790</MlsId>
			<MlsName>NWMLS</MlsName>
			<VirtualTourUrl> http://Site.com/VirTour123.wmv</VirtualTourUrl >
			<ListingEmail> realtor18203892@trackingsystem.com</ListingEmail >
			<AlwaysEmailAgent>1</AlwaysEmailAgent>
		</ListingDetails>
		<RentalDetails/>
			<Availability>3/1/2010</Availability>
			<LeaseTerm>OneYear</LeaseTerm>
			<DepositFees>$30 Application Fee, First and Last Rent, $500 pet
			deposit<DepositFees>
			<UtilitiesIncluded>
			<Water>Yes</Water>
			<Sewage>Yes</Sewage>
			<Garbage>Yes</Garbage>
			<Electricity>No</Electricity>
			<Gas>No</Gas>
			<Internet>Yes</Internet>
			<Cable>No</Cable>
			<SatTV>No</SatTV>
			</UtilitiesIncluded>
			<PetsAllowed>
			<NoPets></NoPets>
			<Cats>Yes </Cats>
			<SmallDogs>Yes</SmallDogs>
			<LargeDogs>No</LargeDogs>
			</PetsAllowed>
		</RentalDetails/>
		<BasicDetails>
			<PropertyType>SingleFamily</PropertyType>
			<Title>Wonderful Ballard Charmer</Title>
			<Description>Great home on corner lot, with lots of charm &amp;
			curb appeal.</Description>
			<Bedrooms>Studio</Bedrooms>
			<Bathrooms>1</Bathrooms>
			<LivingArea>1234</LivingArea>
			<LotSize>1.5</LotSize>
			<YearBuilt>1955</YearBuilt>
		</BasicDetails>
		<Pictures>
			<Picture>
				<PictureUrl>http://BrokerSite.com/photo123.jpg</PictureUrl>
				<Caption>Exterior View</Caption>
			</Picture>
			<Picture>
				<PictureUrl>http://BrokerSite.com/photo456.jpg</PictureUrl>
				<Caption>Master Suite</Caption>
			</Picture>
		</Pictures>
		<Agent>
			<FirstName>Alan</FirstName>
			<LastName>Smith</LastName>
			<EmailAddress>alan.smith@brokersite.com</EmailAddress>
			<PictureUrl>http://BrokerSite.com/alanpic.jpg</PictureUrl>
			<OfficeLineNumber>206-555-1212</OfficeLineNumber>
			<MobilePhoneLineNumber>206-888-1234</MobilePhoneLineNumber>
			<FaxLineNumber>206-555-1233</FaxLineNumber>
		</Agent>
		<Office>
			<BrokerageName>#1 Broker</BrokerageName>
			<BrokerPhone>201-422-4223</BrokerPhone>
			<StreetAddress>999 Washington St</StreetAddress>
			<UnitNumber>4600</UnitNumber>
			<City>Seattle</City>
			<State>WA</State>
			<Zip>98101</Zip>
		</Office>
		<OpenHouses>
		</OpenHouses>
		<Neighborhood>
			<Name>Ballard</Name>
			<Description>Very friendly and walkable.</Description>
		</Neighborhood>
		<RichDetails>
			<AdditionalFeatures>Gazebo, Vegetable Garden</AdditionalFeatures>
			<Appliances>
				<Appliance>Dishwasher</Appliance>
				<Appliance>Refrigerator</Appliance>
			</Appliances>
			<ArchitectureStyle>Craftsman</ArchitectureStyle>
			<Attic>Yes</Attic>
			<Basement>Yes</Basement>
			<CableReady>Yes</CableReady>
			<CoolingSystems>
				<CoolingSystem>Wall</CoolingSystem>
			</CoolingSystems>
			<Deck>Yes</Deck>
			<DoublePaneWindows>Yes</DoublePaneWindows>
			<ExteriorTypes>
				<ExteriorType>Wood</ExteriorType>
				<ExteriorType>Brick</ExteriorType>
			</ExteriorTypes>
			<Fireplace>Yes</Fireplace>
			<FloorCoverings>
				<FloorCovering>Hardwood</FloorCovering>
				<FloorCovering>Carpet</FloorCovering>
				<FloorCovering>Laminate</FloorCovering>
			</FloorCoverings>
			<Garden>Yes</Garden>
			<HeatingFuels>
				<HeatingFuel>Oil</HeatingFuel>
			</HeatingFuels>
			<HeatingSystems>
				<HeatingSystem>ForcedAir</HeatingSystem>
			</HeatingSystems>
			<JettedBathTub>Yes</JettedBathTub>
			<Lawn>Yes</Lawn>
			<MotherInLaw>Yes</MotherInLaw>
			<NumFloors>2</NumFloors>
			<NumParkingSpaces>2</NumParkingSpaces>
			<ParkingTypes>
				<ParkingType>GarageAttached</ParkingType>
				<ParkingType>OffStreet</ParkingType>
			</ParkingTypes>
			<Patio>Yes</Patio>
			<Porch>Yes</Porch>
			<RoofTypes>
				<RoofType>ShakeShingle</RoofType>
			</RoofTypes>
			<RoomCount>11</RoomCount>
			<Rooms>
				<Room>DiningRoom</Room>
				<Room>FamilyRoom</Room>
				<Room>MasterBath</Room>
				<Room>Office</Room>
				<Room>Pantry</Room>
			</Rooms>
			<SecuritySystem>Yes</SecuritySystem>
			<Skylight>Yes</Skylight>
			<SprinklerSystem>Yes</SprinklerSystem>
			<ViewTypes>
				<ViewType>Mountain</ViewType>
				<ViewType>Water</ViewType>
			</ViewTypes>
			<Waterfront>Yes</Waterfront>
			<WhatOwnerLoves>View of sunset in the evening</WhatOwnerLoves>
			<YearUpdated>1984</YearUpdated>
			<FitnessCenter>Yes<FitnessCenter>
			<BasketballCourt>No</BasketballCourt>
			<TennisCourt>Yes</TennisCourt/>
			<NearTransportation>Yes</NearTransportation>
			<ControlledAccess>Yes</ControlledAccess>
			<Over55ActiveCommunity>No</Over55ActiveCommunity>
			<AssistedLivingCommunity>No</AssistedLivingCommunity>
			<Storage>Yes</Storage>
			<FencedYard>Yes</FencedYard>
			<PropertyName>View Ridge Apartments</PropertyName>
			<Furnished>No</Furnished>
			<HighspeedInternet>No</HighspeedInternet>
			<OnsiteLaundry>Yes</OnsiteLaundry>
			<CableSatTV>No</CableSatTV>
		</RichDetails>
	</Listing>
</Listings>';


	preg_match_all("|<[^>]+>|U",
		$feedstring,
		$out, PREG_PATTERN_ORDER);
	
	//create checkbox aray
	$writecheckboxes = Array();
	$writecheckboxes[] = 'Water';
	$writecheckboxes[] = 'Sewage';
	$writecheckboxes[] = 'Garbage';
	$writecheckboxes[] = 'Electricity';
	$writecheckboxes[] = 'Gas';
	$writecheckboxes[] = 'Internet';
	$writecheckboxes[] = 'Cable';
	$writecheckboxes[] = 'SatTV';
	$writecheckboxes[] = 'Appliance';
	//$writecheckboxes[] = 'Room';
	$writecheckboxes[] = 'ViewType';
	$writecheckboxes[] = 'RoofType';
	
	
	
	echo '<FIELDSET><DIV>';
	
	for( $i = 0; $i <= count( $out[0]); $i++ ) {
		
		$tag_name = str_replace('<', '', str_replace('>', '', $out[0][$i]));
		if(strpos($tag_name, '/') === false) { 
			
			/*<UtilitiesIncluded>
			<Water>Yes</Water>
			<Sewage>Yes</Sewage>
			<Garbage>Yes</Garbage>
			<Electricity>No</Electricity>
			<Gas>No</Gas>
			<Internet>Yes</Internet>
			<Cable>No</Cable>
			<SatTV>No</SatTV>
			</UtilitiesIncluded>
			* */
			
			switch ($tag_name) {
				case 'Water':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '"
						Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';
					
				case 'Sewage':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';

				case 'Garbage':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '"
						Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';

				case 'Electricity':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '"
						Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';

				case 'Gas':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '"
						Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';
					
				case 'Internet':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';
					
				case 'Cable':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';							
				
				case 'SatTV':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="checkbox" id"fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '">'
					. $tag_name
					. '<BR>';
					
				case 'Room':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label>
						<input type="text" id="fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '[]">'
					. '<BR>';

				case 'PictureUrl':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name . '<P>' . the_content(get_the_ID()) . '</P>'
					. '</label>
						<input type="text" id="fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '[]" value="' . get_post_meta(get_the_ID(), 'fgpsn_' . $tag_name, true)
					. '" type="text">'
					. '<BR>';
					
				case 'Fee':
					echo '<label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name . '<P>' . the_content(get_the_ID()) . '</P>'
					. '</label>
						<input type="text" id="fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '[\'FeeType\']" value="' . get_post_meta(get_the_ID(), 'fgpsn_' . $tag_name, true)
					. '" type="text">'
					. '<BR>
					<input type="text" id="fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '[\'FeeAmount\']" value="' . get_post_meta(get_the_ID(), 'fgpsn_' . $tag_name, true)
					. '" type="text">'
					. '<BR>
					<input type="text" id="fgpsn_' . $tag_name . '" Name="fgpsn_' . $tag_name . '[\'FeePeriod\']" value="' . get_post_meta(get_the_ID(), 'fgpsn_' . $tag_name . "['FeePeriod']", true)
					. '" type="text">'
					. '<BR>';
				
				case 'FeeType':
				break;
					
				default:
					echo '<P><label for="fgpsn_'
					. $tag_name
					. '">'
					. $tag_name
					. '</label><input id="fgpsn_'
					. $tag_name
					. '" name="fgpsn_'
					. $tag_name
					. '" value="' . get_post_meta(get_the_ID(), 'fgpsn_' . $tag_name, true)
					. '" type="text"></P>';
									
			}			
		}
	}
	echo '</DIV></FIELDSET>';
	


}		

//add_action( 'save_post', 'fgpsn_zillow_all_rental_details_save' );
function fgpsn_zillow_all_rental_details_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	
	
	/*to save all call a nonce you know is there - the all meta box may be hidden */
	if ( !wp_verify_nonce( $_POST['fgpsn_required_zillow_data_nonce'], plugin_basename( __FILE__ ) ) )
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}


	update_post_meta( $post_id, 'fgpsn_ListingEmail', $_POST['fgpsn_ListingEmail'] );
	
	$feedstring = '<Listings>
	<Listing>
		<Location>
			<StreetAddress>125 Main St</StreetAddress>
			<UnitNumber>14</UnitNumber>
			<City>Seattle</City>
			<State>WA</State>
			<Zip>98117</Zip>
			<Lat> 30.406706</Lat>
			<Long> -86.905379</Long>
			<DisplayAddress>Yes</DisplayAddress>
		</Location>
		<ListingDetails>
			<Status>For Rent</Status>
			<Price>1200</Price>
			<ListingUrl>http://ForRentSite.com/listing1111</ListingUrl>
			<MlsId>456790</MlsId>
			<MlsName>NWMLS</MlsName>
			<VirtualTourUrl> http://Site.com/VirTour123.wmv</VirtualTourUrl >
			<ListingEmail> realtor18203892@trackingsystem.com</ListingEmail >
			<AlwaysEmailAgent>1</AlwaysEmailAgent>
		</ListingDetails>
		<RentalDetails/>
			<Availability>3/1/2010</Availability>
			<LeaseTerm>OneYear</LeaseTerm>
			<DepositFees>$30 Application Fee, First and Last Rent, $500 pet
			deposit<DepositFees>
			<UtilitiesIncluded>
				<Water>Yes</Water>
				<Sewage>Yes</Sewage>
				<Garbage>Yes</Garbage>
				<Electricity>No</Electricity>
				<Gas>No</Gas>
				<Internet>Yes</Internet>
				<Cable>No</Cable>
				<SatTV>No</SatTV>
			</UtilitiesIncluded>
			<PetsAllowed>
			<NoPets></NoPets>
			<Cats>Yes </Cats>
			<SmallDogs>Yes</SmallDogs>
			<LargeDogs>No</LargeDogs>
			</PetsAllowed>
		</RentalDetails/>
		<BasicDetails>
			<PropertyType>SingleFamily</PropertyType>
			<Title>Wonderful Ballard Charmer</Title>
			<Description>Great home on corner lot, with lots of charm &amp;
			curb appeal.</Description>
			<Bedrooms>Studio</Bedrooms>
			<Bathrooms>1</Bathrooms>
			<LivingArea>1234</LivingArea>
			<LotSize>1.5</LotSize>
			<YearBuilt>1955</YearBuilt>
		</BasicDetails>
		<Pictures>
			<Picture>
				<PictureUrl>http://BrokerSite.com/photo123.jpg</PictureUrl>
				<Caption>Exterior View</Caption>
			</Picture>
			<Picture>
				<PictureUrl>http://BrokerSite.com/photo456.jpg</PictureUrl>
				<Caption>Master Suite</Caption>
			</Picture>
		</Pictures>
		<Agent>
			<FirstName>Alan</FirstName>
			<LastName>Smith</LastName>
			<EmailAddress>alan.smith@brokersite.com</EmailAddress>
			<PictureUrl>http://BrokerSite.com/alanpic.jpg</PictureUrl>
			<OfficeLineNumber>206-555-1212</OfficeLineNumber>
			<MobilePhoneLineNumber>206-888-1234</MobilePhoneLineNumber>
			<FaxLineNumber>206-555-1233</FaxLineNumber>
		</Agent>
		<Office>
			<BrokerageName>#1 Broker</BrokerageName>
			<BrokerPhone>201-422-4223</BrokerPhone>
			<StreetAddress>999 Washington St</StreetAddress>
			<UnitNumber>4600</UnitNumber>
			<City>Seattle</City>
			<State>WA</State>
			<Zip>98101</Zip>
		</Office>
		<OpenHouses>
		</OpenHouses>
		<Neighborhood>
			<Name>Ballard</Name>
			<Description>Very friendly and walkable.</Description>
		</Neighborhood>
		<RichDetails>
			<AdditionalFeatures>Gazebo, Vegetable Garden</AdditionalFeatures>
			<Appliances>
				<Appliance>Dishwasher</Appliance>
				<Appliance>Refrigerator</Appliance>
			</Appliances>
			<ArchitectureStyle>Craftsman</ArchitectureStyle>
			<Attic>Yes</Attic>
			<Basement>Yes</Basement>
			<CableReady>Yes</CableReady>
			<CoolingSystems>
				<CoolingSystem>Wall</CoolingSystem>
			</CoolingSystems>
			<Deck>Yes</Deck>
			<DoublePaneWindows>Yes</DoublePaneWindows>
			<ExteriorTypes>
				<ExteriorType>Wood</ExteriorType>
				<ExteriorType>Brick</ExteriorType>
			</ExteriorTypes>
			<Fireplace>Yes</Fireplace>
			<FloorCoverings>
				<FloorCovering>Hardwood</FloorCovering>
				<FloorCovering>Carpet</FloorCovering>
				<FloorCovering>Laminate</FloorCovering>
			</FloorCoverings>
			<Garden>Yes</Garden>
			<HeatingFuels>
				<HeatingFuel>Oil</HeatingFuel>
			</HeatingFuels>
			<HeatingSystems>
				<HeatingSystem>ForcedAir</HeatingSystem>
			</HeatingSystems>
			<JettedBathTub>Yes</JettedBathTub>
			<Lawn>Yes</Lawn>
			<MotherInLaw>Yes</MotherInLaw>
			<NumFloors>2</NumFloors>
			<NumParkingSpaces>2</NumParkingSpaces>
			<ParkingTypes>
				<ParkingType>GarageAttached</ParkingType>
				<ParkingType>OffStreet</ParkingType>
			</ParkingTypes>
			<Patio>Yes</Patio>
			<Porch>Yes</Porch>
			<RoofTypes>
				<RoofType>ShakeShingle</RoofType>
			</RoofTypes>
			<RoomCount>11</RoomCount>
			<Rooms>
				<Room>DiningRoom</Room>
				<Room>FamilyRoom</Room>
				<Room>MasterBath</Room>
				<Room>Office</Room>
				<Room>Pantry</Room>
			</Rooms>
			<SecuritySystem>Yes</SecuritySystem>
			<Skylight>Yes</Skylight>
			<SprinklerSystem>Yes</SprinklerSystem>
			<ViewTypes>
				<ViewType>Mountain</ViewType>
				<ViewType>Water</ViewType>
			</ViewTypes>
			<Waterfront>Yes</Waterfront>
			<WhatOwnerLoves>View of sunset in the evening</WhatOwnerLoves>
			<YearUpdated>1984</YearUpdated>
			<FitnessCenter>Yes<FitnessCenter>
			<BasketballCourt>No</BasketballCourt>
			<TennisCourt>Yes</TennisCourt/>
			<NearTransportation>Yes</NearTransportation>
			<ControlledAccess>Yes</ControlledAccess>
			<Over55ActiveCommunity>No</Over55ActiveCommunity>
			<AssistedLivingCommunity>No</AssistedLivingCommunity>
			<Storage>Yes</Storage>
			<FencedYard>Yes</FencedYard>
			<PropertyName>View Ridge Apartments</PropertyName>
			<Furnished>No</Furnished>
			<HighspeedInternet>No</HighspeedInternet>
			<OnsiteLaundry>Yes</OnsiteLaundry>
			<CableSatTV>No</CableSatTV>
		</RichDetails>
	</Listing>
</Listings>';


	preg_match_all("|<[^>]+>|U",
		$feedstring,
		$out, PREG_PATTERN_ORDER);

	update_post_meta( $post_id, 'fgpsn_ListingEmail', $_POST['fgpsn_ListingEmail'] );
	
	update_post_meta( $post_id, 'fgpsn_Room', $_POST['fgpsn_Room'] );
	for( $i = 0; $i <= count( $out[0]); $i++ ) {
		
		$tag_name = 'fgpsn_' . str_replace('<', '', str_replace('>', '', $out[0][$i]));
		if(strpos($tag_name, '/') === false) { 
			
			
			
			if ($tag_name == 'Room') {//repeating field saved as an array
				
				$old = get_post_meta($post_id, 'fgpsn_Room', true);
				$new = array();
				$options = fgpsn_get_sample_options();
				
				$fgpsn_Room = $_POST['fgpsn_Room'];
				
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
				
			} else {
			
				
				
				update_post_meta( $post_id, $tag_name, $_POST[$tag_name] );
				//echo '<H2>Update: ' . $post_id . ', ' . $tag_name . ', POST: ' . $_POST[$tag_name] . '</H2>';
				
				
				
			}
		}
		
	}
	



/*

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
*/
	
	if ( ! wp_is_post_revision( $post_id ) ){

		// unhook this function so it doesn't loop infinitely
		remove_action('save_post', 'fgpsn_zillow_all_rental_details_save');

		// update the post, which calls save_post again
		wp_update_post( $my_post );

		// re-hook this function
		add_action('save_post', 'fgpsn_zillow_all_rental_details_save');
	}

}




function fgpsn_get_sample_options() {
	$options = array (
		'Option 1' => 'option1',
		'Option 2' => 'option2',
		'Option 3' => 'option3',
		'Option 4' => 'option4',
	);
	
	return $options;
}

class fgpsnPropertyZillow
{
    function createfgpsnPropertyZillow()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class B
{
    function bar()
    {
        // Note: the next line will issue a warning if E_STRICT is enabled.
        fgpsnPropertyZillow::createfgpsnPropertyZillow();
    }
}

//$a = new fgpsnPropertyZillow();
//$a->createfgpsnPropertyZillow();

// Note: the next line will issue a warning if E_STRICT is enabled.
//fgpsnPropertyZillow::createfgpsnPropertyZillow();
//$b = new B();
//$b->bar();

// Note: the next line will issue a warning if E_STRICT is enabled.
//B::bar();


/* Move to admin/class-zillow-posting-manager-admin.php
add_filter('manage_edit-properties_columns', 'add_edit_properties_columns');

function add_edit_properties_columns($properties_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = _x('Property No.', 'column name');
    $new_columns['address_1'] = __('Address');
    $new_columns['city'] = __('City');
    $new_columns['state'] = __('State.');
    $new_columns['zip'] = _x('Zipcode', 'column name');

    return $new_columns;
}


add_action('manage_properties_posts_custom_column', 'manage_properties_columns', 10, 2);

function manage_properties_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
    case 'id':
        echo $id;
            break;

    case 'properties_types':
        // Get number of images in gallery
        $terms = wp_get_post_terms( $id, 'properties_types' );
        foreach($terms as $term) {
        echo $term->name;
        }

        break;

    case 'address_1':
	        $address_1 = get_post_meta($id, 'address_1', true);
	        if ( $address_1 === false ) {$address_1 = 'false: ' . $id;}
	        echo $address_1;

        break;

    case 'monthly_payment_date':
	        // Get number of images in gallery
	        $monthly_payment_date = get_post_meta( $id, 'unit_rent_data', true );
	        echo $monthly_payment_date['unit_rent_date'];

        break;

    default:
        break;
    } // end switch
}
*/

<?php
/*
Plugin Name: Find State Reps By Address
Plugin URI: http://www.2265solutions.com
Description: Address entered in widget fetches links to state reps. Includes custom post type, archive page, single, etc.
Version: 1
Author: Dennis Gannon
Author URI: http://www.2265solutions.com
*/

/*  Copyright 2016  Dennis Gannon  (email : dgannon@2265solutions.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
include("functions-bhrc.php");

/*enque scripts for beacon hill roll call*/

if (!function_exists('bhrc_scripts')) {
  function bhrc_scripts() {
    if (!is_admin()) {
      wp_enqueue_script('bhrc-scripts', plugins_url( '/js/repSearch.js', __FILE__ ), array('jquery'));
      wp_enqueue_style('bhrc-styles', plugins_url( '/css/repStyles.css', __FILE__ ), array('jquery'));
      
    }
  }
}
add_action('wp_enqueue_scripts', 'bhrc_scripts');





/* Create the post and Taxonomies */

if (!function_exists('custom_post_ma_reps')) {
function custom_post_ma_reps() {

    $labels = array(
      'name'               => _x( 'Representatives', 'post type general name' ),
      'singular_name'      => _x( 'Representative', 'post type singular name' ),
      'add_new'            => _x( 'Add Representative', 'representatives' ),
      'add_new_item'       => __( 'Add New Representative' ),
      'edit_item'          => __( 'Edit Representative' ),
      'new_item'           => __( 'New Representative' ),
      'all_items'          => __( 'All Representatives' ),
      'view_item'          => __( 'View Representative' ),
      'search_items'       => __( 'Search Representatives' ),
      'not_found'          => __( 'No Representatives Found' ),
      'not_found_in_trash' => __( 'No Representatives found in the Trash' ),
      'parent_item_colon'  => '',
      'menu_name'          => 'Representatives'
    );

    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our Representative Profiles',
      'public'        => true,
      'menu_position' => 6,
      'supports'      => array( 'title', 'editor', 'author', 'revisions', 'thumbnail', 'comments'),
      /*'capabilities' => array(
        'edit_post'          => 'edit_representatives', 
        'read_post'          => 'read_representatives', 
        'delete_post'        => 'delete_representatives', 
        'edit_posts'         => 'edit_representatives', 
        'edit_others_posts'  => 'edit_others_representatives', 
        'publish_posts'      => 'publish_representatives',       
        'read_private_posts' => 'read_private_representatives', 
        'create_posts'       => 'edit_representatives', 
      ),*/
      'taxonomies'      => array( 'committees' ),
      'hierarchical' => true,
      'has_archive'   => true
    );

  register_post_type( 'representatives', $args );
}
add_action( 'init', 'custom_post_ma_reps' );



/* add metaboxes for party, chamber */
add_action( 'add_meta_boxes', 'bhrc_party_affiliation' );
function bhrc_party_affiliation() {
     $screens = array( 'representatives' );
    foreach ($screens as $screen) {
      add_meta_box(
      'bhrc_party_affiliation',
      __( 'Legislator Statistics', 'myplugin_textdomain' ),
      'bhrc_party_affiliation_content',
      $screen,
      'side'
    );
  }
}


function bhrc_party_affiliation_content( $post ) {
  
  wp_nonce_field( plugin_basename( __FILE__ ), 'bhrc_party_affiliation_content_nonce' );
  
  $bhrc_votes_with_leadership = get_post_meta($post->ID, 'bhrc_votes_with_leadership', true);
  $bhrc_missed_votes = get_post_meta($post->ID, 'bhrc_missed_votes', true);
  $bhrc_support_veto = get_post_meta($post->ID, 'bhrc_support_veto', true);
  $bhrc_rep_salary = get_post_meta($post->ID, 'bhrc_rep_salary', true);
  $bhrc_rep_per_diem = get_post_meta($post->ID, 'bhrc_rep_per_diem', true);
  $bhrc_legislator_chamber = get_post_meta($post->ID, 'bhrc_legislator_chamber', true);
  $district = get_post_meta($post->ID, 'district', true);

  $bhrc_rep_office_ph = get_post_meta($post->ID, 'bhrc_rep_office_ph', true);
  $bhrc_legislator_office_email = get_post_meta($post->ID, 'bhrc_legislator_office_email', true);
  $bhrc_legislator_aide_email = get_post_meta($post->ID, 'bhrc_legislator_aide_email', true);
  $bhrc_rep_twitter = get_post_meta($post->ID, 'bhrc_rep_twitter', true);
  $bhrc_rep_facebook = get_post_meta($post->ID, 'bhrc_rep_facebook', true);
  $bhrc_rep_website = get_post_meta($post->ID, 'bhrc_rep_website', true);

  $bhrc_clt_ranking = get_post_meta($post->ID, 'bhrc_clt_ranking', true);
  $bhrc_fema_ranking = get_post_meta($post->ID, 'bhrc_fema_ranking', true);
  $bhrc_masspa_ranking = get_post_meta($post->ID, 'bhrc_masspa_ranking', true);
  $bhrc_nra_ranking = get_post_meta($post->ID, 'bhrc_nra_ranking', true);

  $bhrc_elm_ranking = get_post_meta($post->ID, 'bhrc_aim_ranking', true);
  $bhrc_elm_ranking = get_post_meta($post->ID, 'bhrc_elm_ranking', true);
  $bhrc_mfa_ranking = get_post_meta($post->ID, 'bhrc_mfa_ranking', true);
  $bhrc_masspirg_ranking = get_post_meta($post->ID, 'bhrc_masspirg_ranking', true);
  $bhrc_nfib_ranking = get_post_meta($post->ID, 'bhrc_nfib_ranking', true);

  $bhrc_goal_ranking = get_post_meta($post->ID, 'bhrc_goal_ranking', true);
  $bhrc_pp_ranking = get_post_meta($post->ID, 'bhrc_pp_ranking', true);
  $bhrc_mta_ranking = get_post_meta($post->ID, 'bhrc_mta_ranking', true);
  $bhrc_nra_ranking = get_post_meta($post->ID, 'bhrc_nra_ranking', true);

  $bhrc_clt_ranking = get_post_meta($post->ID, 'bhrc_clt_ranking_16', true);
  $bhrc_fema_ranking = get_post_meta($post->ID, 'bhrc_fema_ranking_16', true);
  $bhrc_masspa_ranking = get_post_meta($post->ID, 'bhrc_masspa_ranking_16', true);
  $bhrc_nra_ranking = get_post_meta($post->ID, 'bhrc_nra_ranking_16', true);

  $bhrc_elm_ranking = get_post_meta($post->ID, 'bhrc_aim_ranking_16', true);
  $bhrc_elm_ranking = get_post_meta($post->ID, 'bhrc_elm_ranking_16', true);
  $bhrc_mfa_ranking = get_post_meta($post->ID, 'bhrc_mfa_ranking_16', true);
  $bhrc_masspirg_ranking = get_post_meta($post->ID, 'bhrc_masspirg_ranking_16', true);
  $bhrc_nfib_ranking = get_post_meta($post->ID, 'bhrc_nfib_ranking_16', true);

  $bhrc_goal_ranking = get_post_meta($post->ID, 'bhrc_goal_ranking_16', true);
  $bhrc_pp_ranking = get_post_meta($post->ID, 'bhrc_pp_ranking_16', true);
  $bhrc_mta_ranking = get_post_meta($post->ID, 'bhrc_mta_ranking_16', true);
  $bhrc_nra_ranking = get_post_meta($post->ID, 'bhrc_nra_ranking_16', true);





  $bhrc_party_affiliation = get_post_meta($post->ID, 'bhrc_party_affiliation', true);
  
  echo '<label for="bhrc_vote_statistics"><h4>General Data</h4></label>
  <div Style="width: 100%">
    <div Style="width: 100%; line-height: 1.2em;">Chamber <input type="text" size=12 name="bhrc_legislator_chamber" value="' . $bhrc_legislator_chamber . '" Style="float: right"></div><BR>
    <div Style="width: 100% line-height: 1.2em;">District <input type="text" size=12 name="district" value="' . $district . '"  Style="float: right"></div><BR>
    
    <div Style="width: 100%">Party Affiliation:
  <SELECT NAME="bhrc_party_affiliation" id="bhrc_party_affiliation"/  Style="float: right">

    <OPTION value=""> - Select Party - </OPTION>\n
    <OPTION value="D" ';
    if ($bhrc_party_affiliation == "D") {
      echo 'selected';
    }


  echo '> Democratic</OPTION>\n
    <OPTION value="R" ';
    if ($bhrc_party_affiliation == "R") {
      echo 'selected';
    }


  echo '> Republician </OPTION>\n
    <OPTION value="Green" ';
    if ($bhrc_party_affiliation == "Green") {
      echo 'selected';
    }


  echo '> Green </OPTION>\n
    <OPTION value="I" ';
    if ($bhrc_party_affiliation == "I") {
      echo 'selected';
    }


  echo '> Independent </OPTION>\n

  </SELECT>
  </div>
<br>
  </div>
<hr></hr>

<label for="bhrc_vote_statistics"><h4>Contact Information</h4></label>
  <div>
    <div Style="width: 100%; line-height: 1.2em;">Office Phone <input type="text" size=3 name="bhrc_rep_office_ph" value="' . $bhrc_rep_office_ph . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Email <input type="text" size=3 name="bhrc_legislator_office_email" value="' . $bhrc_legislator_office_email . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Aide Email <input type="text" size=3 name="bhrc_legislator_aide_email" value="' . $bhrc_legislator_aide_email . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Website <input type="text" size=3 name="bhrc_rep_website" value="' . $bhrc_rep_website . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Twitter Feed <input type="text" size=3 name="bhrc_rep_twitter" value="' . $bhrc_rep_twitter . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Facebook <input type="text" size=3 name="bhrc_rep_facebook" value="' . $bhrc_rep_facebook . '" Style="width: 6em; float: right"></div><br>

</div>
  <br><hr></hr>


  <label for="bhrc_vote_statistics"><h4>Voting Profile</h4></label>
  <div>
    <div Style="width: 100%; line-height: 1.2em;">Votes With Leadership <input type="number" size=3 name="bhrc_votes_with_leadership" value="' . $bhrc_votes_with_leadership . '" Style="width: 6em; float: right">%</div><br>
    <div Style="width: 100%; line-height: 1.2em;">Missed Votes <input type="number" size=3 name="bhrc_missed_votes" value="' . $bhrc_missed_votes . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Supported Gov. Vetos<input type="number" size=3 name="bhrc_support_veto" value="' . $bhrc_support_veto . '" Style="width: 6em; float: right"></div><br>

  </div>
  <br><hr></hr>

  <label for="bhrc_vote_statistics"><h4>Public Interest Ratings</h4></label>
  <div>
  <div Style="width: 100%; line-height: 1.2em;">ORG.
    <span Style="width: 6em; float: right">2015</span>
    <span Style="width: 6em; float: right">2016</div><br>
    <div Style="width: 100%; line-height: 1.2em;">CLT
    <input type="text" size=3 name="bhrc_clt_ranking" value="' . $bhrc_clt_ranking . '" Style="width: 6em; float: right">%
    <input type="text" size=3 name="bhrc_clt_ranking_16" value="' . $bhrc_clt_ranking_16 . '" Style="width: 6em; float: right">%</div><br>
    <div Style="width: 100%; line-height: 1.2em;">FEMA
    <input type="text" size=3 name="bhrc_fema_ranking" value="' . $bhrc_fema_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_fema_ranking_16" value="' . $bhrc_fema_ranking_16 . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">MAS
    <input type="text" size=3 name="bhrc_masspa_ranking" value="' . $bhrc_masspa_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_masspa_ranking_16" value="' . $bhrc_masspa_ranking_16 . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">NRA
    <input type="text" size=3 name="bhrc_nra_ranking" value="' . $bhrc_nra_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_nra_ranking_16" value="' . $bhrc_nra_ranking_16 . '" Style="width: 6em; float: right"></div><br>

    <div Style="width: 100%; line-height: 1.2em;">AIM
    <input type="text" size=3 name="bhrc_elm_ranking" value="' . $bhrc_aim_ranking . '" Style="width: 6em; float: right">%
    <input type="text" size=3 name="bhrc_elm_ranking_16" value="' . $bhrc_aim_ranking_16 . '" Style="width: 6em; float: right">%</div><br>

    <div Style="width: 100%; line-height: 1.2em;">ELM
    <input type="text" size=3 name="bhrc_elm_ranking" value="' . $bhrc_elm_ranking . '" Style="width: 6em; float: right">%
    <input type="text" size=3 name="bhrc_elm_ranking_16" value="' . $bhrc_elm_ranking_16 . '" Style="width: 6em; float: right">%</div><br>
    <div Style="width: 100%; line-height: 1.2em;">MFA
    <input type="text" size=3 name="bhrc_mfa_ranking" value="' . $bhrc_mfa_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_mfa_ranking_16" value="' . $bhrc_mfa_ranking_16 . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">MassPIRG
    <input type="text" size=3 name="bhrc_masspirg_ranking" value="' . $bhrc_masspirg_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_masspirg_ranking_16" value="' . $bhrc_masspirg_ranking_16 . '" Style="width: 6em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">NCFIB
    <input type="text" size=3 name="bhrc_nfib_ranking" value="' . $bhrc_nfib_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_nfib_ranking_16" value="' . $bhrc_nfib_ranking_16 . '" Style="width: 6em; float: right"></div><br>

    <div Style="width: 100%; line-height: 1.2em;">GOAL
    <input type="text" size=3 name="bhrc_goal_ranking" value="' . $bhrc_goal_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_goal_ranking_16" value="' . $bhrc_goal_ranking_16 . '" Style="width: 6em; float: right"></div><br>

    <div Style="width: 100%; line-height: 1.2em;">PP
    <input type="text" size=3 name="bhrc_pp_ranking" value="' . $bhrc_pp_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_pp_ranking_16" value="' . $bhrc_pp_ranking_16 . '" Style="width: 6em; float: right"></div><br>

    <div Style="width: 100%; line-height: 1.2em;">MTA
    <input type="text" size=3 name="bhrc_mta_ranking" value="' . $bhrc_mta_ranking . '" Style="width: 6em; float: right">
    <input type="text" size=3 name="bhrc_mta_ranking_16" value="' . $bhrc_mta_ranking_16 . '" Style="width: 6em; float: right"></div><br>

</div>
  <br><hr></hr>

  <label for="bhrc_salary_benefits"><h4>Salary and Other Benefits</h4></label>
  <div>
    <div Style="width: 100%; line-height: 1.2em;">Salary $<input type="number" size="7" name="bhrc_rep_salary" value="' . $bhrc_rep_salary . '" Style="width: 10em; float: right"></div><br>
    <div Style="width: 100%; line-height: 1.2em;">Per Diem $<input type="number" size="5" name="bhrc_rep_per_diem" value="' . $bhrc_rep_per_diem . '" Style="width: 8em; float: right"</div><br>

  </div>
  </div>
  <div style="clear: both;"></div>';
    

}


add_action( 'save_post', 'bhrc_party_affiliation_save' );
function bhrc_party_affiliation_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if ( !wp_verify_nonce( $_POST['bhrc_party_affiliation_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  
  update_post_meta(get_the_ID(), 'bhrc_votes_with_leadership', $_POST['bhrc_votes_with_leadership']);
  update_post_meta(get_the_ID(), 'bhrc_missed_votes', $_POST['bhrc_missed_votes']);
  update_post_meta(get_the_ID(), 'bhrc_support_veto', $_POST['bhrc_support_veto']);
  update_post_meta(get_the_ID(), 'bhrc_rep_salary', $_POST['bhrc_rep_salary']);
  update_post_meta(get_the_ID(), 'bhrc_rep_per_diem', $_POST['bhrc_rep_per_diem']);
  update_post_meta(get_the_ID(), 'bhrc_legislator_chamber', $_POST['bhrc_legislator_chamber']);
  update_post_meta(get_the_ID(), 'district', $_POST['district']);

  update_post_meta(get_the_ID(), 'bhrc_rep_office_ph', $_POST['bhrc_rep_office_ph']);
  update_post_meta(get_the_ID(), 'bhrc_legislator_office_email', $_POST['bhrc_legislator_office_email']);
  update_post_meta(get_the_ID(), 'bhrc_legislator_aide_email', $_POST['bhrc_legislator_aide_email']);
  update_post_meta(get_the_ID(), 'bhrc_rep_twitter', $_POST['bhrc_rep_twitter']);
  update_post_meta(get_the_ID(), 'bhrc_rep_facebook', $_POST['bhrc_rep_facebook']);
  update_post_meta(get_the_ID(), 'bhrc_rep_website', $_POST['bhrc_rep_website']);

  update_post_meta(get_the_ID(), 'bhrc_clt_ranking', $_POST['bhrc_clt_ranking']);
  update_post_meta(get_the_ID(), 'bhrc_fema_ranking', $_POST['bhrc_fema_ranking']);
  update_post_meta(get_the_ID(), 'bhrc_masspa_ranking', $_POST['bhrc_masspa_ranking']);
  update_post_meta(get_the_ID(), 'bhrc_nra_ranking', $_POST['bhrc_nra_ranking']);

  update_post_meta(get_the_ID(), 'bhrc_elm_ranking', $_POST['bhrc_elm_ranking']);
  update_post_meta(get_the_ID(),  'bhrc_mfa_ranking',  $_POST['bhrc_mfa_ranking']);
  update_post_meta(get_the_ID(),  'bhrc_masspirg_ranking', $_POST['bhrc_masspirg_ranking']);
  update_post_meta(get_the_ID(),  'bhrc_nfib_ranking',  $_POST['bhrc_nfib_ranking']);

  update_post_meta(get_the_ID(),  'bhrc_goal_ranking',  $_POST['bhrc_goal_ranking']);
  update_post_meta(get_the_ID(),  'bhrc_pp_ranking',  $_POST['bhrc_pp_ranking']);
  update_post_meta(get_the_ID(),  'bhrc_mta_ranking',  $_POST['bhrc_mta_ranking']);
  update_post_meta(get_the_ID(),  'bhrc_nra_ranking',  $_POST['bhrc_nra_ranking']);

  update_post_meta(get_the_ID(), 'bhrc_clt_ranking_16', $_POST['bhrc_clt_ranking_16']);
  update_post_meta(get_the_ID(), 'bhrc_fema_ranking_16', $_POST['bhrc_fema_ranking_16']);
  update_post_meta(get_the_ID(), 'bhrc_masspa_ranking_16', $_POST['bhrc_masspa_ranking_16']);
  update_post_meta(get_the_ID(), 'bhrc_nra_ranking_16', $_POST['bhrc_nra_ranking_16']);

  update_post_meta(get_the_ID(), 'bhrc_elm_ranking_16', $_POST['bhrc_elm_ranking_16']);
  update_post_meta(get_the_ID(),  'bhrc_mfa_ranking_16',  $_POST['bhrc_mfa_ranking_16']);
  update_post_meta(get_the_ID(),  'bhrc_masspirg_ranking_16', $_POST['bhrc_masspirg_ranking_16']);
  update_post_meta(get_the_ID(),  'bhrc_nfib_ranking_16',  $_POST['bhrc_nfib_ranking_16']);

  update_post_meta(get_the_ID(),  'bhrc_goal_ranking_16',  $_POST['bhrc_goal_ranking_16']);
  update_post_meta(get_the_ID(),  'bhrc_pp_ranking_16',  $_POST['bhrc_pp_ranking_16']);
  update_post_meta(get_the_ID(),  'bhrc_mta_ranking_16',  $_POST['bhrc_mta_ranking_16']);
  update_post_meta(get_the_ID(),  'bhrc_nra_ranking_16',  $_POST['bhrc_nra_ranking_16']);

  update_post_meta(get_the_ID(), 'bhrc_party_affiliation', $_POST['bhrc_party_affiliation']);

  if ( ! wp_is_post_revision( $post_id ) ){

    // unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'bhrc_party_affiliation_save');

    // update the post, which calls save_post again
    wp_update_post( $my_post );

    // re-hook this function
    add_action('save_post', 'bhrc_party_affiliation_save');
  }


} // end save_custom_meta_data


/* add committees taxonomy - committees will become a post type then this will be a dropdown metabox populated with titles*/
function create_committees() {
 $labels = array(
    'name' => _x( 'Congressional Committees', 'taxonomy general name' ),
    'singular_name' => _x( 'Congressional Committee', 'taxonomy singular name' ),
    'search_items' =>  __( 'Congressional Committees' ),
    'all_items' => __( 'All Congressional Committees' ),
    'parent_item' => __( 'Parent Congressional Committee' ),
    'parent_item_colon' => __( 'Parent Congressional Committee:' ),
    'edit_item' => __( 'Edit Congressional Committee' ),
    'update_item' => __( 'Update Congressional Committee' ),
    'add_new_item' => __( 'Add New Congressional Committee' ),
    'new_item_name' => __( 'New Congressional Committee Name' ),
  );

  register_taxonomy('congressional_committees','representatives',array(
    'hierarchical'  => true,
    'labels'    => $labels,
    query_vars    => true

  ));
}

add_action( 'init', 'create_committees' );



/***********************************************************************************************/
/*add metabox for extra profile info*/
add_action( 'add_meta_boxes', 'contactProfileInfo' );
function contactProfileInfo() {

  $screens = array( 'representatives');
    foreach ($screens as $screen) {
    add_meta_box(
      'representative_profile',
      __( 'Profile Data', 'myplugin_textdomain' ),
      'representative_profile_content',
      $screen,
      'normal',
      'high'
    );
  }
}

function representative_profile_content() {
  wp_nonce_field( plugin_basename( __FILE__ ), 'representative_profile_content_nonce' );

  $bhrc_rep_dinner_guest = get_post_meta(get_the_ID(), 'bhrc_rep_dinner_guest', true);
  $bhrc_rep_three_songs = get_post_meta(get_the_ID(), 'bhrc_rep_three_songs', true);
  $bhrc_rep_fav_game = get_post_meta(get_the_ID(), 'bhrc_rep_fav_game', true);
  $bhrc_rep_bucket_list = get_post_meta(get_the_ID(), 'bhrc_rep_bucket_list', true);

  echo '<FIELDSET>

  <P><label for="bhrc_rep_bucket_list">What are the Top 3 items on your Bucket List</label><br>
    <textarea name="bhrc_rep_bucket_list" cols=80>' . $bhrc_rep_bucket_list . '</textarea></P>

  <P><label for="bhrc_rep_dinner_guest">If you could have dinner and conversation with one person, living or dead, who would it be and why?</label><br>
    <textarea name="bhrc_rep_dinner_guest" cols=80>' . $bhrc_rep_dinner_guest . '</textarea></P>

  <P><label for="bhrc_rep_three_songs">If you are stuck on a desert island and can have only three songs with you, what would they be?</label><br>
    <input id="bhrc_rep_three_songs" name="bhrc_rep_three_songs" value="' . $bhrc_rep_three_songs . '" type="text" size=80></P>

  <P><label for="bhrc_rep_fav_game">What was your favorite outdoor game when you were a kid (Here at the site, we prefer Red Rover)</label><br>
    <input id="bhrc_rep_fav_game" name="bhrc_rep_fav_game" value="' . $bhrc_rep_fav_game . '" type="text" size=80></P>

    </FIELDSET>';


}

add_action( 'save_post', 'representative_profile_save' );
function representative_profile_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if ( !wp_verify_nonce( $_POST['representative_profile_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  update_post_meta( $post_id, 'bhrc_rep_dinner_guest', $_POST['bhrc_rep_dinner_guest']);
  update_post_meta( $post_id, 'bhrc_rep_three_songs', $_POST['bhrc_rep_three_songs']);
  update_post_meta( $post_id, 'bhrc_rep_fav_game', $_POST['bhrc_rep_fav_game']);
  update_post_meta( $post_id, 'bhrc_rep_bucket_list', $_POST['bhrc_rep_bucket_list']);

  if ( ! wp_is_post_revision( $post_id ) ){

    // unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'representative_profile_save');

    // update the post, which calls save_post again
    wp_update_post( $my_post );

    // re-hook this function
    add_action('save_post', 'representative_profile_save');
  }
  

}





/*add metabox for contact informattion*/
add_action( 'add_meta_boxes', 'contact_first_name' );
function contact_first_name() {

  $screens = array( 'representatives');
    foreach ($screens as $screen) {
    add_meta_box(
      'contact_first_name',
      __( 'Profile Data', 'myplugin_textdomain' ),
      'contact_first_name_content',
      $screen,
      'normal',
      'high'
    );
  }
}
function contact_first_name_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'contact_first_name_content_nonce' );

  //$fgpsn_contact_first_name = get_post_meta(get_the_ID(), 'fgpsn_contact_first_name', true);
  //$fgpsn_contact_last_name = get_post_meta(get_the_ID(), 'fgpsn_contact_last_name', true);
  //$fgpsn_contact_title_role = get_post_meta(get_the_ID(), 'fgpsn_contact_title_role', true);

  
  $bhrc_rep_address_1 = get_post_meta($post->ID, 'bhrc_rep_address_1', true);
  $bhrc_rep_address_2 = get_post_meta($post->ID, 'bhrc_rep_address_2', true);
  $bhrc_rep_address_3 = get_post_meta($post->ID, 'bhrc_rep_address_3', true);

  $bhrc_contact_city = get_post_meta($post->ID, 'bhrc_contact_city', true);
  $bhrc_contact_state = get_post_meta($post->ID, 'bhrc_contact_state', true);
  $bhrc_contact_zip = get_post_meta($post->ID, 'bhrc_contact_zip', true);


  /*$bhrc_rep_game = get_post_meta(get_the_ID(), 'bhrc_rep_game', true);
  $bhrc_rep_outdoor_game = get_post_meta(get_the_ID(), 'bhrc_rep_outdoor_game', true);
  $bhrc_rep_catch_phrase = get_post_meta(get_the_ID(), 'bhrc_rep_catch_phrase', true);
  $bhrc_rep_crush = get_post_meta(get_the_ID(), 'bhrc_rep_crush', true);
  $bhrc_rep_first_car = get_post_meta(get_the_ID(), 'bhrc_rep_first_car', true);
  $bhrc_rep_bucket_list = get_post_meta(get_the_ID(), 'bhrc_rep_bucket_list', true);
  $bhrc_rep_most_influential = get_post_meta(get_the_ID(), 'bhrc_rep_most_influential', true);
  $bhrc_rep_suprise = get_post_meta(get_the_ID(), 'bhrc_rep_suprise', true);
  <P><label for="bhrc_rep_game">Favorite game you played as a kid? (Tag, Red Rover, etc.)</label><br>
    <input id="bhrc_rep_game" name="bhrc_rep_game" value="' . $bhrc_rep_game . '" type="text" size=80></P>

  <P><label for="bhrc_rep_outdoor_game">Favorite outdoor game you played as a kid? (Tag, Red Rover, etc.)</label><br>
    <input id="bhrc_rep_outdoor_game" name="bhrc_rep_outdoor_game" value="' . $bhrc_rep_outdoor_game . '" type="text" size=80></P>

  <P><label for="bhrc_rep_catch_phrase">What is your favorite quote or catchphrase from a movie or TV show?</label><br>
    <input id="bhrc_rep_catch_phrase" name="bhrc_rep_catch_phrase" value="' . $bhrc_rep_catch_phrase . '" type="text" size=80></P>


  <P><label for="bhrc_rep_crush">Who was your celebrity crush when you were a teenager?<br>
    <input id="bhrc_rep_crush" name="bhrc_rep_crush" value="' . $bhrc_rep_crush . '" type="text" size=80></P>

  <P><label for="bhrc_rep_first_car">What model and year was the first car you bought? Did it have a name?</label><br>
    <input id="bhrc_rep_first_car" name="bhrc_rep_first_car" value="' . $bhrc_rep_first_car . '" type="text" size=80></P>

  <P><label for="bhrc_rep_bucket_list">The Top 3 things on your Bucket List?</label><br>
    <input id="bhrc_rep_bucket_list" name="bhrc_rep_bucket_list" value="' . $bhrc_rep_bucket_list . '" type="text" size=80></P>


  <P><label for="bhrc_rep_most_influential">The person in your life who most influenced you and why?</label><br>
    <input id="bhrc_rep_most_influential" name="bhrc_rep_most_influential" value="' . $bhrc_rep_most_influential . '" type="text" size=80></P>

  <P><label for="bhrc_rep_suprise">Tell us something people would be surprised to know about you.</label><br>
    <input id="bhrc_rep_suprise" name="bhrc_rep_suprise" value="' . $bhrc_rep_suprise . '" type="text" size=80></P>
  </FIELDSET>
  */

  echo '<FIELDSET>
  <h4>Office Information</h4>
  <P><label for="bhrc_rep_address_1">Address 1: </label>
    <input id="bhrc_rep_address_1" name="bhrc_rep_address_1" size="40" type="text" value="' . $bhrc_rep_address_1 . '" />

    <P><label for="bhrc_rep_address_2">Address 2: </label>
    <input id="bhrc_rep_address_2" name="bhrc_rep_address_2" size="40" type="text" value="' . $bhrc_rep_address_2 . '" />

    <P><label for="bhrc_rep_address_3">Extra Address Information: </label>
    <input id="bhrc_rep_address_3" name="bhrc_rep_address_3" size="40" type="text" value="' . $bhrc_rep_address_3 . '" />

    <P><label for="bhrc_contact_city">City: </label>
    <input id="bhrc_contact_city" name="bhrc_contact_city" size="40" type="text" value="' . $bhrc_contact_city . '" />

    <P><label for="bhrc_contact_state">State/Province*</label>
    <SELECT id="bhrc_contact_state" name="bhrc_contact_state" />';

      $this_count = count($states_util);

      echo "<OPTION value=''> - Here -" . $this_count . " </OPTION>\n";

      foreach ($states_util as $key => $value) {

        echo "<OPTION value='" . $key . "'>" . $value . "</OPTION>\n";

      }
      echo '</SELECT>

    <P><label for="bhrc_contact_zip">Zip Code:</label>
    <input id="bhrc_contact_zip" name="bhrc_contact_zip" size="40" type="text" value="' . $bhrc_contact_zip . '" />

  </FIELDSET>';

}

add_action( 'save_post', 'contact_first_name_save' );
function contact_first_name_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if ( !wp_verify_nonce( $_POST['contact_first_name_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  

  //$bhrc_contact_property_id = $_POST['bhrc_contact_property_id'];

  $post_title = $bhrc_contact_first_name . " " . $bhrc_contact_last_name;

  $user_id = username_exists( $bhrc_contact_first_name );
  if ( !$user_id && email_exists($bhrc_contact_email) == false ) {

    $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
    $user_id = wp_create_user( $bhrc_contact_first_name, $random_password, $bhrc_contact_email );

    /*update_user_meta( $user_id, 'bhrc_contact_data_id', $bhrc_contact_data_id );
    update_user_meta( $user_id, 'bhrc_contact_first_name', $bhrc_contact_last_name );
    update_user_meta( $user_id, 'bhrc_contact_last_name', $bhrc_contact_last_name );
    update_user_meta( $user_id, 'bhrc_contact_phone', $bhrc_contact_phone );
    update_user_meta( $user_id, 'bhrc_contact_email', $bhrc_contact_email );
    update_user_meta( $user_id, 'bhrc_contact_cell_phone', $bhrc_contact_cell_phone );*/
    update_user_meta( $user_id, 'bhrc_rep_address_1', $bhrc_rep_address_1 );
    update_user_meta( $user_id, 'bhrc_rep_address_2', $bhrc_rep_address_2 );
    update_user_meta( $user_id, 'bhrc_rep_address_3', $bhrc_rep_address_3 );
    update_user_meta( $user_id, 'bhrc_contact_city', $bhrc_contact_city );
    update_user_meta( $user_id, 'bhrc_contact_zip', $bhrc_contact_zip );
    //update_user_meta( $user_id, 'bhrc_contact_property_id', $bhrc_contact_property_id );


  } else {
/*
    update_user_meta( $user_id, 'contact_data_id', $contact_data_id );
    update_user_meta( $user_id, 'contact_last_name', $contact_last_name );
    update_user_meta( $user_id, 'client_phone', $client_phone );
    update_user_meta( $user_id, 'client_email', $client_email );
    update_user_meta( $user_id, 'client_cell', $client_cell );

    $random_password = __('User already exists.  Password inherited.');
  */
  }

  // Update the post into the database
  // wp_update_post( $my_post );

  $bhrc_contact_first_name = $_POST['bhrc_contact_first_name'];
  $bhrc_contact_last_name = $_POST['bhrc_contact_last_name'];

  update_post_meta( $post_id, 'bhrc_rep_address_1', $_POST['bhrc_rep_address_1']);
  update_post_meta( $post_id, 'bhrc_rep_address_2', $_POST['bhrc_rep_address_2']);
  update_post_meta( $post_id, 'bhrc_rep_address_3', $_POST['bhrc_rep_address_3']);
  update_post_meta( $post_id, 'bhrc_contact_city', $_POST['bhrc_contact_city']);
  update_post_meta( $post_id, 'bhrc_contact_zip', $_POST['bhrc_contact_zip']);
  update_post_meta( $post_id, 'bhrc_contact_state', $_POST['bhrc_contact_state']);


  if ( ! wp_is_post_revision( $post_id ) ){

    $my_post = array();
    /*$my_post['ID'] = $post_id;
    $my_post['post_title'] = $post_title;*/

    // unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'contact_first_name_save');

    // update the post, which calls save_post again
    wp_update_post( $my_post );

    // re-hook this function
    add_action('save_post', 'contact_first_name_save');

  }

}


//add a filter to add meta data and vote record to representative single
function add_meta_to_rep_single_filter($content) {
 
 if( is_singular('representatives') ) {
  $rep_header = '';
  $votes_with_leadership = get_post_meta(get_the_ID(), 'bhrc_votes_with_leadership', true);
  $bhrc_missed_votes = get_post_meta(get_the_ID(), 'bhrc_missed_votes', true);
  $bhrc_support_veto = get_post_meta(get_the_ID(), 'bhrc_support_veto', true);
  $bhrc_rep_salary = get_post_meta(get_the_ID(), 'bhrc_rep_salary', true);
  $bhrc_rep_per_diem = get_post_meta(get_the_ID(), 'bhrc_rep_per_diem', true);
  $bhrc_legislator_code = get_post_meta(get_the_ID(), 'bhrc_legislator_code', true);
  $bhrc_party_affiliation = get_post_meta(get_the_ID(), 'bhrc_party_affiliation', true);
  $bhrc_legislator_chamber = get_post_meta(get_the_ID(), 'bhrc_legislator_chamber', true);
  $district = get_post_meta(get_the_ID(), 'district', true);

  $bhrc_newscon_pname = get_post_meta(get_the_ID(), 'bhrc_newscon_pname', true);
  $bhrc_newscon_plink = get_post_meta(get_the_ID(), 'bhrc_newscon_plink', true);
  $bhrc_newscon_pname_1 = get_post_meta(get_the_ID(), 'bhrc_newscon_pname_1', true);
  $bhrc_newscon_plink_1 = get_post_meta(get_the_ID(), 'bhrc_newscon_plink_1', true);
  $bhrc_newscon_pname_2 = get_post_meta(get_the_ID(), 'bhrc_newscon_pname_2', true);
  $bhrc_newscon_plink_2 = get_post_meta(get_the_ID(), 'bhrc_newscon_plink_2', true);
  $bhrc_newscon_pname_3 = get_post_meta(get_the_ID(), 'bhrc_newscon_pname_3', true);
  $bhrc_newscon_plink_3 = get_post_meta(get_the_ID(), 'bhrc_newscon_plink_3', true);

  $bhrc_rep_address_1 = get_post_meta(get_the_ID(), 'bhrc_rep_address_1', true);
  $bhrc_rep_address_2 = get_post_meta(get_the_ID(), 'bhrc_rep_address_2', true);
  $bhrc_rep_address_3 = get_post_meta(get_the_ID(), 'bhrc_rep_address_3', true);

  $bhrc_legislator_first_name = get_post_meta(the_ID(), 'bhrc_legislator_first_name', true);
  $bhrc_contact_city = get_post_meta(the_ID(), 'bhrc_contact_city', true);
  $bhrc_contact_state = get_post_meta(get_the_ID(), 'bhrc_contact_state', true);
  $bhrc_contact_zip = get_post_meta(get_the_ID(), 'bhrc_contact_zip', true);

  $bhrc_rep_office_ph = get_post_meta(get_the_ID(), 'bhrc_rep_office_ph', true);
  $bhrc_legislator_office_email = get_post_meta(get_the_ID(), 'bhrc_legislator_office_email', true);
  $bhrc_legislator_aide_email = get_post_meta(get_the_ID(), 'bhrc_legislator_aide_email', true);
  $bhrc_rep_twitter = get_post_meta(get_the_ID(), 'bhrc_rep_twitter', true);
  $bhrc_rep_twitter_name = substr($bhrc_rep_twitter, 1);
  $bhrc_rep_facebook = get_post_meta(get_the_ID(), 'bhrc_rep_facebook', true);
  $bhrc_rep_website = get_post_meta(get_the_ID(), 'bhrc_rep_website', true);
  $rep_name = get_the_title();

  if ($bhrc_chamber_vote == 'HOUSE') {$title = 'Representative';} else {$title = 'Senator';}
  if ($bhrc_party_affiliation == 'D') {$bhrc_party_affiliation = 'Democrat';} 
  if ($bhrc_party_affiliation == 'R') {$bhrc_party_affiliation = 'Republican';} 

  
  $rep_header .= '<main class="my-single">';

  $rep_header .= '<article id="' . get_the_ID() . '">';
    
  if (get_post_meta(get_the_ID(), 'giornalismo_featured_video', true)) {
        $rep_header .= '<div class="featured-video">';
        $rep_header .= wp_oembed_get(get_post_meta(get_the_ID(), 'giornalismo_featured_video', true));
        $rep_header .= '</div>';
  } elseif (has_post_thumbnail()) {

   } else { }

   if (get_post_meta(get_the_ID(), 'giornalismo_photo_caption', true)) {
    $rep_header .= '<p class="caption">';
    $rep_header .= get_post_meta(get_the_ID(), 'giornalismo_photo_caption', true);
    $rep_header .= '</p>';
  }
  if (get_post_meta(get_the_ID(), 'giornalismo_photo_credit', true)) {

      $rep_header .= '<p class="photo-credit">';
      $rep_header .= get_post_meta(get_the_ID(), 'giornalismo_photo_credit', true);
      $rep_header .= '</p>';
    }
    $rep_header .= '<header class="story-header">
        <h3 class="headline">';
        $rep_header .= the_title();
        $rep_header .= '</h3>';
        $rep_header .= '<h5 class="byline"></h5>
        <div class="profile-photo">';
        $rep_header .= the_post_thumbnail('rep-profile');
        $rep_header .= '</div>';
        $rep_header .= '<div class="rep-badges" Style="display: inline; float: left; width: 48%;">
          <div type="button" class="btn btn-successd" Style="margin: .2em auto; padding: .1em;"><span class="badge">';
        $rep_header .= $bhrc_party_affiliation;
        $rep_header .= '</span></div>
          <div type="button" class="btn btn-infod" Style="margin: .2em auto; padding: .1em;">District <span class="badge">';
          $rep_header .= $district;
          $rep_header .= '</span></div>
          
          <div class="rep-office"><h5>Contact Information</h5>
          Phone: ' . $bhrc_rep_office_ph . '<br>';
          $rep_header .= 'Email: <a href="mailto:' . $bhrc_legislator_office_email . '">' . $bhrc_legislator_office_email . '</a><br>';
          $rep_header .= 'On Twitter: <a href="https://twitter.com/' . $bhrc_rep_twitter_name . '" target="_blank">' . $bhrc_rep_twitter . '<br>';
          $rep_header .= 'On <a href="http://' . $bhrc_rep_facebook . '" target="_blank">Facebook</a>';
          $rep_header .= '</div>
          <div class="rep-office"><!-- <h5>Office Location</h5> -->';
          $rep_header .= $bhrc_rep_address_1 . '<br>';
          $rep_header .= $bhrc_rep_address_2 . '<br>';
          $rep_header .= $bhrc_rep_address_3 . '<br>';
          $rep_header .= $bhrc_contact_city . ', ' . $bhrc_contact_state . ', ' . $bhrc_contact_zip;
          $rep_header .= '</div>
        </div>
        <div style="clear: both;" ></div>
        <a href="#content-top-anchor">
        <!-- <div class="rep-contact-info">
          

          
          <div style="clear: both;"></div>

        </div> -->
      
        <div class="rep-newpapers">';
        
        
        if ( $bhrc_newscon_pname != '' ) {
          $rep_header .= "You can follow your " . strtolower($title) . "\’s latest votes in the weekly feature Beacon Hill Roll Call in these local print newspapers and/or on their websites.<br>
            <div class='paper-link'><a href='http://" . $bhrc_newscon_plink . "' target='_blank'>" . $bhrc_newscon_pname . "</a>
            </div>";

        }

          if ( $bhrc_newscon_pname_1 != '' ) {

            $rep_header .= "<div class='paper-link'><a href='http://'" . $bhrc_newscon_plink . "' target='_blank'>" . $bhrc_newscon_pname_1 . "</a>
            </div>";

        }

          if ( $bhrc_newscon_pname_2 != '' ) {

            $rep_header .= "<div class='paper-link'><a href='http://" . $bhrc_newscon_plink . "' target='_blank'>" . $bhrc_newscon_pname_2 . "</a>
            </div>";

         }

          if ( $bhrc_newscon_pname_3 != '' ) {
            $rep_header .= "<div class='paper-link'><a href='http://" . $bhrc_newscon_plink . "' target='_blank'>" . $bhrc_newscon_pname_3 . "</a>
            </div>";

         } 

        
        $rep_header .= "</div>        
              </header>
              <hr />";



      $rep_body = '';
      $rep_body .= '<div class="rep-single-profile">
      <h4>Get to know your representative</h4>
      <p>The following information has be submitted by the representative</p>
        <dl>
        <dt>If you could have dinner and conversation with one person, living or dead, who would it be and why?</dt>
        <dd>';
      $rep_body .= get_post_meta(get_the_ID(), 'bhrc_rep_dinner_guest', true);
      $rep_body .= '</dd>
      <dt>If you are stuck on a desert island and can have only three songs with you, what would they be?</dt>
        <dd>';
      $rep_body .= get_post_meta(get_the_ID(), 'bhrc_rep_three_songs', true);
      $rep_body .= '</dd>
      <dt>Favorite game you played as a kid? (Tag, Red Rover, etc.)</dt>
        <dd>';
      $rep_body .= get_post_meta(get_the_ID(), 'bhrc_rep_fav_game', true);
      $rep_body .= '</dd>
      <dt>The Top 3 things on your Bucket List?</dt>
        <dd>';
      $rep_body .= get_post_meta(get_the_ID(), 'bhrc_rep_bucket_list', true);
      $rep_body .= '</dd>
      </dl>
    </div>
    <div class="rep-single-archive">';
      

    $user = get_user_by( 'email', $bhrc_legislator_office_email ); 
    if( $bhrc_legislator_chamber == 'HOUSE' ) { $title = 'Representative'; } else { $title = 'Senator'; }

    $rep_body .= '<H4>Additional Content From ';
    $rep_body .= $title . ' ' . get_the_title();
    $rep_body .= '</H4>
    <p>A page we gave your senator and representative on which they can do and say whatever they want.</p>';
    global $wpdb;
    $args = array(
      //'author'      => $user->ID,
      'posts_per_page'   => 5,
      'offset'           => 0,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'post_status'      => 'publish',
      'suppress_filters' => true 
    );
    $myposts = get_posts( $args );
    $rep_body .= $wpdb->last_query . '<br>' . count($myposts);

    foreach ( $myposts as $post ) : setup_postdata( $post );
      $rep_body .= '<li>
        <a href="' . get_the_permalink($post->ID) . '">' . $post->post_title . '</a>
      </li>';
    endforeach; 
    wp_reset_postdata();
    $rep_body .= '</div>';






    return $rep_header . $rep_body . $content . "<H1>JJDJD</h1>";

  }

  if( is_archive('representatives') || is_search('representatives') ) {
    
    $rep_archive = '<div class="rep-sidebar-cantainer">
      <div class="col1">
    <button type="button" class="btn btn-info" ID="toggle-single-archive">A page we gave your senator and representative on which they can do and say whatever they want</button>

    <button type="button" class="btn btn-info" ID="toggle-single-profile">Our famous "Four Fun Questions." Including you"re your representative"s and senator"s three favorite songs</button>

    <button type="button" class="btn btn-info" ID="toggle-get-house-attendance">How many roll call votes they missed</button>

    <button type="button" class="btn btn-info" ID="toggle-single-vote-side-leadership">How often they voted and sided with their party"s leadership team</button>

    <button type="button" class="btn btn-info" ID="toggle-single-vote-veto-support">How often they sided with Gov. Charlie Baker cutting millions of dollars from the state budget</button>
    </div>

    <div class="col2">
    <button type="button" class="btn btn-info" ID="toggle-single-vote-per-diem">How much money in "per diems" they have collected for travel from their homes to the Statehouse</button>

    <button type="button" class="btn btn-info" ID="toggle-single-salary">Their annual salary, health insurance, expense allowances and other benefits they receive</button>

    <button type="button" class="btn btn-info" ID="toggle-single-vote-profile">How they were rated by interest groups, like the Mass Teacher"s Association, Citizens for Limited Taxation</button>

    <button type="button" class="btn btn-info" ID="toggle-single-vote-search">Sortable, searchable voting records</button>

    <button type="button" class="btn btn-info" ID="toggle-record-request">2015-2016 Voting Record</button>
    </div>
    </div>';
    return $rep_archive . $content . "<H1>orr</h1>";
  }
}

add_filter( 'the_content', 'add_meta_to_rep_single_filter' );

}

?>

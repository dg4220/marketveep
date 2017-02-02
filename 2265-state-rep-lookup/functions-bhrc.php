<?php

/*create s sidebar legislator search form */

class Rep_Search_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'rep_search_widget', // Base ID
      esc_html__( 'Find Your State Legislators', 'state_rep_search' ), // Name
      array( 'description' => esc_html__( 'Enter your address and the widget displays your state representatives and seantor ', 'state_rep_search' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {

    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
    echo '<div class="widget-item">
Street:<br>
(eg, 24 Beacon St)<br>
<input type="text" name="my-searh-address" id="my-address">
<br>
City:<br>
(eg, Boston)
<!-- (If you live in a village go here to look up your City equivilent)<br> -->
<input type="text" name="my-searh-city" id="my-city">
<br>
  <button type="button" class="btn btn-info" id="submit-my-address">Get Representative and Senator</button>
<div class="bhrc_leg_search"></div>
</div>';
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'state_rep_search' );
    ?>
   Hi
    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Rep_Search_Widget

function register_rep_search_widget() {
    register_widget( 'Rep_Search_Widget' );
}
add_action( 'widgets_init', 'register_rep_search_widget' );

?>
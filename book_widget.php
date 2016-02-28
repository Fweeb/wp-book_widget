<?php
/*
Plugin Name: Book Widget
Plugin URI: <insert GitHub link>
Description: A simple widget for adding links to your books for sale on sites like Amazon, Kobo, Nook, etc.
Version: 0.1
Author: Jason van Gumster (Fweeb)
Author URI: http://monsterjavaguns.com
License: GPL3
*/

// Block direct requests
if( !defined('ABSPATH') )
    die('-1');

class Book_Widget extends WP_Widget {

    //XXX Using PHP 5.2 style constructor. Might be wise to switch to 5.3 style with namespaces
    public function __construct() {
        $widget_ops = array(
            'classname' => 'book_widget',
            'description' => 'A simple widget for adding links to your books for sale on sites like Amazon, Kobo, Nook, etc.',
        );
        parent::__construct( 'book_widget', 'Book Widget', $widget_ops );
    }

    /**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        if ( ! empty( $instance['bookcover_uri'] ) ) {
            ?>
            <a href="<?php echo $instance['amazon_uri']; ?>"><img src="<?php echo $instance['bookcover_uri']; ?>" width="100" height="150" alt="<?php echo $instance['title']; ?>" /></a>
            <?php
        }
        echo $args['after_widget'];
    }

    /**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
        $bookcover_uri = ! empty( $instance['bookcover_uri'] ) ? $instance['bookcover_uri'] : __( 'https://', 'text_domain' );
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'bookcover_uri' ); ?>"><?php _e( 'Book Cover URI:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'bookcover_uri' ); ?>" name="<?php echo $this->get_field_name( 'bookcover_uri' ); ?>" type="text" value="<?php echo esc_attr( $bookcover_uri ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'amazon_uri' ); ?>"><?php _e( 'Amazon URI:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'amazon_uri' ); ?>" name="<?php echo $this->get_field_name( 'amazon_uri' ); ?>" type="text" value="<?php echo esc_attr( $amazon_uri ); ?>">
        </p>
        <?php
    }

    /**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['bookcover_uri'] = ( ! empty( $new_instance['bookcover_uri'] ) ) ? strip_tags( $new_instance['bookcover_uri'] ) : '';
        $instance['amazon_uri'] = ( ! empty( $new_instance['amazon_uri'] ) ) ? strip_tags( $new_instance['amazon_uri'] ) : '';

        return $instance;
    }

} // class Book_Widget

add_action('widgets_init',
    create_function('', 'return register_widget("Book_Widget");'));

?>

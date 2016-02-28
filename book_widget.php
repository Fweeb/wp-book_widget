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
        $vendors = array();
        if ( ! empty( $instance['amazon_uri'] ) && $instance['amazon_uri'] !== 'https://' )
            $vendors['amazon'] = $instance['amazon_uri'];
        if ( ! empty( $instance['nook_uri'] ) && $instance['nook_uri'] !== 'https://' )
            $vendors['nook'] = $instance['nook_uri'];
        if ( ! empty( $instance['kobo_uri'] ) && $instance['kobo_uri'] !== 'https://' )
            $vendors['kobo'] = $instance['kobo_uri'];
        if ( ! empty( $instance['ibooks_uri'] ) && $instance['ibooks_uri'] !== 'https://' )
            $vendors['ibooks'] = $instance['ibooks_uri'];
        if ( ! empty( $instance['gplaybooks_uri'] ) && $instance['gplaybooks_uri'] !== 'https://' )
            $vendors['gplaybooks'] = $instance['gplaybooks_uri'];

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        if ( ! empty( $instance['bookcover_uri'] ) ) {
            ?>
            <p><img src="<?php echo $instance['bookcover_uri']; ?>" width="100" height="150" alt="<?php echo $instance['title']; ?>" title="<?php echo $instance['title']; ?>" /></p>
            <?php
        }
        if ( count( $vendors ) > 0 ) {
            ?>
            <p>Purchase on:</p>
            <ul style="list-style-type: none; display: inline; margin: 0; padding: 0;">
            <?php
                if ( ! empty( $vendors['amazon'] ) ) {
                    ?>
                    <li style="display: inline;"><a href="<?php echo $vendors['amazon']; ?>"><img src="<?php echo plugins_url( 'img/btn_amazon.png', __FILE__ ); ?>" width="24" height="24" alt="Amazon" title="Amazon" /></a></li>
                    <?php
                }
                if ( ! empty( $vendors['nook'] ) ) {
                    ?>
                    <li style="display: inline;"><a href="<?php echo $vendors['nook']; ?>"><img src="<?php echo plugins_url( 'img/btn_nook.png', __FILE__ ); ?>" width="24" height="24" alt="Nook" title="Nook" /></a></li>
                    <?php
                }
                if ( ! empty( $vendors['kobo'] ) ) {
                    ?>
                    <li style="display: inline;"><a href="<?php echo $vendors['kobo']; ?>"><img src="<?php echo plugins_url( 'img/btn_kobo.png', __FILE__ ); ?>" width="24" height="24" alt="Kobo" title="Kobo" /></a></li>
                    <?php
                }
                if ( ! empty( $vendors['ibooks'] ) ) {
                    ?>
                    <li style="display: inline;"><a href="<?php echo $vendors['ibooks']; ?>"><img src="<?php echo plugins_url( 'img/btn_ibooks.png', __FILE__ ); ?>" width="24" height="24" alt="iBooks" title="iBooks" /></a></li>
                    <?php
                }
                if ( ! empty( $vendors['gplaybooks'] ) ) {
                    ?>
                    <li style="display: inline;"><a href="<?php echo $vendors['gplaybooks']; ?>"><img src="<?php echo plugins_url( 'img/btn_gplaybooks.png', __FILE__ ); ?>" width="24" height="24" alt="Google Play Books" title="Google Play Books" /></a></li>
                    <?php
                }
            ?>
            </ul>
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
        $amazon_uri = ! empty( $instance['amazon_uri'] ) ? $instance['amazon_uri'] : __( 'https://', 'text_domain' );
        $nook_uri = ! empty( $instance['nook_uri'] ) ? $instance['nook_uri'] : __( 'https://', 'text_domain' );
        $kobo_uri = ! empty( $instance['kobo_uri'] ) ? $instance['kobo_uri'] : __( 'https://', 'text_domain' );
        $ibooks_uri = ! empty( $instance['ibooks_uri'] ) ? $instance['ibooks_uri'] : __( 'https://', 'text_domain' );
        $gplaybooks_uri = ! empty( $instance['gplaybooks_uri'] ) ? $instance['gplaybooks_uri'] : __( 'https://', 'text_domain' );
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
        <p>
        <label for="<?php echo $this->get_field_id( 'nook_uri' ); ?>"><?php _e( 'Nook URI:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'nook_uri' ); ?>" name="<?php echo $this->get_field_name( 'nook_uri' ); ?>" type="text" value="<?php echo esc_attr( $nook_uri ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'kobo_uri' ); ?>"><?php _e( 'Kobo URI:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'kobo_uri' ); ?>" name="<?php echo $this->get_field_name( 'kobo_uri' ); ?>" type="text" value="<?php echo esc_attr( $kobo_uri ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'ibooks_uri' ); ?>"><?php _e( 'iBooks URI:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'ibooks_uri' ); ?>" name="<?php echo $this->get_field_name( 'ibooks_uri' ); ?>" type="text" value="<?php echo esc_attr( $ibooks_uri ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'gplaybooks_uri' ); ?>"><?php _e( 'Google Play Books URI:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'gplaybooks_uri' ); ?>" name="<?php echo $this->get_field_name( 'gplaybooks_uri' ); ?>" type="text" value="<?php echo esc_attr( $gplaybooks_uri ); ?>">
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
        $instance['nook_uri'] = ( ! empty( $new_instance['nook_uri'] ) ) ? strip_tags( $new_instance['nook_uri'] ) : '';
        $instance['kobo_uri'] = ( ! empty( $new_instance['kobo_uri'] ) ) ? strip_tags( $new_instance['kobo_uri'] ) : '';
        $instance['ibooks_uri'] = ( ! empty( $new_instance['ibooks_uri'] ) ) ? strip_tags( $new_instance['ibooks_uri'] ) : '';
        $instance['nook_uri'] = ( ! empty( $new_instance['gplaybooks_uri'] ) ) ? strip_tags( $new_instance['gplaybooks_uri'] ) : '';

        return $instance;
    }

} // class Book_Widget

add_action('widgets_init',
    create_function('', 'return register_widget("Book_Widget");'));

?>

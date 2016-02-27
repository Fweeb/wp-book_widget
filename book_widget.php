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

class Book_Widget extends WP_Widget {

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

    }

    /**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
    public function form($instance) {

    }

    /**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
    function update($new_instance, $old_instance) {

    }

}

add_action('widgets_init',
    create_function('', 'return register_widget("Book_Widget");'));

?>

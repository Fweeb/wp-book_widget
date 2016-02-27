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

class book_widget extends WP_Widget {

    function book_widget() {

    }

    function form($instance) {

    }

    function update($new_instance, $old_instance) {

    }

    function widget{$args, $instance) {

    }

}

add_action('widgets_init', create_function('', 'return
    register_widget("book_widget");'));

?>

<?php
/**
 * Plugin Name: Widgets
 * Author: Rupom
 * Desciption: Plugin description
 * Version: 1.0
 */

 require_once plugin_dir_path( __FILE__ ).'/demo_widget.php';
function widget_register(){
    register_widget('demo_widget');
}
add_action('widgets_init','widget_register');
?>
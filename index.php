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

function callback_widget_style($screen){
    if($screen == 'widgets.php'){
        wp_enqueue_style('widget_css', plugin_dir_url( __FILE__ ).'/css/style.css' );
    }
}
add_action( 'admin_enqueue_scripts','callback_widget_style');

// dashboard widget
function dw_dashboard_widget1(){
    wp_add_dashboard_widget('dash_widget1', 'dashboard_widget1', 'callback_for_output1');
}
add_action('wp_dashboard_setup','dw_dashboard_widget1');

function callback_for_output1(){
   echo 'hello dashboard';
}
// second widget
function dw_dashboard_widget2(){
    if(current_user_can('edit_dashboard')){
        wp_add_dashboard_widget('dash_widget2', 'dashboard_widget2', 'callback_for_output2','dashboard_configure');
    }
    wp_add_dashboard_widget('dash_widget2', 'dashboard_widget2', 'callback_for_output2');
}
add_action('wp_dashboard_setup','dw_dashboard_widget2');

function callback_for_output2(){
   $feeds = array(
        array(
            'url' => 'http://localhost/plugin_development/feed/',
            'items' => 3,
            'show_author' => 0,
            'show_date' => 0,
        ) 
   );
   wp_dashboard_primary_output('dash_board_wid', $feeds);
}
function dashboard_configure(){
    $option_value = get_option('dash_board_wid_nop',3);
    if(isset($_POST['dashboard-widget-nonce'])){
        if(isset($_POST['dw_nop'])){
            $option_value = sanitize_text_field($_POST['dw_nop']);
            update_option('dash_board_wid_nop',$option_value);
        }
    }
    ?>
    <label for="">Number of post:</label> <br>
    <input type="text" name="dw_nop" id="dw_nop" value="<?php echo $option_value ?>"> <br>
    <?php
}
?>
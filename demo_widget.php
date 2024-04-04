<?php
class demo_widget extends WP_Widget{
    public function __construct(){
        parent::__construct(
            'demowidget',
            'Demo widget',
            'widget description'
        );
    }
    public function form($instance){
        $title = isset($instance['title']) ? $instance['title'] : 'Demo widget';
        $latitude = isset($instance['latitude']) ? $instance['latitude'] : 23.9;
        $longitude = isset($instance['longitude']) ? $instance['longitude'] : 90.8;
        $email = isset($instance['email']) ? $instance['email'] : '';
        ?>
        <div class="demo_widget field_column">
            <p class="">
                <label for="<?php echo $this->get_field_id('title') ?>; "> Title </label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>;" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $title ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('latitude') ?>;"> latitude </label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('latitude') ?>;" name="<?php echo $this->get_field_name('latitude') ?>" value="<?php echo $latitude ?>">
            </p>
        </div>
        <p>
            <label for="<?php echo $this->get_field_id('longitude') ?>;"> longitude </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('longitude') ?>;" name="<?php echo $this->get_field_name('longitude') ?>" value="<?php echo $longitude ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email') ?>;"> email </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('email') ?>;" name="<?php echo $this->get_field_name('email') ?>" value="<?php echo $email ?>">
        </p>
        <?php
    }
    public function widget($args,$instance){
        echo $args['before_widget'];
        if(isset($instance['title']) && $instance['title'] != ''){
            echo $args['before_title'];
            echo apply_filters('widget_title', $instance['title']);
            echo $args['after_title'];
            ?>
            <div class="demowidget">
                <p> Latitude : <?php echo isset($instance['latitude']) ? $instance['latitude'] : '' ?></p>
                <p> longitude : <?php echo isset($instance['longitude']) ? $instance['longitude'] : '' ?></p>
                <p> email : <?php echo isset($instance['email']) ? $instance['email'] : '' ?></p>
            </div>
            <?php
        }
        echo $args['after_widget'];
        
    }
    public function update($new_instance,$old_instance){
        $instance = $new_instance;
        $instance['title'] = sanitize_text_field($instance['title']);
        if(!is_email($new_instance['email'])){
            $instance['email'] = $old_instance['email'];
        }
        if(!is_numeric($new_instance['latitude'])){
            $instance['latitude'] = $old_instance['latitude'];
        }
        if(!is_numeric($new_instance['longitude'])){
            $instance['longitude'] = $old_instance['longitude'];
        }
        return $instance;
    }
}
?>
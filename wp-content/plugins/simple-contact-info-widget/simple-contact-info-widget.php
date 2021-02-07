<?php

/*
Plugin Name: Contact Info Widget
Plugin URI: https://riotweb.nl
Description: A  simple Wordpress widget that shows contact info.
Author: Riotweb.nl
Version: 2.6.2
Author URI: https://riotweb.nl/plugins
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: simple-contact-info-widget
Domain Path: /languages
*/

if ( !defined('ABSPATH') )
  die('-1');

//enqueues our external font awesome stylesheet
function enqueue_fawidget_stylesheet(){
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts','enqueue_fawidget_stylesheet');

function enqueue_sciwidget_stylesheet()
{
    // Register the style
    wp_register_style( 'custom-style', plugins_url( 'css/hover-min.css', __FILE__ ));
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_sciwidget_stylesheet' );

//Contact info Widget
 
class contact_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'contact_widget', 
      __('Contact Info', 'text_domain'),
      array( 'description' => __( 'Display your contact info!', 'text_domain' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $title    = apply_filters('widget_title', $instance['title']);
        $company  = $instance['company'];
        $about  = $instance['about'];
        $address  = $instance['address'];
        $city  = $instance['city'];
        $zip  = $instance['zip'];
        $email  = $instance['email'];
        $phone   = $instance['phone'];
        $mobile   = $instance['mobile'];
        $fax   = $instance['fax'];
        $website   = $instance['website'];
        $whatsapp   = $instance['whatsapp'];
        $skype   = $instance['skype'];
        $facebook   = $instance['facebook'];
        $twitter   = $instance['twitter'];
        $color = $instance['color'];
        $color2 = $instance['color2'];
        $select  = $instance['select'];
        

        echo $before_widget; 
          if ( $title )
            echo $before_title . $title . $after_title; ?>
  
  <!-- Contact Info Widget -->
  <ul class="fa-ul">

<?php

if (!empty($company))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-building" style="color: '. $color .'"></i>'. $company .'</li>';
if (!empty($about))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-info" style="color: '. $color .'"></i>'. $about .'</li>';
if (!empty($address))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-home" style="color: '. $color .'"></i>'. $address .'<br>'. $city .' '. $zip .'</li>';
if (!empty($email))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-at" style="color: '. $color .'"></i><a style="text-decoration:none; color: '. $color2 .'"; href="mailto:'. $email .'";>'. $email .'</a></li>';
if (!empty($phone))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-phone" style="color: '. $color .'"></i>'. $phone .'</li>';
if (!empty($mobile))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-mobile" style="color: '. $color .'"></i>'. $mobile .'</li>';
if (!empty($fax))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-fax" style="color: '. $color .'"></i>'. $fax .'</li>';
if (!empty($website))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-globe" style="color: '. $color .'"></i><a href=http://'. $website .' style="text-decoration:none; color: '. $color2 .'; ">'. $website .'</a></li>';
if (!empty($whatsapp))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-whatsapp" style="color: '. $color .'"></i>'. $whatsapp .'</li>';
if (!empty($skype))
      echo '<li style="color: '. $color2 .'"><i class="hvr-' . $select . ' fa-li fa fa-skype" style="color: '. $color .'"></i><a href="skype:'. $skype .'?userinfo" style="color: '. $color2 .'; " target="_blank">'. $skype .'</a></li>';
if (!empty($facebook))
      echo '<li><i class="hvr-' . $select . ' fa-li fa fa-facebook" style="color: '. $color .'"></i><a style="text-decoration:none; color: '. $color2 .'"; target="_blank" href="https://www.facebook.com/'. $facebook .'";>Facebook</a></li>';
if (!empty($twitter))
      echo '<li><i class="hvr-' . $select . ' fa-li fa fa-twitter" style="color: '. $color .'"></i><a style="text-decoration:none; color: '. $color2 .'"; target="_blank" href="https://twitter.com/'. $twitter .'";>Twitter</a></li>';
?>

  </ul>

              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update  */
    function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['company'] = strip_tags($new_instance['company']);
    $instance['about'] = strip_tags($new_instance['about']);
    $instance['address'] = strip_tags($new_instance['address']);
    $instance['city'] = strip_tags($new_instance['city']);
    $instance['zip'] = strip_tags($new_instance['zip']);
    $instance['email'] = strip_tags($new_instance['email']);
    $instance['phone'] = strip_tags($new_instance['phone']);
    $instance['mobile'] = strip_tags($new_instance['mobile']);
    $instance['fax'] = strip_tags($new_instance['fax']);
    $instance['website'] = strip_tags($new_instance['website']);
    $instance['whatsapp'] = strip_tags($new_instance['whatsapp']);
    $instance['skype'] = strip_tags($new_instance['skype']);
    $instance['facebook'] = strip_tags($new_instance['facebook']);
    $instance['twitter'] = strip_tags($new_instance['twitter']);
    $instance['color'] = strip_tags($new_instance['color']);
    $instance['color2'] = strip_tags($new_instance['color2']);
    $instance['select'] = strip_tags($new_instance['select']);
        return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  
 
        $title    = esc_attr($instance['title']);
        $company  = esc_attr($instance['company']);
        $about  = esc_attr($instance['about']);
        $address  = esc_attr($instance['address']);
        $city  = esc_attr($instance['city']);
        $zip  = esc_attr($instance['zip']);
        $email  = esc_attr($instance['email']);
        $phone = esc_attr($instance['phone']);
        $mobile = esc_attr($instance['mobile']);
        $fax = esc_attr($instance['fax']);
        $website = esc_attr($instance['website']);
        $whatsapp = esc_attr($instance['whatsapp']);
        $skype = esc_attr($instance['skype']);
        $facebook = esc_attr($instance['facebook']);
        $twitter = esc_attr($instance['twitter']);
        $color = esc_attr($instance['color']);  
        $color2 = esc_attr($instance['color2']);
        $select = esc_attr($instance['select']);


        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){jQuery(".cw-color-picker").each(function(){var r=jQuery(this),c=r.attr("rel");r.farbtastic("#"+c)})});
        </script>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('company'); ?>"><?php _e('Company:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('company'); ?>" name="<?php echo $this->get_field_name('company'); ?>" type="text" value="<?php echo $company; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('about'); ?>"><?php _e('About:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('about'); ?>" name="<?php echo $this->get_field_name('about'); ?>" type="text" value="<?php echo $about; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e('Zip Code:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('mobile'); ?>"><?php _e('Mobile:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" type="text" value="<?php echo $mobile; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('website'); ?>"><?php _e('Website:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('website'); ?>" name="<?php echo $this->get_field_name('website'); ?>" type="text" value="<?php echo $website; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Icon effects:', 'simple-contact-info-widget'); ?></label>
            <select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
                <?php
                // Available options to choose from
                $options = array('none', 'back', 'forward', 'down', 'up', 'spin', 'drop', 'fade', 'float-away', 'sink-away',
                    'grow', 'shrink', 'pulse', 'pulse-grow', 'pulse-shrink', 'push', 'pop', 'bounce', 'rotate', 'grow-rotate',
                    'float', 'sink', 'bob', 'wobble-horizontal', 'wobble-vertical', 'buzz', 'buzz-out');
                foreach ($options as $option) {
                    echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';}
                ?>
            </select>
        <p>
        <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Icon color:', 'simple-contact-info-widget'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php if($color) { echo $color; } else { echo '#9F9F9F'; } ?>" />
        <div class="cw-color-picker" rel="<?php echo $this->get_field_id('color'); ?>"></div>
        </p>
         <p>
        <label for="<?php echo $this->get_field_id('color2'); ?>"><?php _e('Text Color:', 'simple-contact-info-widget'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('color2'); ?>" name="<?php echo $this->get_field_name('color2'); ?>" type="text" value="<?php if($color2) { echo $color2; } else { echo '#9F9F9F'; } ?>" />
        <div class="cw-color-picker" rel="<?php echo $this->get_field_id('color2'); ?>"></div>
        </p>
        <p>
        <label style="font-weight:bold;"><?php _e('Social Media'); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('whatsapp'); ?>"><?php _e('Whatsapp:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('whatsapp'); ?>" name="<?php echo $this->get_field_name('whatsapp'); ?>" type="text" value="<?php echo $whatsapp; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e('Skype:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $skype; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook Username:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter Username:', 'simple-contact-info-widget'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
        </p>
        <em><?php _e('Only use username for social media, <b>dont</b> put the whole url.', 'simple-contact-info-widget'); ?></em>
    
        <?php 
    }

 
} // end class
add_action('widgets_init', create_function('', 'return register_widget("contact_widget");'));


function sample_load_color_picker_script() {
  wp_enqueue_script('farbtastic');
}
function sample_load_color_picker_style() {
  wp_enqueue_style('farbtastic');
}

add_action('admin_print_scripts-widgets.php', 'sample_load_color_picker_script');
add_action('admin_print_styles-widgets.php', 'sample_load_color_picker_style');

//Include settings + shortcode
include('settings.php');

<?php

/*
 * Contributors: mdarmanin
 * Plugin Name: Car Rental Widget by MoreRentalCars.com
 * Version: 1.0.5
 * Plugin URI: https://wordpress.org/plugins/car-rental-widget-by-morerentalcarscom/
 * Description: A booking engine in the form of a widget that makes it possible for your visitors to rent a car at over 30,000 locations worldwide.
 * Tags: widget, widgets, car rental, booking engine
 * Author URI: https://profiles.wordpress.org/mdarmanin
 * Author: Michael Darmanin (mdarmanin)
 * Requires at least: 3.0.1
 * Tested up to: 4.6.1
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html/
*/

	//Initialize assets
	add_action( 'wp_enqueue_scripts', 'mrc_assets' );
	function mrc_assets() {
		wp_localize_script( 'assets', 'assets', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'assets', plugins_url( '/assets/main.js', __FILE__ ), array('jquery') );
		wp_enqueue_style( 'style.css', plugins_url( '/assets/style.css', __FILE__ ) );
	}

	//Initialize widget
	add_action('widgets_init', 'mrc_init'); 

	//Register widget
	function mrc_init () {
	    register_widget(mrc_widget);
	}


	//Create the widget class
	class mrc_widget extends WP_Widget {
    
	    function mrc_widget () {
	        $widget_options = array(
	            'classname' => 'mrc_class',
	            'description' => 'Displays the area that contains the widget'
	        );
	        
	        $this->WP_Widget('mrc_id', 'MoreRentalCars.com Widget', $widget_options);
	    }
	    
	    
	    //Show widget form in Appearance/Widgets 
	    function form ($instance) {
	        $mrc_title = array('title' => 'Rent a Car');
	        $instance = wp_parse_args($instance, $mrc_title);	        
	        $title = esc_attr($instance['title']);	        
	        echo '<p><input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>';
	    }
	    
		//Save the widget	     
	    function update ($new_instance, $old_instance) {
	         $instance = $old_instance;
	         $instance['title'] = strip_tags($new_instance['title']);
	         return $instance;         
	    }
	     
	    
	    //Show widget in post/page
	    function widget ($args, $instance) {
	       extract($args);
	       $title = apply_filters('widget_title', $instance['title']);
	        
	       echo $before_widget;
	       echo $before_title.$title.$after_title;
		   
		   //$mrc_logo = "<img src='wp-content/plugins/more-rental-cars/assets/imgs/newlogosml.png' id='mrc_logo'>";
		   $mrc_logo = plugins_url( '/assets/imgs/newlogosml.png', __FILE__ );
		   $mrc_be = "<iframe src='https://book.cartrawler.com/?client=634799&tv=49DAD9DA&lang=EN' id='mrc_iframe'></iframe>";        
	       echo $mrc_be;
		   echo "Powered by: " . '<a href="https://www.morerentalcars.com"><img src="'.$mrc_logo.'" id="mrc_logo"></a>';	
		     
	        
	       //print widget
	       echo $after_widget; 
	     }	     
	}
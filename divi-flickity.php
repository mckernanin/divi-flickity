<?php
/*
Plugin Name: Divi Flickity
Plugin URI: https://github.com/mckernanin/divi-flickity
Description: Replace Divi slider with a flickity one
Author: Kevin McKernan
Version: 1.0.0
Author URI: https://mckernan.in
Text Domain: divi-flickity
Domain Path: /languages/

// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Divi Flickity
 *
 * @return divi_flickity
 */
class DiviFlickity {

	function __construct() {
		add_action( 'wp', array( $this, 'replace_shortcodes' ), 100 );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts_styles' ) );
	}

	public function scripts_styles() {
		wp_register_style( 'flickity', 'https://npmcdn.com/flickity@1.2/dist/flickity.min.css' );
		wp_register_script( 'flickity', 'https://npmcdn.com/flickity@1.2/dist/flickity.pkgd.min.js' );
	}

	public function replace_shortcodes() {
		if ( class_exists( 'ET_Builder_Module' ) ) {
			include( 'class-et-pb-slider.php' );
			$slider = new DVFL_Builder_Module_Slider();
			remove_shortcode( 'et_pb_slider' );
			remove_shortcode( 'et_pb_fullwidth_slider' );
			add_shortcode( 'et_pb_slider', array( $slider, '_shortcode_callback' ) );
			add_shortcode( 'et_pb_fullwidth_slider', array( $slider, '_shortcode_callback' ) );

			include( 'class-et-pb-slide-item.php' );
			$slide = new DVFL_Builder_Module_Slider_Item();
			remove_shortcode( 'et_pb_slide' );
			add_shortcode( 'et_pb_slide', array( $slide, '_shortcode_callback' ) );
		}
	}
}

// Initialize the plugin
new DiviFlickity();

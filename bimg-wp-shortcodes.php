<?php
/**
 * Plugin Name: BIMG WP Shortcodes
 * Plugin URI: https://github.com/BigIdeaMediaGroup/bimg-wp-shortcodes
 * Description: A set of general plugins for use in BIMG projects.
 * Version: 0.1
 * Author: Big Idea Media Group
 * Author URI: https://github.com/BigIdeaMediaGroup
 * License: GPL2
 *
 * Copyright 2015 Big Idea Media Group
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

foreach ( glob( plugin_dir_path( __FILE__ ) . 'shortcodes/*.php' ) as $file ) {
    include_once $file;
}

// Exempt necessary shortcodes from wptexturize()
add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
    $shortcodes[] = 'bimg_tabs';
    $shortcodes[] = 'bimg_accordion';
    return $shortcodes;
}

// Accordion
$bimg_accordion = new BIMGAccordion;

// Button
$bimg_button = new BIMGButton;

// Grid System
$bimg_row = new BIMGRow;
$bimg_col = new BIMGColumn;

// Section
$bimg_section = new BIMGSection;

// Separator
$bimg_separator = new BIMGSeparator;

// Tab System
$bimg_tabs = new BIMGTabs;

// Dialogs
$bimg_dialog = new BIMGDialog;

// Image System
$bimg_image = new BIMGImage;

// Slider
$bimg_slider = new BIMGSlider;


// Register tinymce button
add_action('admin_head', 'bimg_add_mce_button');

function bimg_add_mce_button() {
    // Check user permissions
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    // Check if WYSIWYG is enabled
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'bimg_add_tinymce_plugin' );
        add_filter( 'mce_buttons', 'bimg_register_mce_button' );
    }
}

// Declare script for new button
function bimg_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['bimg_mce_button'] = plugins_url( '/js/tinymce/plugin.min.js', __FILE__ );
    return $plugin_array;
}

// Register new button in the editor
function bimg_register_mce_button( $buttons ) {
    array_push( $buttons, 'bimg_mce_button' );
    return $buttons;
}

// Register tinymce style
add_action( 'admin_enqueue_scripts', 'register_admin_scripts' );

function register_admin_scripts() {
    wp_enqueue_style( 'bimg_tinymce_plugin', plugins_url( '/css/tinymce-plugin.css', __FILE__ ) );
}

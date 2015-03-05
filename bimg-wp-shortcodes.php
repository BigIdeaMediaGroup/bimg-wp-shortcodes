<?php
/**
 * Plugin Name: BIMG WP Shortcodes
 * Plugin URI: https://github.com/BigIdeaMediaGroup/bimg-wp-shortcodes
 * Description: A set of general plugins for use in BIMG projects.
 * Version: 0.1
 * Author: Will Clardy
 * Author URI: https://github.com/quexxon
 * License: GPL2
 *
 * Copyright 2015 Will Clardy <will@quexxon.net>
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

add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

add_shortcode( 'bimg_row', 'bimg_row_handler' );
add_shortcode( 'bimg_col', 'bimg_column_handler' );

/**
 * Register plugin stylesheets.
 */
function register_plugin_styles() {
    wp_enqueue_script( 'jquery' );
    wp_register_style( 'grid', plugins_url( 'bimg-wp-shortcodes/css/grid.css' ) );
    wp_enqueue_style( 'grid' );
    wp_register_script('matchheight', plugins_url( 'bimg-wp-shortcodes/js/jquery.matchHeight.js' ) );
    wp_enqueue_script( 'matchheight' );
}

/**
 * Create div to wrap responsive grid.
 *
 * @param array $atts Optional. Attributes passed to shortcode by user.
 * @param mixed $content Optional. Content between shortcode tags.
 *
 * @return string $output Returns content wrapped in div.
 */
function bimg_row_handler( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'equal' => false,
        'class' => null,
        'id' => null,
    ), $atts, 'bimg_row' );

    $output = '<div class="section group';
    if ( isset( $a['class'] ) ) {
        $output .= ' ' . $a['class'];
    }
    if ( isset( $a['id'] ) ) {
        $output .= '" id="' . $a['id'];
    }
    $output .= '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    if ( $a['equal'] && isset( $a['id'] ) ) {
        $output .= '<script>jQuery(document).ready(function() {';
        $output .= ' jQuery( " #' . $a['id'] . ' > .col ").matchHeight(); });';
        $output .= '</script>';
    }

    return $output;
}

/**
 * Create a column within [bimg_row].
 *
 * @param array $atts Optional. Attributes passed to shortcode by user.
 * @param mixed $content Optional. Content between shortcode tags.
 *
 * @return string $output Returns content wrapped in div.
 */
function bimg_column_handler( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'columns' => '2',
        'width' => '1',
        'class' => null,
        'id' => null,
    ), $atts, 'bimg_col' );

    $output = '<div class="col span_' . $a['width'] . '_of_' . $a['columns'];
    if ( isset( $a['class'] ) ) {
        $output .= ' ' . $a['class'];
    }
    if ( isset( $a['id'] ) ) {
        $output .= '" id="' . $a['id'];
    }
    $output .= '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}

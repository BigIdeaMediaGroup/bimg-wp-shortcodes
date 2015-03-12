<?php
/*
 * Chris, if you get a look at this file before I talk to you, don't worry
 * about the following TODO list; we'll go over it together in the office.
 *
 * TODO:
 * - add support for the target attribute
 * - add support for the title attribute
 * - add support for CSS align
 *
 * ShortCode Options:
 *		style: "primary" or "standard"
 *      url: "button URL"
 *      class: "extra custom class"
 *		id: "extra id class"
 */
class BIMGButton {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
        add_shortcode( 'bimg_button', array( $this, 'shortcode' ) );
    }

    public function enqueue_shortcode_scripts()
    {
        wp_enqueue_style( 'button', plugins_url( 'bimg-wp-shortcodes/css/button/button.min.css' ) );

    }

    function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'style' => 'primary',
            'url' => null,
            'target' => null,
            'id' => null,
            'class' => null,
        ), $atts, 'bimg_button' );

        return $this->build_button( $a['style'], $a['url'], $a['target'], $a['id'], $a['class'], $content );
    }

    function build_button( $style, $url, $target, $id, $class, $content )
    {
        // Build the button anchor
        $output = '<a class="button';
        if ( $style === 'primary' ) {
            $output .= ' button-primary';
        }
        if ( isset( $class ) && ( $class != '' ) ) {
            $output .= ' ' . $class;
        }
        if ( isset( $id ) && ( $id != '' ) ) {
            $output .= '" id="' . $id;
        }
        if ( isset( $url ) && ( $url != '' ) ) {
            $output .= '" href="'. $url;
        }
        if ( isset( $target ) && ( $url != '' ) ) {
            $output .= '" target="_'. $target;
        }
        $output .= '">';

        // Set the button title
        $output .= $content . '</a>';

        return $output;
    }
}

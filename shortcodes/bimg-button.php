<?php
/*
 * Chris, if you get a look at this file before I talk to you, don't worry
 * about the following TODO list; we'll go over it together in the office.
 *
 * TODO:
 * - add support for the target attribute
 * - add support for the title attribute
 * - add support for CSS align
 * - add error handling
 * - remove inline styling
 * - separate shortcode logic from shortcode definition
 * - bring tinymce plugin up to feature parity
 *
 * ShortCode Options:
 *      shape: rounded | square (default: rounded)
 *      size: small | medium | large (default: medium)
 *      border: true | false (default: false)
 *      text: "button Text"
 *      text_color: "text color"
 *      button_color: "button color"
 *      url: "button URL"
 *      class: "extra custom class"
 */
class BIMGButton {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
        add_shortcode( 'bimg_button', array( $this, 'shortcode' ) );
    }

    public function enqueue_shortcode_scripts()
    {
        wp_enqueue_style( 'pure', plugins_url( 'bimg-wp-shortcodes/css/button/pure.css' ) );
        wp_enqueue_style( 'button', plugins_url( 'bimg-wp-shortcodes/css/button/button.css' ) );

    }

    function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'shape' => 'rounded',
            'size' => 'medium',
            'border' => 'false',
            'text' => null,
            'text_color' => null,
            'button_color' => null,
            'url' => null,
            'id' => null,
            'class' => null,
        ), $atts, 'bimg_button' );

        if ( null != $a['text'] ) {
            $output = '<a ';
            if ( isset( $a['id'] ) && ( $a['id'] != '' ) ) {
                $output .= 'id="' . $a['id'] . '" ';
            }
            $output .= 'class="pure-button '
                . 'button_' . $a['shape']
                . ' button_' . $a['size']
                . ' button_border_' . $a['border'] . ' ';

            if ( isset( $a['class'] ) && ( $a['class'] != '' ) ) {
                $output .= $a['class'] . '" ';
            }
            $output .= 'href="' . $a['url'] . '"';

            $output .= 'style="color:' . $a['text_color'] . '; '
                . 'background-color: ' . $a['button_color'] . ';"';

            $output .= '>';
            $output .= $a['text'];
            $output .= '</a>';
        }
        else
        {
            echo 'Please ensure that you have text for your button';
        }

        return $output;
    }
}

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
       wp_enqueue_style( 'button', plugins_url( 'bimg-wp-shortcodes/css/button/button.css' ) );

    }

    function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
	        'style' => 'primary',
            'text' => null,
            'url' => null,
            'id' => null,
            'class' => null,
        ), $atts, 'bimg_button' );

        if ( null != $a['text'] ) {
           
            
            if ( 'standard' === $a['style'] )
            {
            	$output .= '<a class="button ' . $a['class'] . '"';
            }
            else
            {
	            if ( 'primary' === $a['style'] )
				{
					$output .= '<a class="button button-primary ' . $a['class'] . '"';
				} 
				else
				{
					$output .= '<a class="button button-primary"';
				}
            }
            
            
            if ( isset( $a['id'] ) && ( $a['id'] != '' ) ) {
                $output .= 'id="' . $a['id'] . '" ';
            }

			if (isset( $a['url'] ) && ( $a['url'] != '' ))
			{
            $output .= 'href="'. $a['url'] . '"';
            }
            
            $output .=   '>' . $a['text'] . '</a>';
            		
            		
           // $output .= 'href="' . $a['url'] . '"';
            //$output .= '>';
            //$output .= $a['text'];
            //$output .= '</a>';
        }
        else
        {
            echo 'Please ensure that you have text for your button';
        }

        return $output;
    }
}

<?php
class BIMGSlider {
    public function __construct()
    {
	    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
        add_shortcode( 'bimg_slider', array( $this, 'shortcode' ) );
    }

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'slider_style', plugins_url( 'bimg-wp-shortcodes/css/slider.css' ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'unslider', plugins_url( 'bimg-wp-shortcodes/js/unslider.min.js' ) );
	}

    function shortcode( $atts )
    {
        $a = shortcode_atts( array(
            'id' => null,
            'class' => null,
            'post_type' => null,
            'category' => null,
            'height' => null,
        ), $atts, 'bimg_slider' );

        return $this->build_slider( $a['id'], $a['class'], $a['post_type'], $a['category'] );
    }

    function build_slider( $id, $class, $post_type, $category )
    {	    
        $output  = '<div class="full-slider';
        if ( isset( $class ) && ( $class != '' ) ) {
            $output .= ' ' . $class;
        }
        $output .= '"';
        if ( isset( $id ) && ( $id != '' ) ) {
            $output .= ' id="' . $id . '"';
        }
        $output .= '><ul>';
        
        // Args for the Loop
        $args = array();
		if ( $post_type !== null ) {
			$args['post_type'] = $post_type;
		}
		if ( $category !== null ) {
			$args['category_name'] = $category;
		}
        
        // The Loop
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) {
			$loop->the_post();
			
			$slide_content = apply_filters( 'the_content', get_the_content() );
			$slide_content = str_replace( ']]>', ']]&gt;', $slide_content );
			
			$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			
			$output .= '<li style="background-image: url(\'';
			$output .= $image_attributes[0];
			$output .= '\');">';
			$output .= '<div class="slide-content">' . $slide_content . '</div>';
			$output .= '</li>';
		}
		// Restore the original post data
		wp_reset_postdata();
               
        $output .= '</ul></div>';
        $output .= '<script>jQuery(function() { jQuery(".full-slider").unslider({ speed: 500, delay: 3000, keys: true, dots: true, fluid: true }); });</script>';

        return $output;
    }
}


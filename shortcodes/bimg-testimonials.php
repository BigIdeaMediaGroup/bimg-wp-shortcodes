<?php
class BIMGTestimonial {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
        add_shortcode( 'bimg_testimonial', array( $this, 'shortcode' ) );
    }

    public function enqueue_shortcode_scripts()
    {
	    wp_enqueue_style( 'testimonials', plugins_url( 'bimg-wp-shortcodes/css/testimonials.css' ) );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'wait', plugins_url( 'bimg-wp-shortcodes/js/wait.js' ) );
        wp_enqueue_script( 'testimonials', plugins_url( 'bimg-wp-shortcodes/js/testimonials.js' ) );
        
    }

    public function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'class' => null,
            'id' => null,
            'post_type' => 'testimonial',
            'category_name' => 'testimonials',
        ), $atts, 'bimg_testimonial' );

        return $this->build_testimonial( $a['class'], $a['id'],$a['post_type'],$a['category_name'], $content );
    }

    public function build_testimonial( $class, $id, $post_type, $category, $content )
    {
	    $output = '<div>';
	    
	    
	    
	     // Args for the Loop
        $args = array();
		if ( $post_type !== null ) {
			$args['post_type'] = $post_type;
		}
		if ( $category !== null ) {
			$args['category_name'] = $category;
		}
	   
	    $loop = new WP_Query( $args );   
        while ( $loop->have_posts() ) 
        {
	        echo 'test';
			$loop->the_post();
			$testimonial_content = apply_filters( 'the_content', get_the_content() );
			$output .= '<div class="testimonial_slider">';
			$output .= $testimonial_content;
			$output .= '</div>';
		}
		// Restore the original post data
		wp_reset_postdata();
	   
	    $output .= '</div>';
	    
	    $output .= '<script> jQuery( document ).ready(function() {
	     rotateTestimonials(); 
	     });</script>';
	    return $output;
    }
}


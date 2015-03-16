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
		wp_enqueue_script( 'testimonials', plugins_url( 'bimg-wp-shortcodes/js/testimonials.js' ) );

	}

	public function shortcode( $atts, $content = null )	
	{
		$a = shortcode_atts( array(
			'class' => null,
			'id' => null,
			'height' => 150,
			'width' => 300,
			'delay' => 7000,
			'post_type' => null,
			'category_name' => null,
		), $atts, 'bimg_testimonial' );

		return $this->build_testimonial( $a['class'], $a['id'], $a['height'], $a['width'], $a['delay'], $a['post_type'],$a['category_name'], $content );
	}

	public function build_testimonial( $class, $id, $height, $width, $delay, $post_type, $category, $content )
	{				
	    $output = '<div class="testimonial_container">';
		$args = array(); // Args for the Loop
		if ( $post_type !== null ) {
			$args['post_type'] = $post_type;
		}
		if ( $category !== null ) {
			$args['category_name'] = $category;
		}
	    $loop = new WP_Query( $args );
		while ( $loop->have_posts() ) {

			$loop->the_post();
			$testimonial_content = apply_filters( 'the_content', get_the_content() );
			$testimonial_title = apply_filters( 'the_title', get_the_title() );
			$output .= '<div class="testimonial_slider';
			if ( isset($class) ) {
				$output .= ' ' . $class;
			}
			
			if ( isset($id) ) {
				$output .= '" id="' . $id;
			}
			$output .= '">';
			$output .= '<div class="testimonial_content">';
			$output .= $testimonial_content;
            $output .= '</div>';
            $output .= '<div class="testimonials_title">'; 
            $output .= ' <img src="' . get_site_url() .'/wp-content/plugins/bimg-wp-shortcodes/img/ico-user.png" /> ';
            $output .= $testimonial_title;
			$output .= '</div></div>';

		}
		
		if ( $loop->have_posts() ) {
	    	$output .= '</div>';
			$output .= '<script> jQuery( document ).ready(function() { ';
			$output .= ' rotateTestimonials(' . $delay . ');';
			$output .= ' });</script>';
		}
		

	    wp_reset_postdata();
	    return $output;
	}
}


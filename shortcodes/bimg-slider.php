<?php
class BIMGSlider {
	public function __construct()
	{
	    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
	    add_action( 'init', array( $this, 'create_slide_post_type' ) );
		add_shortcode( 'bimg_slider', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'slider_style', plugins_url( 'bimg-wp-shortcodes/css/slider.css' ) );
		wp_enqueue_script( 'jquery' );
		// wp_enqueue_script( 'event_move', plugins_url( 'bimg-wp-shortcodes/js/jquery.event.move.js' ) );
		// wp_enqueue_script( 'event_swipe', plugins_url( 'bimg-wp-shortcodes/js/jquery.event.swipe.js' ) );
		wp_enqueue_script( 'unslider', plugins_url( 'bimg-wp-shortcodes/js/unslider.min.js' ) );
	}
	
	public function create_slide_post_type() {
        register_post_type( 'bimg_slides',
            array(
                'labels' => array(
                    'name' => __( 'Slides' ),
                    'singular_name' => __( 'Slide' ),
                ),
                'public' => true,
                'rewrite' => array('slug' => 'slides'),
                'supports' => array('title','editor','thumbnail'),
            )
        );
    }

	function shortcode( $atts )
	{
		$a = shortcode_atts( array(
			'id' => null,
			'class' => null,
			'post_type' => 'bimg_slides',
			'category' => null,
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


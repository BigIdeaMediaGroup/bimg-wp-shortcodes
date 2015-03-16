<?php
/**
 * Format content as Image Carousel
 */
class BIMGCarousel {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
        add_action( 'init', array( $this, 'create_carousel_post_type' ) );
        add_shortcode( 'bimg_carousel', array( $this, 'shortcode' ) );
    }

    public function enqueue_shortcode_scripts()
    {
        wp_enqueue_style( 'slick-css', plugins_url( 'bimg-wp-shortcodes/js/slick/slick.css' ) );
        wp_enqueue_style( 'slick-theme-css', plugins_url( 'bimg-wp-shortcodes/js/slick/slick-theme.css' ) );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'slick', plugins_url( 'bimg-wp-shortcodes/js/slick/slick.min.js' ) );
    }

    public function create_carousel_post_type() {
        register_post_type( 'bimg_carousel',
            array(
                'labels' => array(
                    'name' => __( 'Carousels' ),
                    'singular_name' => __( 'Carousel' ),
                ),
                'public' => true,
                'rewrite' => array('slug' => 'carousels'),
                'supports' => array('title','thumbnail'),
            )
        );
    }

    public function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'class' => null,
            'id' => null,
        ), $atts, 'bimg_carousel' );

        return $this->build_carousel( $a['class'], $a['id'] );
    }

    public function build_carousel( $class, $id )
    {
        // Build the carousel query
        $query_args = array(
            'post_type' => 'bimg_carousel',
        );
        $query = new WP_Query( $query_args );

        // Add contents of carousel: The Loop
        if ( $query->have_posts() ) {
            // Opening <div>
            $output = '<div id="';
            if ( isset( $id ) && ( $id != '' ) ) {
                $output .= esc_attr( $id );
            }
            if ( isset( $class ) && ( $class != '' ) ) {
                $output .= '" class="' . esc_attr( $class );
            }
            $output .= '">';

            // Get images from bimg_carousel custom posts
            while ( $query->have_posts() ) {
                $query->the_post();
                $output .= '<div>';
                $output .= get_the_post_thumbnail();
                $output .= '</div>';
            }

            $output .= '</div>';

            // jQuery UI Tabs script
            $output .= '<script>jQuery(document).ready(function() {';
            $output .= ' jQuery( ".' . $class . '").slick({ infinite: true, slidesToShow: 3, slidesToScroll: 3}); });';
            $output .= '</script>';
        } else {
            echo "No Posts Found!";
        }
        wp_reset_postdata();

        return $output;
    }
}


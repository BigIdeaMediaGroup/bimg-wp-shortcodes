<?php
/**
 * Insert section with optional header.
 *
 * @param array $atts Optional. Attributes passed to shortcode by user.
 * @param mixed $content Optional. Content between shortcode tags.
 *
 * @return string $output Returns content wrapped in div.
 */
class BIMGSection {
    public function __construct()
    {
        add_shortcode( 'bimg_section', array( $this, 'shortcode' ) );
    }

    public function build_section( $heading, $class, $id, $content )
    {
        $output = '<section';
        if ( isset( $class ) && ( $class != '' ) ) {
            $output .= ' class="' . $class . '"';
        }
        if ( isset( $id ) && ( $id != '' ) ) {
            $output .= ' id="' . $id . '"';
        }
        $output .= '>';
        if ( isset( $heading ) && ( $heading != '' ) ) {
            $output .= '<h1>' . $heading . '</h1>';
        }
        $output .= do_shortcode( $content );
        $output .= '</section>';

        return $output;
    }

    public function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'heading' => null,
            'background' => null,
            'class' => null,
            'id' => null,
        ), $atts, 'bimg_section' );

        return $this->build_section( $a['heading'], $a['class'], $a['id'], $content );
    }
}


<?php
class BIMGTitle
{
    public function __construct()
    {
        add_shortcode('bimg_title', array( $this, 'shortcode' ));
    }

    function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts(
            array(
            'id' => null,
            'class' => null,
            'h_size' => 2,
            ), $atts, 'bimg_title' 
        );

        return $this->build_separator($a['id'], $a['class'], $a['h_size'], $content);
    }

    function build_separator( $id, $class, $h_size, $content )
    {
        $output = '<div class="title';
        if (isset( $class ) && ( $class != '' ) ) {
            $output .= ' ' . esc_attr($class) . '"';
        }
        if (isset( $id ) && ( $id != '' ) ) {
            $output .= ' id="' . esc_attr($id);
        }
    
        $output .= '">';
        
        $output .= '<h' . $h_size . '>' . $content . '</h' . $h_size . '>';
        $output .= '<div class="title-sep-container"><div class="title-sep"></div></div>';
        
        $output .= '</div>';

        return $output;
    }
}

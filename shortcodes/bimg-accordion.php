<?php
/**
 * Format content as jQuery UI accordion.
 *
 * Content is XML and uses two elements:
 *      <heading>
 *      <content>
 *
 * Each toggle should have a title and contents.
 * The content element may contain shortcodes.
 */
class BIMGAccordion {
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
        add_shortcode( 'bimg_accordion', array( $this, 'shortcode' ) );
    }

    public function enqueue_shortcode_scripts()
    {
        wp_enqueue_style( 'jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-widget' );
        wp_enqueue_script( 'jquery-ui-accordion' );
    }

    public function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'collapsible' => null,
            'height_style' => null,
            'icon' => null,
            'class' => null,
            'id' => null,
        ), $atts, 'bimg_accordion' );

        return $this->build_accordion( $a['collapsible'], $a['height_style'], $a['icon'], $a['class'], $a['id'], $content );
    }

    public function build_accordion( $collapsible, $height_style, $icon, $class, $id, $content )
    {
        preg_match_all("/\[toggle title=['\"](?P<title>[^\]]*)['\"]\](?P<content>[^\[]*)\[\/toggle\]/", $content, $out);

        // Opening <div>
        $output = '<div id="';
        if ( isset( $id ) && ( $id != '' ) ) {
            $output .= $id;
        }
        if ( isset( $class ) && ( $class != '' ) ) {
            $output .= '" class="' . $class;
        }
        $output .= '">';

        // Loop through toggles
        $toggle_number = count( $out['title'] );
        for ( $index = 0; $index < $toggle_number; $index++ ) {
            $output .= '<h3>' . $out['title'][$index] . '</h3>';
            $output .= '<div>' . $out['content'][$index] . '</div>';
        }

        $output .= '</div>';

        // Add jQuery UI Accordion script
        $output .= '<script>jQuery(document).ready(function() {';
        $output .= ' jQuery( " #' . $id . ' ").accordion({';
        if ( $collapsible === 'true' ) {
            $output .= 'collapsible: true,';
        }
        if ( in_array( $height_style, array('auto','fill','content') ) ) {
            $output .= 'heightStyle: "' . $height_style . '",';
        }
        if ( $icon === 'false' ) {
            $output .= 'icons: false,';
        } elseif ( isset( $icon ) && ( $icon != '' ) ) {
            switch ( $icon ) {
            case 'arrow':
                $output .= 'icons: { "header": "ui-icon-arrowthick-1-e", "activeHeader": "ui-icon-arrowthick-1-s" },';
                break;
            case 'carat':
                $output .= 'icons: { "header": "ui-icon-carat-1-e", "activeHeader": "ui-icon-carat-1-s" },';
                break;
            case 'plus':
                $output .= 'icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" },';
                break;
            case 'triangle':
                $output .= 'icons: { "header": "ui-icon-triangle-1-e", "activeHeader": "ui-icon-triangle-1-s" },';
                break;
            case 'circle-arrow':
                $output .= 'icons: { "header": "ui-icon-circle-arrow-e", "activeHeader": "ui-icon-circle-arrow-s" },';
                break;
            case 'circle-plus':
                $output .= 'icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" },';
                break;
            case 'circle-triangle':
                $output .= 'icons: { "header": "ui-icon-circle-triangle-e", "activeHeader": "ui-icon-circle-triangle-s" },';
                break;
            case 'question':
                $output .= 'icons: { "header": "ui-icon-help", "activeHeader": "ui-icon-help" },';
                break;
            }
        }
        $output .= '}); });</script>';

        return $output;
    }
}


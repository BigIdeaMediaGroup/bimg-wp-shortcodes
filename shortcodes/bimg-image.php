<?php
class BIMGImage {
    public function __construct()
    {
        add_shortcode( 'bimg_image', array( $this, 'shortcode' ) );
    }

    function shortcode( $atts )
    {
        $a = shortcode_atts( array(
            'id' => null,
            'class' => null,
            'img_url' => null,
            'alt' => null,
            'scale' => null,
            'url' => null,
            'target' => null,
        ), $atts, 'bimg_image' );

        return $this->build_separator( $a['id'], $a['class'], $a['img_url'], $a['alt'], $a['scale'], $a['url'], $a['target'] );
    }

    function build_separator( $id, $class, $img_url, $alt, $scale, $url, $target )
    {
        $output = '';

        // If a URL is set, wrap the image in an <a> tag.
        if ( isset( $url ) && ( $url != '' ) ) {
            $output .= '<a href="' . $url . '" target="';
            if ( in_array( $target, array( '_blank', '_self' ) ) ) {
                $output .= $target . '">';
            } else {
                $output .= '_self">';
            }
        }

        try {
            $output .= '<img ';
            if ( isset( $id ) && ( $id != '' ) ) {
                $output .= 'id="' . $id . '"';
            }
            if ( isset( $class ) && ( $class != '' ) ) {
                $output .= 'class="' . $class . '"';
            }
            $output .= 'src="' . $img_url . '"';

            // Add width and height attributes if scale is not true
            if ( $scale !== 'true' ) {
                $img = getimagesize( $img_url );
                $img_size = $img[3];
                $output .= ' ' . $img_size;
            }

            if ( isset( $alt ) && ( $alt != '' ) ) {
                $output .= ' alt="' . $alt . '"';
            }

            $output .= '>';
        } catch ( Exception $e ) {
            $output .= '<p style="background: red; color: white;">' . $e->getMessage() . '</p>';
        }

        // Close the anchor tag if necessary.
        if ( isset( $url ) && ( $url != '' ) ) {
            $output .= '</a>';
        }

        return $output;
    }
}


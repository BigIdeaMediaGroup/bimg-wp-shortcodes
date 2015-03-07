<?php
class BIMGSeparator {
	public function __construct()
	{
		add_shortcode( 'bimg_separator', array( $this, 'shortcode' ) );
	}

    function build_separator( $id, $class )
    {
		$output = '<hr';
		if ( isset( $id ) ) {
			$output .= ' id="' . $id . '"';
		}
		if ( isset( $class ) ) {
			$output .= ' class="' . $class . '"';
		}
		$output .= '>';

		return $output;
    }

	function shortcode( $atts )
	{
		$a = shortcode_atts( array(
			'id' => null,
			'class' => null,
		), $atts, 'bimg_separator' );

        return $this->build_separator( $a['id'], $a['class'] );
	}
}

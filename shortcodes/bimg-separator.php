<?php
class BIMGSeparator {
	public function __construct()
	{
		add_shortcode( 'bimg_separator', array( $this, 'shortcode' ) );
	}

	function shortcode( $atts, $content = null ) {
			$a = shortcode_atts( array(
				'class' => null,
			), $atts, 'bimg_separator' );

			$output = '<hr';
			if ( isset($a['class'] ) ) {
				$output .= ' class="' . $a['class'] . '"';
			}

			$output .= '>';
			return $output;
	}
}

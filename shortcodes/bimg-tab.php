<?php
class BIMGTab {
	public function __construct()
	{
		add_shortcode( 'bimg_tab', array( $this, 'shortcode' ) );
	}

	public function build_tab( $class, $id, $content )
	{
		$output = '<div id="' . $id . '">';
		$output .= do_shortcode( $content );
		$output .= '</div>';

		return $output;
	}

	public function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
			'class' => null,
			'id' => null,
		), $atts, 'bimg_tab' );

		return $this->build_tab( $a['class'], $a['id'], $content );
	}
}


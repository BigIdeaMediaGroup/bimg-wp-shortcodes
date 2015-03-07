<?php
/**
 * Create div to wrap responsive grid.
 *
 * @param array $atts Optional. Attributes passed to shortcode by user.
 * @param mixed $content Optional. Content between shortcode tags.
 *
 * @return string $output Returns content wrapped in div.
 */
class BIMGRow {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_row', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'col', plugins_url( 'bimg-wp-shortcodes/css/col.css' ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'matchheight', plugins_url( 'bimg-wp-shortcodes/js/jquery.matchHeight.js' ) );
	}

	public function build_row( $equal, $class, $id, $content )
	{
		$output = '<div class="section group';
		if ( isset( $class ) && ( $class != '' ) ) {
			$output .= ' ' . $class;
		}
		if ( isset( $id ) && ( $id != '' ) ) {
			$output .= '" id="' . $id;
		}
		$output .= '">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		if ( $equal && ( isset( $id ) && ( $id != '' ) ) ) {
			$output .= '<script>jQuery(document).ready(function() {';
			$output .= ' jQuery( " #' . $id . ' > .col ").matchHeight(); });';
			$output .= '</script>';
		}

		return $output;
	}

	public function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
			'equal' => false,
			'class' => null,
			'id' => null,
		), $atts, 'bimg_row' );

		return $this->build_row( $a['equal'], $a['class'], $a['id'], $content );
	}
}


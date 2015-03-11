<?php
/**
 * Create a column within [bimg_row].
 *
 * @param array $atts Optional. Attributes passed to shortcode by user.
 * @param mixed $content Optional. Content between shortcode tags.
 *
 * @return string $output Returns content wrapped in div.
 */
class BIMGColumn {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_col', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'grid', plugins_url( 'bimg-wp-shortcodes/css/grid.css' ) );
	}

	public function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
			'columns' => '2',
			'width' => '1',
			'class' => null,
			'id' => null,
		), $atts, 'bimg_col' );

		return $this->build_column( $a['columns'], $a['width'], $a['class'], $a['id'], $content );
	}

	public function build_column( $columns, $width, $class, $id, $content )
	{
		$output = '<div class="col span_' . $width . '_of_' . $columns;
		if ( isset( $class ) && ( $class != '' ) ) {
			$output .= ' ' . $class;
		}
		if ( isset( $id ) && ( $id != '' ) ) {
			$output .= '" id="' . $id;
		}
		$output .= '">';
		$output .= do_shortcode( $content );
		$output .= '</div>';

		return $output;
	}
}


<?php
class BIMGTabGroup {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_tab_group', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
        wp_enqueue_style( 'jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-tabs' );
	}

	public function build_tab_group( $titles, $class, $id, $content )
	{
		$output = '<div class="';
		if ( isset( $class ) ) {
			$output .= $class;
		}
		if ( isset( $id ) ) {
			$output .= '" id="' . $id;
		}
		$output .= '">';

		$titles = explode( '^', $titles );
        $index = 1;
        $output .= '<ul>';
		foreach ( $titles as $title ) {
			$output .= '<li><a href="#' . $id . '-' . $index . '">';
			$output .= $title;
			$output .= '</a></li>';
            $index++;
		}
        $output .= '</ul>';

		$output .= do_shortcode( $content );

		$output .= '</div>';

		$output .= '<script>jQuery(document).ready(function() {';
		$output .= ' jQuery( " #' . $id . ' ").tabs(); });';
		$output .= '</script>';

		return $output;
	}

	public function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
			'titles' => 'Untitled',
			'class' => null,
			'id' => null,
		), $atts, 'bimg_tab_group' );

		return $this->build_tab_group( $a['titles'], $a['class'], $a['id'], $content );
	}
}


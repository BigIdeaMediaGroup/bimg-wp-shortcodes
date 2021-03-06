<?php
/**
 * Format content as jQuery UI tabs
 *
 * Content is XML and uses two elements:
 *      <heading>
 *      <content>
 *
 * Each tab should have a heading and contents.
 * The content element may contain shortcodes.
 */
class BIMGTabs {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_tabs', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-tabs' );
	}

	public function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
			'class' => null,
			'id' => null,
		), $atts, 'bimg_tabs' );

		return $this->build_tabs( $a['class'], $a['id'], $content );
	}

	public function build_tabs( $class, $id, $content )
	{
		preg_match_all( "/\[tab title=['\"](?P<title>[^\]]*)['\"]\](?P<content>[^\[]*)\[\/tab\]/", $content, $out );

		// Opening <div>
		$output = '<div id="';
		if ( isset( $id ) && ( $id != '' ) ) {
			$output .= esc_attr( $id );
		}
		if ( isset( $class ) && ( $class != '' ) ) {
			$output .= '" class="' . esc_attr( $class );
		}
		$output .= '">';

		// List of tab titles
		$index = 1;
		$output .= '<ul>';
		foreach ( $out['title'] as $title ) {
			$output .= '<li><a href="#' . esc_attr( $id ) . '-' . $index . '">';
			$output .= $title;
			$output .= '</a></li>';
			$index++;
		}
		$output .= '</ul>';

		// The contents
		$index = 1;
		foreach ( $out['content'] as $tab_contents ) {
			$output .= '<div id="' . esc_attr( $id ) . '-' . $index . '">';
			$output .= do_shortcode( $tab_contents );
			$output .= '</div>';
			$index++;
		}

		$output .= '</div>';

		// jQuery UI Tabs script
		$output .= '<script>jQuery(document).ready(function() {';
		$output .= ' jQuery( " #' . $id . ' ").tabs(); });';
		$output .= '</script>';

		return $output;
	}
}


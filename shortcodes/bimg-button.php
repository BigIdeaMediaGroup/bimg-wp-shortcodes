<?php
/*
 * Chris, if you get a look at this file before I talk to you, don't worry
 * about the following TODO list; we'll go over it together in the office.
 *
 * TODO:
 * - add support for the target attribute
 * - add support for the title attribute
 * - add support for CSS align
 *
 * ShortCode Options:
 *		style: "primary" or "standard"
 *      url: "button URL"
 *      class: "extra custom class"
 *		id: "extra id class"
 */
class BIMGButton {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_button', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'button', plugins_url( 'bimg-wp-shortcodes/css/button/button-min.css' ) );

	}

	function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
	        'style' => 'primary',
			'text' => null,
			'url' => null,
			'id' => null,
			'class' => null,
		), $atts, 'bimg_button' );
		return $this->build_separator( $a['style'], $a['text'], $a['url'], $a['id'], $a['class'] );
	}



	function build_separator( $style, $text, $url, $id, $class )
	{
		if ( null != $text ) {

			if ( 'standard' === $style ) {
				$output .= '<a class="button ' . $a['class'] . '"';
			}
			else
			{
	            if ( 'primary' === $style ) {
					$output .= '<a class="button button-primary ' . $class . '"';
				}
				else
				{
					$output .= '<a class="button button-primary"';
				}
			}

			if ( isset( $id ) && ( $id != '' ) ) {
				$output .= 'id="' . $id . '" ';
			}

			if ( isset( $url ) && ( $url != '' ) ) {
				$output .= 'href="'. $url . '"';
			}

			$output .= '>' . $text . '</a>';

			// $output .= 'href="' . $a['url'] . '"';
			//$output .= '>';
			//$output .= $a['text'];
			//$output .= '</a>';
		}
		else
		{
			echo 'Please ensure that you have text for your button';
		}

		return $output;
	}
}

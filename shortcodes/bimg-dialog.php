<?php
/**
 * Create popup dialog boxes connected to buttons.
 *
 * @param array $atts Optional. Attributes passed to shortcode by user.
 * @param mixed $content Optional. Content between shortcode tags.
 *
 * @return string $output Returns content wrapped in div.
 */
class BIMGDialog {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_dialog', array( $this, 'shortcode' ) );
	}

	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'vex-css', plugins_url( 'bimg-wp-shortcodes/css/vex/vex.css' ) );
		wp_enqueue_style( 'vex-css-center', plugins_url( 'bimg-wp-shortcodes/css/vex/vex-theme-center.css' ) );
		wp_enqueue_style( 'vex-css-top', plugins_url( 'bimg-wp-shortcodes/css/vex/vex-theme-top.css' ) );
		wp_enqueue_script( 'vex', plugins_url( 'bimg-wp-shortcodes/js/vex.combined.min.js' ) );
	}

	public function shortcode( $atts, $content = null )
	{
		$a = shortcode_atts( array(
			'location' => null,
			'title' => null,
			'buttontext' => null,
			'class' => null,
			'id' => null,
		), $atts, 'bimg_row' );

		return $this->build_dialog( $a['location'], $a['title'], $a['buttontext'], $a['class'], $a['id'], $content );
	}

	public function build_dialog( $location, $title, $buttontext, $class, $id, $content )
	{
		// Set a random id if none is specified
		if ( isset( $id ) && ( $id === '' ) ) {

			$bytes = openssl_random_pseudo_bytes( 10 );
			$hex = bin2hex( $bytes );
			var_dump( $hex );

			$id = 'button' . $hex;
		}

		// Set the default button text
		if ( ! isset( $buttontext ) or ( $buttontext == '' ) ) {
			$buttontext = 'Learn More';
		}

		$output  = do_shortcode( '[bimg_button id="' . $id . '" class="' . $class . '" style="dark"]' . $buttontext . '[/bimg_button]' );
		$output .= '<script>jQuery(document).ready(function() {
						jQuery("#' . $id . '").click(function(){
							vex.dialog.buttons.YES.text = "Close";
							vex.dialog.alert({
								message: "';
		if ( isset( $title ) && ( $title != '' ) ) {
			$output .= '<h3>' . $title . '</h3>';
		}
								$output .= do_shortcode( $content ) . '",
								className: "vex-theme-' . $location . '"
							});
						});
					});
					</script>';

		return $output;
	}
}


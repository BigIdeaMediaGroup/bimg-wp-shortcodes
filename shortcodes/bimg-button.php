<?php
	/*
		ShortCode Options:
			type: rounded | square (default: rounded)
			size: small | medium | large (default: medium)
			border: true | flase (default: false)	
			text: "button Text"
			text_color: "text color"
			button_color: "button color"
			link: "button Link"
			class: "extra custom class"
			
			
		
		
		
	*/
class BIMGButton {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_button', array( $this, 'shortcode' ) );
	} 
	
	public function enqueue_shortcode_scripts()
	{
		wp_enqueue_style( 'pure', plugins_url( 'bimg-wp-shortcodes/css/button/pure.css' ) );
		wp_enqueue_style( 'button', plugins_url( 'bimg-wp-shortcodes/css/button/button.css' ) );
		

	}

	function shortcode( $atts, $content = null ) {
			$a = shortcode_atts( array(
				'type' => 'rounded',
				'size' => 'medium',
				'border' => 'false',
				'text' => null,
				'text_color' => null,
				'button_color' => null,
				'link' => null,
				'class' => null,
				
			), $atts, 'bimg_button' );

			if (null != $a['text']) //Conditional check for 'text'
			{
			$output = '<a ';
			$output .= 'class="pure-button '
					. 'button_' . $a['type']
					. ' button_' . $a['size']
					. ' button_border_' . $a['border'] . ' ';
								
			$output .= $a['class'] . '"';
			$output .= 'href="' . $a['link'] . '"';
			
			$output .= 'style="color:' . $a['text_color'] . '; ' 
					. 'background-color: ' . $a['button_color'] . ';"';
			
			$output .= '>';
			$output .= $a['text'];
			$output .= '</a>';
			}
			else
			{
				echo 'Please ensure that you have text for your button';
			}
				
			
			return $output;
	}
}
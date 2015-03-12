<?php
	//<code> not pulling from css
	// No font set
	// Will Finish Tomorrow
class BIMGCodeblock {
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_shortcode_scripts' ) );
		add_shortcode( 'bimg_codeblock', array( $this, 'shortcode' ) );
	}
	
	public function enqueue_shortcode_scripts()
    {
        wp_enqueue_style( 'button', plugins_url( 'bimg-wp-shortcodes/css/codeblock.css' ) );

    }

	function build_codeblock( $id, $class, $type, $content )
    {
		
		$output = '<';
        if ( $type === 'block' ) {
            $output .= 'pre><code';
        }
        
        if ($type === 'single') {
	        $output .= 'code';
        }
        
        if ( isset( $class ) && ( $class != '' ) ) {
            $output .= ' class="' . $class . '"';
        }
        
        if ( isset( $id ) && ( $id != '' ) ) {
            $output .= ' id="' . $id . '"';
        }
        $output .= '>' . $content . '</';
      
        if ( $type === 'block' ) {
            $output .= 'pre><code>';
        }
        else
        {
	        $output .= 'code>';
        }
        
		return $output;
    }


	function shortcode( $atts, $content = null )
    {
        $a = shortcode_atts( array(
            'id' => null,
            'class' => null,
            'type' => 'block',
        ), $atts, 'bimg_codeblock' );

        return $this->build_codeblock($a['id'], $a['class'], $a['type'], $content );
    }

    }

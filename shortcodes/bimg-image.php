<?php
class BIMGImage {
	public function __construct()
	{
		add_shortcode( 'bimg_image', array( $this, 'shortcode' ) );
	}

    function build_separator( $id, $class, $imageID , $imageURL )
    {
		
		
		if (isset($imageID))
		{
			//Entered and Image ID
		}
		else
		{
			if (isset($imageURL))
			{
				//Entered and Image URL
			}
			else
			{
				//They Didnt Include A URL or ID
			}
		}
	
		return $output;
    }

	function shortcode( $atts )
	{
		$a = shortcode_atts( array(
			'id' => null,
			'class' => null,
			'image-id' => null,
			'image-url' => null,
		), $atts, 'bimg_image' );
		
		

        return $this->build_separator( $a['id'], $a['class'], $a['image-id'], $a['image-url'] );
	}
}

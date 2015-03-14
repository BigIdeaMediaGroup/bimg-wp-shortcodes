function rotateTestimonials() {

	var elements = document.getElementsByClassName('testimonial_slider'); //creates a nodelist of all the objects mathing the class
	var i = 0; // used to keep track of where we are at throught the loop
	var total = elements.length - 1;

if (total != 0 )
{
	rotate ();
}

	function rotate () {

		if (i <= total) {
			if (i == 0) //the first iteration of a loop, fades out the last item and fades in the first item
			{
				jQuery(elements.item(total)).fadeOut(800); 
				jQuery(elements.item(i)).fadeIn(800).delay();
			}
			else 
			{ // fades out the previous item and fades in the current item
				jQuery(elements.item(i - 1)).fadeOut(800);
				jQuery(elements.item(i)).fadeIn(800);
			}
			i++; 
			setTimeout(rotate , 8000); //waits a set amount of time and then moves on
		}
		else 
		{ //resets the loop using an else so we dont waste unnesseary processing on an if statement every single time
			i = 0;
			rotate ();
		}
		
	}
}
/*
jQuery( ".testimonial_slider" ).each(function( index ) {

			jQuery(this).fadeToggle("slow").delay('1000');
			this.wait(1000);
});

*/

	

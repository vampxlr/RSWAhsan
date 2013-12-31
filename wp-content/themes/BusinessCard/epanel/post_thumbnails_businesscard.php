<?php 

/* sets predefined Post Thumbnail dimensions */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	
	//icon image size
	add_image_size( 'icons', 32, 32, true );
		
};
/* --------------------------------------------- */

?>
<?php
/**
 * Generate Slideshow .
 *
 * @ [slidegallery width=100 height=100 link=(lightbox,direct,none)]
 */
function mSlideGallery($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '1',
		"lightbox" => 'false',
		"crop" => 'true',
		"height" => '434',
		"width" => '620',
		"type" => 'Fill',
		"resize" => true,
		"title" => 'false'
	), $atts));
	$withplus=$width+20;
	$resize_image=false;
	if ($resize=="true") { $resize_image=true; }
	$quality=THEME_IMAGE_QUALITY;
	$link_end="";
	$lightbox_link="";
	$crop_image= " ,imageCrop: false";
	$lightbox_link = " ,lightbox: false";
	$portfolio_type= " ,lightbox: false ,imageCrop: true";
	
	if ($type=="Normal") $portfolio_type= " ,lightbox: false ,imageCrop: false";
	if ($type=="Fill") $portfolio_type= " ,lightbox: false ,imageCrop: true";
	if ($type=="Normal-plus-Lightbox") $portfolio_type= " ,lightbox: true ,imageCrop: false";
	if ($type=="Fill-plus-Lightbox") $portfolio_type= " ,lightbox: true ,imageCrop: true";
	
	//echo $type, $portfolio_type;
	
	$rootpath= get_stylesheet_directory_uri();
	$images =& get_children( array( 
						'post_parent' => get_the_id(),
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);
	
	if ( $images ) 
	{
	$output = '<div class="clear"></div>';
		$output .= '<div id="galleria">';
			foreach ( $images as $id => $image ) {
			$attatchmentID = $image->ID; 
			$imagearray = wp_get_attachment_image_src( $attatchmentID , 'full', false);
			$imageURI = $imagearray[0];
			$imageID = get_post($attatchmentID);
			$imageTitle = $imageID->post_title;
			$imageCaption = $imageID->post_excerpt;
			if ($title=="false") { $imageTitle=""; }
			//$output .= '<a href="' . $imageURI . '" title="'. $imageTitle .'">';

					$output .= showimage (
						$imageURI,
						$link="",
						$resize=false,
						$height,
						$width,
						$quality=THEME_IMAGE_QUALITY, 
						$crop=1,
						$imageTitle="",
						$class=""
						);
			//$output .='</a>';
			}
		$output .='</div>';
	$output .='<div class="clear"></div>';
    $output .= '<script type="text/javascript">';
	$output .= 'jQuery(document).ready(function () {';
	$output .= 'var mtheme_galleria_uri="' . $rootpath . '/js/galleria/"; ';
    $output .= "Galleria.loadTheme(mtheme_galleria_uri+'galleria.classic.js'); ";
    $output .= "jQuery('#galleria').galleria({ autoplay: 5000 , preload: 3, fullscreenDoubleTap: true, transitionSpeed: 600, thumbCrop: true,transition: 'fadeslide', showCounter: false, width: ".$width.", height: ". $height . $portfolio_type ." }); ";
	$output .= '});';
    $output .= '</script>';
	return '[raw]' . $output . '[/raw]';
	}	
}
add_shortcode("galleria", "mSlideGallery");



function mNivoSlides($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '1',
		"lightbox" => 'false',
		"crop" => 'true',
		"height" => '300',
		"width" => '650',
		"resize" => true,
		"title" => 'false'
	), $atts));
	$withplus=$width+20;
	$resize_image=false;
	if ($resize=="true") { $resize_image=true; }
	$quality=THEME_IMAGE_QUALITY;
	$link_end="";
	$lightbox_link="";
	
	$cssheight= $height . "px";
	$csswidth= $width . "px";
	
	if ($height==0) { $cssheight="50px"; }
	
	$crop_image= " ,imageCrop: true";
	if ($lightbox == "true" ) { $lightbox_link = " ,lightbox: true"; }
	$rootpath= get_stylesheet_directory_uri();
	$images =& get_children( array( 
						'post_parent' => get_the_id(),
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);
	
	if ( $images ) 
	{
	
	$nivoID = "sliderID" . dechex(time()).dechex(mt_rand(1,65535));
	
$mtheme_path=MTHEME_PATH;
$output = <<<HTML
[raw]
<script type='text/javascript'>
/*<![CDATA[*/
    jQuery(window).load(function() {
        jQuery('#{$nivoID}').nivoSlider({
        effect:'fade', // Specify sets like: 'fold,fade,sliceDown'
        slices:10, // For slice animations
        boxCols: 10, // For box animations
        boxRows: 10, // For box animations
        animSpeed:500, // Slide transition speed
        pauseTime:6000, // How long each slide will show
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
		});
    });

/*]]>*/
</script>
<style type='text/css'>
/*<![CDATA[*/
#{$nivoID} { position:relative; height:{$cssheight} !important; background: url({$mtheme_path}/images/preloaders/preloader.png) no-repeat 50% 50%; margin: 0 0 10px 0; }
#{$nivoID} img { position:absolute;top:0px;left:0px;display:none;}
#{$nivoID} a { border:0;	display:block;}
/*]]>*/
</style>

<div class="clear"></div>
<div id="nivoContainer">
<div id="{$nivoID}" class="nivoSlider">
HTML;
			foreach ( $images as $id => $image ) {
			$attatchmentID = $image->ID; 
			$imagearray = wp_get_attachment_image_src( $attatchmentID , 'blog-post', false);
			$imageURI = $imagearray[0];
			$imageID = get_post($attatchmentID);
			$imageTitle = $imageID->post_title;
			$imageCaption = $imageID->post_excerpt;
			if ($title=="false") { $imageTitle=""; }
			//$output .= '<a href="' . $imageURI . '" title="'. $imageTitle .'">';
			$output .= showimage (
				$imageURI,
				$link="",
				$resize=false,
				$height,
				$width,
				$quality=THEME_IMAGE_QUALITY, 
				$crop=1,
				$imageTitle="",
				$class=""
				);
			//$output .='</a>';
			}
$output .= <<<HTML
</div>
</div>
<div class="clear"></div>
[/raw]
HTML;
	return $output;
	}	
}
add_shortcode("nivoslides", "mNivoSlides");

/**
 * Flexi Slideshow .
 *
 * @ [flexislideshow link=(lightbox,direct,none)]
 */
function mFelxiSlideshow($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '1',
		"lightbox" => 'false',
		"crop" => 'true',
		"height" => '434',
		"width" => '650',
		"type" => 'Fill',
		"resize" => true,
		"title" => 'false'
	), $atts));
	$withplus=$width+20;
	$resize_image=false;
	if ($resize=="true") { $resize_image=true; }
	$quality=THEME_IMAGE_QUALITY;
	$link_end="";
	$lightbox_link="";
	$crop_image= " ,imageCrop: false";
	$lightbox_link = " ,lightbox: false";
	$portfolio_type= " ,lightbox: false ,imageCrop: true";
	
	if ($type=="Normal") $portfolio_type= " ,lightbox: false ,imageCrop: false";
	if ($type=="Fill") $portfolio_type= " ,lightbox: false ,imageCrop: true";
	if ($type=="Normal-plus-Lightbox") $portfolio_type= " ,lightbox: true ,imageCrop: false";
	if ($type=="Fill-plus-Lightbox") $portfolio_type= " ,lightbox: true ,imageCrop: true";
	
	//echo $type, $portfolio_type;
	
	$rootpath= get_stylesheet_directory_uri();
	$images =& get_children( array( 
						'post_parent' => get_the_id(),
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);

	$flexID = "ID" . dechex(time()).dechex(mt_rand(1,65535));
						
	if ( $images ) 
	{
	$output = '
	<div class="spaced-wrap clearfix">
		<div class="flexslider-container-page flexislider-container-'.$flexID.' clearfix">
			<div id="flex'.$flexID.'" class="flexslider">
			<ul class="slides">';
			foreach ( $images as $id => $image ) {
			$attatchmentID = $image->ID; 
			$imagearray = wp_get_attachment_image_src( $attatchmentID , 'blog-full', false);
			$imageURI = $imagearray[0];
			$imageID = get_post($attatchmentID);
			$imageTitle = $imageID->post_title;
			$imageCaption = $imageID->post_excerpt;
			if ($title=="false") { $imageTitle=""; }
			$output .= '<li>';

					$output .= showimage (
						$imageURI,
						$link="",
						$resize=false,
						$height,
						$width,
						$quality=THEME_IMAGE_QUALITY, 
						$crop=1,
						$imageTitle="",
						$class=""
						);
			$output .='</li>';
			}
		$output .='</ul></div></div><div class="clear"></div></div>';
		$output .='
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery("#flex'.$flexID.'").flexslider({
			animation: "slide",
			slideshow: true,
			pauseOnAction: true,
			pauseOnHover: false,
			controlsContainer: "flexslider-container-'.$flexID.'"
		});
	});
</script>
';
	return '[raw]' . $output . '[/raw]';
	}	
}
add_shortcode("flexislideshow", "mFelxiSlideshow");
?>
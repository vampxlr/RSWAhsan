<?php
$image_link=featured_image_link($post->ID);
$bg_choice= get_post_meta($post->ID, MTHEME . '_meta_background_choice', true);
$custom_bg_image_url= get_post_meta($post->ID, MTHEME . '_meta_background_url', true);
$fullscreen_slideshowpost= get_post_meta($post->ID, MTHEME . '_slideshow_bgfeaturedpost', true);
$default_bg= of_get_option('general_background_image');

	// Check custom posts
	$custom_post = get_post_custom(get_the_ID());
	$custom_post_bg_choice=$custom_post["portfolio_background_choice"][0];
	if ( $custom_post_bg_choice <> "" ) $bg_choice = $custom_post_bg_choice;
	
	if ($custom_post_bg_choice=="Use custom background") {
		$custom_portfolio = get_post_custom(get_the_ID());
		$custom_portfolio_url = $custom_portfolio["portfolio_custombg"][0];
		if ($custom_portfolio_url <> "" ) { $custom_bg_image_url=$custom_portfolio_url; }
	}

function DisplayBGImage ($imagelink) {
	echo '<script type="text/javascript">';
	echo 'jQuery.backstretch("'.$imagelink.'", {  speed: 1000	});';
	echo '</script>';
	}
	
if ($fullscreen_slideshowpost != "none" && $fullscreen_slideshowpost<>"" && isSet($fullscreen_slideshowpost) ) {
	$bg_choice="Fullscreen Post Slideshow";
}

if ( is_archive() ) $bg_choice="default";

if ($bg_choice<>"none") {

	switch ($bg_choice) {
		case "Fullscreen Post Slideshow" :
		case "Background Slideshow" :
		case "Image Attachments Slideshow" :
			require (TEMPLATEPATH . "/includes/background/slideshow_bg.php");
		break;
		case "Use featured image" :
			DisplayBGImage ($image_link);
		break;
		case "Use custom background" :
			DisplayBGImage ($custom_bg_image_url);
		break;
		case "Theme options set image" :
			DisplayBGImage ($default_bg);
		break;
		default :
			if ($default_bg) {
				DisplayBGImage ($default_bg);
			}
		break;
	}
}
?>
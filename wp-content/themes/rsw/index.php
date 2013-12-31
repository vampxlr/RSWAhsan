<?php
//Defined in Theme Framework Functions
// Main page
$featured_page=of_get_option('options_featured_page');
$newsboxfeed_status=of_get_option('newsbox_toggle');
$custom = get_post_custom($featured_page);

$fullscreen_type = $custom["fullscreen_type"][0];

global $fullscreen_status,$fullscreen_type;
$fullscreen_status="enable";

switch ($fullscreen_type) {	
	
	case "Slideshow" :
	case "Slideshow-plus-captions" :
		if ($newsboxfeed_status) {
			JSCycleScript();
			add_action('wp_head', 'NewsSlider_init');
		}
		LoadSuperSizedScripts();
		require_once (MTHEME_INCLUDES . 'featured/supersized.php');
	break;
	
	case "Fullscreen-Video" :
		require_once (MTHEME_INCLUDES . 'featured/fullscreenvideo.php');
	break;
	default:
		if ($newsboxfeed_status) {
			JSCycleScript();
			add_action('wp_head', 'NewsSlider_init');
		}
		LoadSuperSizedScripts();
		$fullscreen_type="Slideshow";
		require_once (MTHEME_INCLUDES . 'featured/supersized.php');
	break;
}
?>
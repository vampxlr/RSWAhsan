<?php
//Hrule [hr]
function mHr( $atts, $content = null ) {
   return '<div class="hrule"></div>';
}
add_shortcode('hr', 'mHr');

//Hrule [hr]
function mHr_top( $atts, $content = null ) {
   return '<div class="hrule top"><a href="#">'.__('Top','mthemelocal').'</a></div>';
}
add_shortcode('hr_top', 'mHr_top');

//Hrule [hr]
function mHr_padding( $atts, $content = null ) {
   return '<div class="hr_padding"></div>';
}
add_shortcode('hr_padding', 'mHr_padding');

function mtheme_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');

add_filter('the_content', 'mtheme_formatter', 99);
?>
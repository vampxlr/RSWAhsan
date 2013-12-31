<?php
require_once( '../../../../wp-load.php' );
Header("Content-type: text/css");

$theme_imagepath =  get_template_directory_uri() . '/images/';

//Background Overlay
$background_overlay=of_get_option('general_background_overlay');
if ( $background_overlay ) { echo '.background-fill { background: transparent url('.$theme_imagepath. 'overlays/'.$background_overlay.'.png) repeat; } '; } else { echo ' .background-fill {background:none;}'; }


function ApplyFont ( $fontName , $fontClasses ) {

	$got_font=of_get_option($fontName, $fontClasses);
	
	if ($got_font) {
		$font_pieces = explode(":", $got_font);
		$font_name = $font_pieces[0];
		echo $fontClasses . "{ font-family:'" . $font_name . "'; }";
	}

}

$heading_classes='
h1,
h2,
h3,
h4,
h5,
h6';

$page_heading_classes='
.entry-content h1,
.entry-content h2,
.entry-content h3,
.entry-content h4,
.entry-content h5,
.entry-content h6,
ul#portfolio-tiny h4,
ul#portfolio-small h4, ul#portfolio-large h4,
.entry-post-title h2,
.news-text a
';
//Font

ApplyFont ( "heading_font" , $heading_classes );
ApplyFont ( "page_headings" , $page_heading_classes );
ApplyFont ( "menu_font" , ".homemenu" );
ApplyFont ( "super_title" , ".slideshow_title" );


//Photomenu color
$photomenu_color=of_get_option('photomenu_color');
$photomenu_rgb=hex2RGB($photomenu_color,true);

if ($photomenu_color) {
echo "
.homemenu ul li { 
	background: ".$photomenu_color.";
	background: rgba(".$photomenu_rgb.",0.7);
	}
";
}

$photomenusubcat_color=of_get_option('photomenusubcat_color');
if ($photomenusubcat_color) {
echo '.homemenu ul ul li { background:'.$photomenusubcat_color.'; }';
}

$slideshow_arrowbg=of_get_option('slideshow_arrowbg');
if ($slideshow_arrowbg) {
echo '#prevslide, #nextslide { background-color:'.$slideshow_arrowbg.'; }';
}

//Progress Bar
$slideshow_transbar=of_get_option('slideshow_transbar');
$slideshow_transbar_rgb=hex2RGB($slideshow_transbar,true);

if ($slideshow_transbar) {
echo "
#progress-bar {
	background:".$slideshow_transbar.";
	background: linear-gradient(left, rgba(0,0,0,0) 0%,rgba(".$slideshow_transbar_rgb.",0.65) 100%);
	background: -moz-linear-gradient(left, rgba(0,0,0,0) 0%, rgba(".$slideshow_transbar_rgb.",0.65) 100%);
	background: -ms-linear-gradient(left, rgba(0,0,0,0) 0%,rgba(".$slideshow_transbar_rgb.",0.65) 100%);
	background: -o-linear-gradient(left, rgba(0,0,0,0) 0%,rgba(".$slideshow_transbar_rgb.",0.65) 100%);
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(".$slideshow_transbar_rgb.",0.65)));
	background: -webkit-linear-gradient(left, rgba(0,0,0,0) 0%,rgba(".$slideshow_transbar_rgb.",0.65) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='".$slideshow_transbar."', endColorstr='".$slideshow_transbar."',GradientType=1 );
}
";
}

$slideshow_titlecolor=of_get_option('slideshow_titlecolor');
if ($slideshow_titlecolor) {
echo '.slideshow_title { color:'.$slideshow_titlecolor.'; }';
}

$slideshow_captiontext=of_get_option('slideshow_captiontext');
if ($slideshow_captiontext) {
echo '.slideshow_caption { color:'.$slideshow_captiontext.'; }';
}

$slideshow_captionbg=of_get_option('slideshow_captionbg');
if ($slideshow_captionbg) {
echo '.slideshow_caption { background:'.$slideshow_captionbg.'; }';
}

$photomenu_hover_color=of_get_option('photomenu_hover_color');
if ($photomenu_hover_color) echo '.homemenu ul li:hover>a,.homemenu ul ul li:hover>a {background:'.$photomenu_hover_color.';}';

$photomenu_link_color=of_get_option('photomenu_link_color');
if ($photomenu_link_color) echo '.homemenu a,.homemenu ul li strong {color:'.$photomenu_link_color.' !important;}';

$photomenu_desc_color=of_get_option('photomenu_desc_color');
if ($photomenu_desc_color) echo '.homemenu ul li span {color:'.$photomenu_desc_color.';}';

$photomenu_subcat_hover_color=of_get_option('photomenu_subcat_hover_color');
if ($photomenu_subcat_hover_color) echo '.homemenu ul ul li {background:'.$photomenu_subcat_hover_color.';}';

$content_pagebg=of_get_option('content_pagebg');
if ($content_pagebg) {
echo '.contents-wrap, .fullpage-contents-wrap, .page-contents-wrap,.mcycletextwrap { background-color:'.$content_pagebg.'; }';
echo '.blogseperator { background-color:'.$content_pagebg.'; border:none;}';
}

$content_titlebg=of_get_option('content_titlebg');
if ($content_titlebg) {
echo 'h1.entry-title { background-color:'.$content_titlebg.'; }';
}

$content_titlelinks=of_get_option('content_titlelinks');
if ($content_titlelinks) {
echo 'ul#portfolio-tiny h4 a, ul#portfolio-small h4 a, ul#portfolio-large h4 a, .entry-post-title h2 a, .news-text a { color:'.$content_titlelinks.'; }';
}

$content_titlehover=of_get_option('content_titlehover');
if ($content_titlehover) {
echo 'ul#portfolio-tiny h4 a:hover, ul#portfolio-small h4 a:hover, ul#portfolio-large h4 a:hover, .entry-post-title h2 a:hover, .news-text a:hover { color:'.$content_titlehover.'; }';
}

$content_titles=of_get_option('content_titles');
if ($content_titles) {
echo '
.entry-content h1,
.entry-content h2,
.entry-content h3,
.entry-content h4,
.entry-content h5,
.entry-content h6,
.mcycletextwrap h3,
ul.tabs li a
{ color:'.$content_titles.'; }';
}

$content_text=of_get_option('content_text');
if ($content_text) {
echo '
.entry-content p,
.news-text,
.work-details p
{ color:'.$content_text.'; }';
}


$sidebar_bg=of_get_option('sidebar_bg');
if ($sidebar_bg) {
echo '.sidebar-wrap, .sidebar-wrap-single { background-color:'.$sidebar_bg.'; }';
}

$sidebar_title=of_get_option('sidebar_title');
if ($sidebar_title) {
echo '.sidebar h3 { color:'.$sidebar_title.'; }';
}

$pagination_bg=of_get_option('pagination_bg');
if ($pagination_bg) {
echo '.pagenavi { background-color:'.$pagination_bg.'; }';
}

$blog_allowedtags=of_get_option('blog_allowedtags');
if ($blog_allowedtags) {
echo '.form-allowed-tags { display:none; }';
}

$footer_copyrightbg=of_get_option('footer_copyrightbg');
if ($footer_copyrightbg) {
echo '#fullscr-copyright li { background-color:'.$footer_copyrightbg.'; }';
}

$footer_copyrighttext=of_get_option('footer_copyrighttext');
if ($footer_copyrighttext) {
echo '#fullscr-copyright li { color:'.$footer_copyrighttext.'; text-shadow:none; }';
}

$submenu_hover=of_get_option('submenu_hover');
if ($submenu_hover) {
echo '.menu ul {left:auto;}';
}
?>
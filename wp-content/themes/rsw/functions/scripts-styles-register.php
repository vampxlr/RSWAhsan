<?php
//Common Scripts
function LoadCommonScripts() {
		global $is_IE;
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', MTHEME_JS . '/jquery-1.7.1.min.js', false, null ,false);
		wp_enqueue_script( 'superfish', MTHEME_JS . '/menu/superfish.js?v=1.0', array( 'jquery' ),null, true );
		wp_enqueue_script( 'qtips', MTHEME_JS . '/jquery.tipsy.js?v=1.0', array( 'jquery' ),null, true );
		wp_enqueue_script( 'prettyPhoto', MTHEME_JS . '/jquery.prettyPhoto.js?v=1.0', array( 'jquery' ),null, true );
		wp_enqueue_script( 'twitter', MTHEME_JS . '/jquery.tweet.js?v=1', array( 'jquery' ),null, true );
		wp_enqueue_script( 'jPlayerJS', MTHEME_JS . '/html5player/jquery.jplayer.min.js', array( 'jquery' ),null, true );
		if($is_IE) {
			wp_enqueue_script( 'ResponsiveJQIE', MTHEME_JS . '/css3-mediaqueries.js', array('jquery'),null, true );
		}
		wp_enqueue_script( 'custom', MTHEME_JS . '/common.js?v=1.0', array( 'jquery' ),null, true );
}
//Common Styles
function LoadCommonStyles() {
		wp_enqueue_style( 'MainStyle', MTHEME_STYLESHEET . '/style.css',false, 'screen' );
		wp_enqueue_style( 'Droid_Sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700' );
		wp_enqueue_style( 'Droid_Serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic' );
		wp_enqueue_style( 'Open_Sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700' );
		wp_enqueue_style( 'css_jplayer', MTHEME_ROOT . '/css/html5player/jplayer.dark.css', array( 'MainStyle' ), false, 'screen' );
		wp_enqueue_style( 'PrettyPhoto', MTHEME_CSS . '/prettyPhoto.css', array( 'MainStyle' ), false, 'screen' );
		wp_enqueue_style( 'navMenuCSS', MTHEME_CSS . '/menu/superfish.css', array( 'MainStyle' ), false, 'screen' );	
}
//Dark Theme
function DarkTheme() {
	wp_enqueue_style( 'DarkStyle', MTHEME_STYLESHEET . '/style_dark.css', array( 'MainStyle' ), false, 'screen' );
}
//JwScripts
function JWPlayerScripts() {
wp_enqueue_script( 'jwplayer', MTHEME_JS . '/jwplayer/jwplayer.js', array( 'jquery' ),null, true );
}	
//Flexisliderscripts
function FlexiSlideScripts () {
wp_enqueue_script( 'flexislider', MTHEME_JS . '/flexislider/jquery.flexslider.js', array('jquery') , '',true );
wp_enqueue_style( 'flexislider_css', MTHEME_ROOT . '/css/flexislider/flexslider-page.css', false, 'screen' );
}
//Jquery Cycle
function JSCycleScript () {
wp_enqueue_script( 'jqcycle', MTHEME_JS . '/jquery.cycle.all.js', array( 'jquery' ),null, true );
}
//Supersized
function LoadSuperSizedScripts () {
	wp_enqueue_style( 'Berkshire', 'http://fonts.googleapis.com/css?family=Berkshire+Swash' );
	wp_enqueue_script( 'supersized', MTHEME_JS . '/supersized/supersized.3.2.7.min.js', array( 'jquery' ), '' );
	wp_enqueue_script( 'supersizedShutter', MTHEME_JS . '/supersized/supersized.shutter.js', array( 'jquery' ), '' );
	wp_enqueue_script( 'jQEasing', MTHEME_JS . '/jquery.easing.min.js', array( 'jquery' ), '' );
	wp_enqueue_style( 'SupersizedCSS', MTHEME_CSS . '/supersized/supersized.css' );
	wp_enqueue_style( 'SupersizedShutterCSS', MTHEME_CSS . '/supersized/supersized.shutter.css' );
	}
//NewsSlider
function NewsSlider_init() {
$newsbox_timeout= of_get_option('newsbox_timeout');
?>
<script type="text/javascript">
var mtheme_uri="<?php echo get_stylesheet_directory_uri(); ?>";
jQuery(document).ready(function(){
	jQuery('.newsslides').cycle({
		next:   '.newsnext',
		prev:   '.newsprev',
		speed:   500,
		timeout: <?php echo $newsbox_timeout; ?>,
		pause: true
	});
	jQuery(".mcycletextwrap").css({"left":"auto","right":"130px"});
});
</script>
<?php
}
//JqueryUI
function jQueryUIinit() {
?>
<script type="text/javascript">
jQuery(function() {
	jQuery("ul.tabs").tabs("div.panes > div");
	jQuery(".accordion-tabs").tabs(".pane", {tabs: 'h5', effect: 'slide'});
	
});
</script>
<?php
}
function JqueryUIScript() {
	wp_enqueue_script( 'jqueryUI', MTHEME_JS . '/jquery.tools.tabs.min.js?v=1', array('jquery') ,null, true );
	add_action('wp_head', 'jQueryUIinit');
}
//Contact Form
function contactFormScript() {
wp_enqueue_script( 'contactform', MTHEME_JS . '/contact.js', array( 'jquery' ),null, false );
}
//BackStretch Imager
function backstretchScript() {
wp_enqueue_script( 'backstretch', MTHEME_JS . '/jquery.backstretch.min.js', array('jquery'), '' );
}
//Responsive
function ResponsiveStyle() {
wp_enqueue_style( 'Responsive', MTHEME_CSS . '/responsive.css',array( 'MainStyle' ),false, 'screen' );
}
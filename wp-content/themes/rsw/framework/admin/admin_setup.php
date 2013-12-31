<?php
add_filter( 'option_posts_per_page', 'mtheme_tax_filter_posts_per_page' );
function mtheme_tax_filter_posts_per_page( $value ) {
    return (is_tax('types')) ? 1 : $value;
}
//@ Wordpress 3 Features
//@ This theme uses wp_nav_menu() in one location.
if (function_exists('register_nav_menus')) {
    add_action('init', 'register_wp_menu');
    function register_wp_menu() {
        register_nav_menu( 'top_menu', 'Main Menu' );
    }
}
//@ Page Menu
function mtheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mtheme_page_menu_args' );

//@Enable Backgrounds
if (function_exists('add_custom_background')) {
	add_custom_background();
}
//@Add Feed link
add_theme_support( 'automatic-feed-links' );
/*-------------------------------------------------------------------------*/
/* Inject Theme path to JS scripts */
/*-------------------------------------------------------------------------*/
function path_to_js_script() { 
	// Load only if its theme options
	if ('admin.php' == basename($_SERVER['PHP_SELF'])) {
	?>
		<script type="text/javascript">
		var mtheme_uri="<?php echo get_stylesheet_directory_uri(); ?>";
		</script>
		<?php
	}
}
add_action('admin_head', 'path_to_js_script');
/*-------------------------------------------------------------------------*/
/* Show Activation Message */
/*-------------------------------------------------------------------------*/
function mtheme_activate_head() { 	
	?>
    <script type="text/javascript">
    jQuery(function(){
	var message = '<p><?php echo MTHEME_NAME; ?> comes with an <a href="<?php echo admin_url('admin.php?page=options-framework'); ?>">options panel</a> for configuration. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
}
add_action('admin_head', 'mtheme_activate_head'); 
/*-------------------------------------------------------------------------*/
/* Enable shortcodes to Text Widgets */
/*-------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');
/*-------------------------------------------------------------------------*/
/* Excerpt Lenght */
/*-------------------------------------------------------------------------*/
function new_excerpt_length($length) {
	return 80;
}
add_filter('excerpt_length', 'new_excerpt_length');
/*-------------------------------------------------------------------------*/
/* Add default posts and comments RSS feed links to head */
/*-------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );
/*-------------------------------------------------------------------------*/
/* Add Post Thumbnails */
/*-------------------------------------------------------------------------*/
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	// This theme supports Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio') );
	set_post_thumbnail_size( 150, 150, true ); // default thumbnail size
	add_image_size('blog-post', 650, 300,true); // Blog post cropped
	add_image_size('blog-full', 650, '',true); // Blog post images
	add_image_size('blog-related', 134, 90,true); // Blog post related images
	add_image_size('news-thumbnail', 120, 100,true); // Blog post related images
	add_image_size('slideshow-thumbnails', 80, 43,true); // Slideshow Thumbnails
	add_image_size('portfolio-related', 120, 64,true); // Sidebar Related image
	add_image_size('fullscreen-thumbnails', 60, 60,true); // Sidebar Thumbnails
	add_image_size('portfolio-tiny', 75, 75,true); // Sidebar Thumbnails
	add_image_size('portfolio-small', 256, 160,true); // Portfolio Small
	add_image_size('portfolio-medium', 320, 200,true); // Portfolio Medium
	add_image_size('portfolio-large', 480, 300,true); // Portfolio Large
	add_image_size('portfolio-full', 960, '',true); // Portfolio Full
	add_image_size( 'fullwidth', 1000, '', true ); // Fullsize
	add_image_size( 'fullsize', '', '', true ); // Fullsize
}
/*-------------------------------------------------------------------------*/
/* Internationalize for easy localizing */
/*-------------------------------------------------------------------------*/
load_theme_textdomain( 'mthemelocal', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );
/*-------------------------------------------------------------------------*/
/* Enqueue comment reply script */
/*-------------------------------------------------------------------------*/
function mtheme_comment_reply() {
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action('get_header', 'mtheme_comment_reply');
/*-------------------------------------------------------------------------*/
/* Admin JS and CSS */
/*-------------------------------------------------------------------------*/
function mtheme_adminscripts() {

	// Load if Theme Options or if in Post Edit mode
	$file_dir=get_template_directory_uri();
	
	if ( 'edit.php' == basename($_SERVER['PHP_SELF']) ) {
		wp_enqueue_style("styles", $file_dir ."/framework/admin/css/style.css", false, "1.0", "all");
		
	}
	
	// Load only if in a Post or Page Manager	
	if ('edit.php' == basename($_SERVER['PHP_SELF'])) {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script("post-sorter", $file_dir."/framework/admin/js/post-sorter.js", array( 'jquery' ), "1.0");
	}

	// Load only in Edit mode of Post
	if ('post-new.php' == basename($_SERVER['PHP_SELF']) || 'post.php' == basename($_SERVER['PHP_SELF'])) {
		wp_enqueue_script("postmeta", $file_dir."/framework/admin/js/postmetaboxes.js?ver=1.0", array( 'jquery' ), "1.0",false);
	}
}
add_action('admin_menu', 'mtheme_adminscripts');
?>
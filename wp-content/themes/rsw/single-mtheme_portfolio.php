<?php
/*
 Single Portfolio Page
*/
?>
<?php
wp_enqueue_script( 'flexislider', MTHEME_JS . '/flexislider/jquery.flexslider-min.js', array('jquery') , '',true );
wp_enqueue_style( 'flexislider_css', MTHEME_ROOT . '/css/flexislider/flexslider-page.css', false, 'screen' );
function flexislideshow_init() {
	?>
<!-- Flexi Slider init -->
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider({
			animation: "slide",
			slideshow: true,
			pauseOnAction: true,
			pauseOnHover: false,
			controlsContainer: "flexslider-container-page"
		});
	});
</script>
	<?php
}
add_action('wp_footer', 'flexislideshow_init',20);
?>
<?php get_header(); ?>
<?php
/**
*  Portfolio Loop
 */
?>
<div class="contents-wrap float-left two-column">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content-wrapper">

					<?php
					if ( post_password_required() ) {
						
						echo '<div id="password-protected">';
						if (DEMO_STATUS) { echo '<p><h2>DEMO Password is 1234</h2></p>'; }
						echo get_the_password_form();
						echo '</div>';
						
						} else {
					?>
					<div class="entry-wrapper">
					
						<?php
						$width=FULLPAGE_WIDTH;
						$single_height='';
						
						$custom = get_post_custom($post->ID);
						
						$portfolio_page_header=$custom["portfolio_page_header"][0];
						$height=$custom["portfolio_slide_height"][0];
						$portfolio_videoembed=$custom["portfolio_videoembed"][0];
						$custom_link=$custom["custom_link"][0];
						$portfolio_style=$custom["portfolio_slide_style"][0];
						
						switch ($portfolio_page_header) {
						
							case "Slideshow" :

								$flexi_slideshow = do_shortcode('[flexislideshow]');
								echo mtheme_formatter($flexi_slideshow);
								
							break;
							case "Image" :
								// Show Image									
								echo display_post_image (
									$post->ID,
									$have_image_url=false,
									$link=false,
									$type="blog-full",
									$post->post_title,
									$class="portfolio-single-image" 
								);

							break;
							case "Video Embed" :
							echo '<div class="video-wrapper">';
							echo '<div class="video-container">';
								echo $portfolio_videoembed;
							echo '</div>';
							echo '</div>';
							break;
							
						}
								
								
						?>

						<div class="entry-post-wrapper">
							<div class="postsummarywrap">
								<div class="datecomment">
									<span class="postedin">
										<?php echo get_the_term_list( $post->ID, 'types', '', ' , ', '' ); ?> 
									</span>
									<span class="comments">
										<?php comments_popup_link('0', '1', '%','',''); ?>
									</span>
								
								</div>
							</div>
						<h1 class="page-entry-title">
						<?php the_title(); ?>
						</h1>
						
						<div class="entry-content clearfix">
						<?php the_content(); ?>
<?php
global $portfolio_current_post;
$portfolio_current_post=$post;
?>						
						<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>
						</div>
						
						</div>
						
					</div>
									
					<?php comments_template(); ?>
					
					<?php
					// Close password check condition
					}
					?>
										
				</div>
			</div>
<?php endwhile; // end of the loop. ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
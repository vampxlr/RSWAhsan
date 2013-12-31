<div class="fullpage-contents-wrap">
	<div class="page-container">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="portfolio-contents">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-content clearfix">
						<?php
						if ( !post_password_required() ) {
						the_content();
						}
						?>
						</div>
					<?php endwhile; else: ?>
				<?php endif; ?>
			</div>
<?php
if ( post_password_required() ) {
	
	echo '<div id="password-protected">';
	echo get_the_password_form();
	echo '</div>';
	
	} else {
?>				
			<div class="portfolio-wrap clearfix">
				<ul id="portfolio-large">
					<?php
					if ($portfolio_category=="All the items") {
						query_posts( array( 'post_type' => 'mtheme_portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $paged , 'posts_per_page' => $portfolio_perpage) );
						} else {
						query_posts( array( 'post_type' => 'mtheme_portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'types' => $portfolio_category , 'paged' => $paged , 'posts_per_page' => $portfolio_perpage) );
					}
					if (have_posts()) : while (have_posts()) : the_post();
					$custom = get_post_custom(get_the_ID());
					$portfolio_cats = get_the_terms( get_the_ID(), 'types' );
					$video_url="";
					$thumbnail="";
					$link_url="";
					if ( $custom["video"][0]<>"") { $video_url=$custom["video"][0]; }
					if ( $custom["thumbnail"][0]<>"" ) { $thumbnail=$custom["thumbnail"][0]; }
					if ( isset($custom["custom_link"][0]) ) { $link_url=$custom["custom_link"][0]; }
					$count++;
					$endrow= $count % $rows;
					?>
					<?php if ($endrow==0) { echo '<li>'; } else { echo '<li class="space-right">'; }?>
						<div class="thumbnail-loader"></div>
						<?php if ( $custom["video"][0]<>"" ) { ?>
						<div class="fadethumbnail-play portfolio-thumbnail-block">
						<?php } elseif ( $custom["custom_link"][0]<>"" ) { ?>
						<div class="fadethumbnail-link portfolio-thumbnail-block">
						<?php } else { ?>
						<div class="fadethumbnail-view portfolio-thumbnail-block">
						<?php } ?>

							<?php
							if ($portfolio_link=="Lightbox") {
								if ( $custom["video"][0]<>"" ) { 
									echo activate_lightbox (
										$lightbox_type="prettyPhoto",
										$ID=$post->ID,
										$link=$video_url,
										$mediatype="video",
										//$title=$post->post_title,
										$title="",
										$class="portfolio-image-holder",
										$navigation="prettyPhoto[portfolio]"
										);
									} elseif ( $custom["custom_link"][0]<>"" ) {
										?><a class="portfolio-image-holder" href="<?php echo $link_url; ?>"><?php
									} else {
									echo activate_lightbox (
										$lightbox_type="prettyPhoto",
										$ID=$post->ID,
										$link=featured_image_link($post->ID),
										$mediatype="image",
										//$title=$post->post_title,
										$title="",
										$class="portfolio-image-holder",
										$navigation="prettyPhoto[portfolio]"
										);
								}
							} else { ?>
								<a class="portfolio-image-holder" href="<?php the_permalink(); ?>">
							<?php
							} 
							?>
							<?php
							// Show Image
							if ($thumbnail<>"") {
								echo '<img src="'.$thumbnail.'" class="displayed-image" alt="thumbnail" />';
							} else {
								echo display_post_image (
									$post->ID,
									$have_image_url=$thumbnail_image_url,
									$link=false,
									$type="portfolio-large",
									$post->post_title,
									$class="displayed-image"
								);
							}
							?>			
							</a>
						</div>
						<div class="work-details">
							<h4><a href="<?php if ($link_url<>"") { echo $link_url; } else { the_permalink(); } ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h4>
							<p class="short"><?php echo $custom["description"][0];?></p>
						</div>
					</li>
					<?php endwhile; ?>
					<?php endif;?>
			 
				</ul>
			</div>
			<?php include ( MTHEME_INCLUDES . '/navigation.php' ); ?>
<?php
}
?>
		</div>
	</div>
</div>
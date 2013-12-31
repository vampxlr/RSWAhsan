<?php
/*
Template Name: Fullwidth
*/
?>
<?php get_header(); ?>

<div class="fullpage-contents-wrap">

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-wrapper lower-padding">
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>			
				<div class="entry-spaced-wrapper">

					<div class="entry-content clearfix">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mthemelocal' ), 'after' => '</div>' ) ); ?>
					</div>
					<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>	
				</div>
			
			</div>

		</div><!-- #post-## -->

		<?php //comments_template( '/page-comments.php', true ); ?>
	<?php endwhile; else: ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>
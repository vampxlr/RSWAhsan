<?php
/*
*  Search Page
*/
?>
 
<?php get_header(); ?>


	<?php if ( have_posts() ) : ?>
	<div class="contents-wrap float-left two-column">
		<h1 class="entry-title">
			<?php printf( __( 'Search Results for: %s', 'mthemelocal' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
		<?php
			get_template_part( 'loop', 'search' );
		?>
	</div>
	<?php else : ?>
	<div class="page-contents-wrap float-left two-column">
		<div class="entry-wrapper lower-padding">
		<div class="entry-spaced-wrapper">
			<h1 class="page-entry-title">
				<?php printf( __( 'Search Results for: %s', 'mthemelocal' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>

			<div class="entry-content">
				<h2><?php _e( 'Nothing Found', 'mthemelocal' ); ?></h2>
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mthemelocal' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</div>
		</div>
	</div>

	<?php endif; ?>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
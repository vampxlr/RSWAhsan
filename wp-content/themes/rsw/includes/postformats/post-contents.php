<?php
$postformat = get_post_format();
if($postformat == "") $postformat="standard";
switch ($postformat) {
	case 'link':
	$linked_to= get_post_meta($post->ID, MTHEME . '_meta_link', true);
	$fullcontent=true;		
	?>
	<div class="entry-post-title">
	<h2>
	<span class="postformat_<?php echo $postformat; ?>_icon">
	<a class="postformat_<?php echo $postformat; ?>" href="<?php echo esc_attr($linked_to); ?>" title="<?php echo esc_attr($linked_to); ?>"><?php the_title(); ?></a>
	</span>
	</h2>
	</div>
	<?php
	break;
	
	case 'gallery':
	$fullcontent=true;
	?>
	<div class="entry-post-title">
	<h2>
	<a class="postformat_<?php echo $postformat; ?>_icon" class="postformat_<?php echo $postformat; ?>" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mthemelocal' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	</div>
	<?php
	break;
	
	case 'image':
	$fullcontent=true;
	?>
	<div class="entry-post-title">
	<h2>
	<a class="postformat_<?php echo $postformat; ?>_icon" class="postformat_<?php echo $postformat; ?>" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mthemelocal' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	</div>
	<?php
	break;
	
	case 'video':
	$fullcontent=true;
	?>
	<div class="entry-post-title">
	<h2>
	<a class="postformat_<?php echo $postformat; ?>_icon" class="postformat_<?php echo $postformat; ?>" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mthemelocal' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	</div>
	<?php
	break;
	
	case 'aside':
	$quote=get_post_meta($post->ID, MTHEME . '_meta_quote', true);
	$fullcontent=true;
	?>
	<div class="entry-post-title">
	<span class="postformat_<?php echo $postformat; ?>_icon postformat_<?php echo $postformat; ?>"></span>
	</div>
	<?php
	break;
	
	case 'audio':
	$fullcontent=true;
	?>
	<div class="entry-post-title">
	<h2>
	<a class="postformat_<?php echo $postformat; ?>_icon" class="postformat_<?php echo $postformat; ?>" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mthemelocal' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	</div>
	<?php
	break;
	
	case 'quote':
	$quote=get_post_meta($post->ID, MTHEME . '_meta_quote', true);
	$quote_author=get_post_meta($post->ID, MTHEME . '_meta_quote_author', true);
	$fullcontent=true;
	?>
	<div class="entry-post-title">
	<span class="postformat_<?php echo $postformat; ?>_icon postformat_<?php echo $postformat; ?>"><?php echo $quote; ?></span>
	<?php if ($quote_author != "") { ?>
	<span class="quote_author"><?php echo "&#8212;&nbsp;" . $quote_author; ?></span>
	<?php } ?>
	</div>
	<?php
	break;
	
	default:
	?>
	<div class="entry-post-title">
	<h2>
	<a class="postformat_<?php echo $postformat; ?>_icon" class="postformat_<?php echo $postformat; ?>" href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mthemelocal' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	</div>
	<?php
}
?>

<div class="entry-content postformat_<?php echo $postformat; ?>_contents clearfix">
<?php
if ( is_single() || $postformat <> "standard" ) {
	
	the_content();
	
	echo '<div class="postsummary-spacing"></div>';
	?>
	<?php
	
} else {

	the_excerpt();
	
	$show_readmore=true;
}

if (is_single()) {
?>
<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>	
	<?php
	if ( of_get_option('blog_postinfo') ) {
	?>
	<div class="postinfo">
		<p><?php _e('This entry was posted on','mthemelocal');?> <?php the_time('l, F jS, Y') ?> at <?php the_time() ?></p>
		<p><?php _e('You can follow any responses to this entry through the','mthemelocal'); ?> <?php post_comments_feed_link('RSS 2.0');?> <?php _e('feed.','mthemelocal'); ?></p>
		<?php the_tags( __('<p>Tags: ','mthemelocal'), ', ', '</p>'); ?>
		<p><?php _e('Posted in:','mthemelocal');?> <?php the_category(', ') ?></p>
	</div>
	<?php
	}
	?>
<?php
}
?>
</div>

<?php
if ( $show_readmore==true ) {
?>
	<div class="readmore_link">
	<a href="<?php the_permalink(); ?>"><?php echo of_get_option ( 'read_more' ); ?> &rarr;</a>
	</div>
<?php
}
?>
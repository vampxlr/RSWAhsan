<?php
$width=MAX_CONTENT_WIDTH;
$height= get_post_meta($post->ID, MTHEME . '_meta_gallery_height', true);

$flexi_slideshow = do_shortcode('[flexislideshow]');
echo mtheme_formatter($flexi_slideshow);
?>
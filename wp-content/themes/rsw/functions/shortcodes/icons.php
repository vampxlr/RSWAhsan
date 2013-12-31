<?php
/**
 * Icons Shortcode
 */
function micons ( $atts, $content = null ) {
   extract( shortcode_atts( array(
	  'type' => 'add-item',
	  'color' => 'black',
	  'alignment' => 'left'
      ), $atts ) );
	
   return '[raw]' . '<img class="shortcode_icon iconalign-' . $alignment . '" src="' . MTHEME_PATH . '/images/shortcode_icons/'.$color.'/'.$type.'.png" alt="'.$type.'" />' . '[/raw]';
}
add_shortcode('display_icon', 'micons');

?>
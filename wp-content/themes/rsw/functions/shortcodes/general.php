<?php
/**
 * List shortcode.
 *
 * @ [list type=(check,star,note,play,bullet)]
 */
function mList( $atts, $content = null ) {
   extract( shortcode_atts( array(
	  'type' => 'bullet'
      ), $atts ) );
	
	$class="bulletlist";
	if ($type=="check") { $class="checklist";}
	if ($type=="star") { $class="starlist";}
	if ($type=="note") { $class="notelist";}
	if ($type=="play") { $class="playlist";}
	if ($type=="link") { $class="linklist";}
	if ($type=="bullet") { $class="bulletlist";}
	
   return '<div class="'. $class .'">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('list', 'mList');


function mPre( $atts, $content = null ) {
   return '<pre>' . $content . '</pre>';
}
add_shortcode('pre', 'mPre');

function mCode( $atts, $content = null ) {
   $content = '<code>' . nl2br ( htmlentities( $content ) ) . '</code>';
   return '[raw]' . $content . '[/raw]';
}
add_shortcode('code', 'mCode');


function theme_shortcode_note($atts, $content = null) {
	extract(shortcode_atts(array(
		'align' => 'left',
		'width' => '100',
	), $atts));
	$width = ' style="width:'.$width.'px"';
	$align = 'align-'.$align;
	return '<div class="mtextbox ' . $align . '"'.$width.'>'.$title.'<div class="mtextbox_content">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('textbox','theme_shortcode_note');


/**
 * Notice
 */
function mNotice( $atts, $content = null ) {

   extract( shortcode_atts( array(
	  'type' => 'yellow'
      ), $atts ) );

	$notice ='<div class="noticebox info_'.$type.'"><span class="close_notice"></span>' . do_shortcode($content) . '</div>';
	
	return $notice;
		
}
add_shortcode('notice', 'mNotice');


//DropCaps [dropcap1] letter [/dropcap1]
function mDropCap1( $atts, $content = null ) {
   return '<span class="dropcap1">' . $content . '</span>';
}
add_shortcode('dropcap1', 'mDropCap1');

//DropCaps [dropcap2] letter [/dropcap2]
function mDropCap2( $atts, $content = null ) {
   return '<span class="dropcap2">' . $content . '</span>';
}
add_shortcode('dropcap2', 'mDropCap2');


//Thumbnails for Gallery [thumbnails]
function mThumbnails($atts, $content = null) {
	extract(shortcode_atts(array(
		"size" => 'thumbnail',
		"width" => '206',
		"height" => '137',
		"id" => '1',
		"pageid" => ''
	), $atts));
	
	if ($width=="") { $width="206"; }
	if ( $height=="" || $height==0 ) { $height="137px"; } else { $height=$height . "px"; }
	
	$width=$width . "px";
	
	$uniqueID=uniqid();
	
	$portfolio_column_count=1;
	$thepageID=get_the_id();
	if ($pageid<>'') $thepageID=$pageid;
	
	$images =& get_children( array( 
						'post_parent' => $thepageID,
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);
	
	if ( $images ) 
	{
	ob_start();
	?>
	
		<div class="clear"></div>
		
		<div class="thumbnails-wrap">
		
			<ul class="minishowcase">
			<?php
			foreach ( $images as $id => $image ) {

			$attatchmentID = $image->ID; 
			$imagearray = wp_get_attachment_image_src( $attatchmentID , 'fullsize', false);
			$imageURI = $imagearray[0];			
			
			$thumbnail_imagearray = wp_get_attachment_image_src( $attatchmentID , 'portfolio-small', false);
			$thumbnail_imageURI = $thumbnail_imagearray[0];
			
			$imageID = get_post($attatchmentID);
			$imageTitle = $imageID->post_title;
			?>

				<li class="tileimage">
					<a title="<?php echo $imageTitle; ?>" rel="prettyPhoto[gallery]" href="<?php echo $imageURI; ?>">
						
<img src="<?php echo $thumbnail_imageURI; ?>" class="thumbnail-image" style="min-width:<?php echo $width; ?>; max-width:<?php echo $width; ?>; height:<?php echo $height; ?>;" alt="thumbnail" />
					</a>
				</li>
					<?php
			}
			?>

		</ul>
		</div>

		<div class="clear"></div>
<?php	
		
	$content = ob_get_contents();
	ob_end_clean();
	return '[raw]' . $content . '[/raw]';
	

	}	
}
add_shortcode("thumbnails", "mThumbnails");


//Button [button link="yourlink.html"] text [/button]
function mButton( $atts, $content = null ) {

   extract( shortcode_atts( array(
      'link' => '#',
	  'target' => '',
	  'type' => 'gray',
	  'size'=> 'normal',
	  'align' => 'none'
      ), $atts ) );
	  
	if ($size=="normal") { $size = "bigbutton "; } else { $size = "smallbutton " . $size . "_"; }
	  
	if ($target=="_blank") { $target=' target="_blank"'; }
	$button = '<a class="button-align-' . $align . ' ' .$size.$type.'button" href="'.$link.'"' . $target . '><span>' . trim($content) . '</span></a>';
	
   return '[raw]' . $button . '[/raw]';
}
add_shortcode('button', 'mButton');

//post list [postlist cat=3 num=5]
function post_list($atts, $content = null) {
        extract(shortcode_atts(array(
                "num" => '5',
                "cat" => ''
        ), $atts));
        global $post;
        $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
        $retour='<div class="postlist"><ul>';
        foreach($myposts as $post) :
                setup_postdata($post);
             $retour.='<li><a href="'.get_permalink().'">'.the_title("","",false).'</a></li>';
        endforeach;
        $retour.='</div></ul> ';
		wp_reset_query();
        return $retour;
}
add_shortcode("posts", "post_list");

/**
 * Usage: [pagelist child_of=x] x = id of the parent page, default = 0
 * Example: [pagelist child_of=12]
**/

function pagelist($atts, $content = null) {
        extract(shortcode_atts(array(
                "childof" => ''
        ), $atts));
 $output = wp_list_pages('echo=0&child_of='.$childof.'&sort_column=menu_order&title_li=');
 return '<div class="postlist"><ul>'.$output.'</ul></div>';
}
add_shortcode('pages', 'pagelist');


//Google Maps Shortcode
function do_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '460',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed" ></iframe>';
}
add_shortcode("googlemap", "do_googleMaps");

//Clear [clear]
function mClear( $atts, $content = null ) {
   return '<div class="clear"></div>';
}
add_shortcode('clear', 'mClear');

//Column1 [column1] text [/column1]
function mColumn1( $atts, $content = null ) {
   return '<div class="column1">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column1', 'mColumn1');

//Column2 [column2] text [/column2]
function mColumn2( $atts, $content = null ) {
   return '<div class="column2 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column2', 'mColumn2');

	//Column2 [column2_last] text [/column2_last]
	function mColumn2_Last( $atts, $content = null ) {
	   return '<div class="column2 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column2_last', 'mColumn2_Last');
	
//Column3 [column3] text [/column3]
function mColumn3( $atts, $content = null ) {
   return '<div class="column3 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column3', 'mColumn3');

	//Column3 [column3_last] text [/column3_last]
	function mColumn3_Last( $atts, $content = null ) {
	   return '<div class="column3 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column3_last', 'mColumn3_Last');

//Column4 [column4] text [/column4]
function mColumn4( $atts, $content = null ) {
   return '<div class="column4 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column4', 'mColumn4');

	//Column4 [column4_last] text [/column4_last]
	function mColumn4_Last( $atts, $content = null ) {
	   return '<div class="column4 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column4_last', 'mColumn4_Last');

//Column32 [column32] text [/column32]
function mColumn32( $atts, $content = null ) {
   return '<div class="column32 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column32', 'mColumn32');

	//Column4 [column32_last] text [/column32_last]
	function mColumn32_Last( $atts, $content = null ) {
	   return '<div class="column32 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column32_last', 'mColumn32_Last');
	
//Column32 [column43] text [/column43]
function mColumn43( $atts, $content = null ) {
   return '<div class="column43 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column43', 'mColumn43');

	//Column4 [column32_last] text [/column32_last]
	function mColumn43_Last( $atts, $content = null ) {
	   return '<div class="column43 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column43_last', 'mColumn43_Last');
	
//Column32 [column43] text [/column43]
function mColumn5( $atts, $content = null ) {
   return '<div class="column5 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column5', 'mColumn5');

	//Column4 [column32_last] text [/column32_last]
	function mColumn5_Last( $atts, $content = null ) {
	   return '<div class="column5 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column5_last', 'mColumn5_Last');
	
function mColumn52( $atts, $content = null ) {
   return '<div class="column52 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column52', 'mColumn52');

	function mColumn52_Last( $atts, $content = null ) {
	   return '<div class="column52 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column52_last', 'mColumn52_Last');
	
function mColumn53( $atts, $content = null ) {
   return '<div class="column53 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column53', 'mColumn53');

	function mColumn53_Last( $atts, $content = null ) {
	   return '<div class="column53 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column53_last', 'mColumn53_Last');
	
//Column32 [column43] text [/column43]
function mColumn6( $atts, $content = null ) {
   return '<div class="column6 column_space">' . wpautop(do_shortcode(trim($content))) . '</div>';
}
add_shortcode('column6', 'mColumn6');

	//Column4 [column32_last] text [/column32_last]
	function mColumn6_Last( $atts, $content = null ) {
	   return '<div class="column6 clearfix">' . wpautop(do_shortcode(trim($content))) . '</div><div class="clear"></div>';
	}
	add_shortcode('column6_last', 'mColumn6_Last');


//Toggle [toggle] text [/toggle]
function mToggle( $atts, $content = null ) {

   extract( shortcode_atts( array(
      'title' => 'Toggle',
      ), $atts ) );
	  
	$toggle	 =	'<h4 class="trigger"><a href="#">' . $title . '</a></h4>';
	$toggle .=	'<div class="toggle_container">';
	$toggle .=	'<div class="block">';
	$toggle .=	$content;
	$toggle	.=	'</div>';
	$toggle	.=	'</div><div class="clear"></div>';
	$toggle = do_shortcode($toggle);

	return $toggle;
}
add_shortcode('toggle', 'mToggle');


//Highlight [highlight] text [/highlight]
function mHighlight( $atts, $content = null ) {
   return '<span class="highlight">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'mHighlight');

//Big Italic
function mbig_italic( $atts, $content = null ) {
		$big_italic = '<div class="big-italic">' . do_shortcode($content) . '</div>';

   return $big_italic;
}
add_shortcode('big_italic', 'mbig_italic');

//Pullquote Right [pullquote_right] text [/pullquote_right]
function mPullquote( $atts, $content = null ) {

   extract( shortcode_atts( array(
	  'align' => 'center'
      ), $atts ) );

	switch ($align)
	{
		case "center":
		$pullquote = '<div class="pullquote-center">' . do_shortcode($content) . '</div>';
		break;
		
		case "right":
		$pullquote = '<div class="pullquote-right">' . do_shortcode($content) . '</div>';
		break;
		
		case "left":
		$pullquote = '<div class="pullquote-left">' . do_shortcode($content) . '</div>';
		break;
	}

   return $pullquote;
}
add_shortcode('pullquote', 'mPullquote');


//Picture frame [pictureframe]
function mPictureFrame( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"width" => '150',
		"height" => '',
		"zoom" => '',
		"title" => 'Untitled',
		"align" => 'none',
		"link" => 'none',
		"lightbox" => 'true',
		"image" => ''
	), $atts));
	
	$quality=THEME_IMAGE_QUALITY;
	$class="none";
	$before='';
	$after='';
	$fade='';
	$img_align='';
	
	
	if ( $height=="" || $height==0 ) { $height="auto"; } else { $height=$height . "px"; }
	$width=$width . "px";
	
	if ($align=="left") {$img_align="img-align-left";}
	if ($align=="right") {$img_align="img-align-right";}
	if ($align=="center") {$img_align="img-align-center";}
	if ($link<>"") {
		$before='<a title="'.$title.'" href="'. $link . '">';
		$after='</a>';
		$fade="portfolio-fadein";
		}
	if ($lightbox=="true") {
		$before='<a rel="prettyPhoto" title="'.$title.'" href="'. $image . '">';
		$after='</a>';
		$fade="pictureframe-image";
		}
	
	$class="pictureframe " . $img_align . " " . $fade;
		
	$imagesrc = '<img src="'. $image . '" class="'.$class.'" style="width:' . $width .'; height:'. $height .'" alt="thumbnail" />';


   return $before . $imagesrc . $after;
}
add_shortcode('pictureframe', 'mPictureFrame');

/*
* jQuery Tools - Tabs shortcode
*/
add_shortcode( 'tabs', 'mtabs' );
function mtabs( $atts, $content ){
$GLOBALS['tabs']="";
$GLOBALS['tab_count'] = 0;

wpautop(do_shortcode( $content ));

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a class="" href="#">'.$tab['title'].'</a></li>';
$panes[] = '<div class="pane">'.wpautop($tab['content']).'</div>';
}
$tabscode  = '<div class="tabwrapper">';
$tabscode .= '<ul class="tabs">'.implode( "\n", $tabs ).'</ul>';
$tabscode .= '<div class="panes">'.implode( "\n", $panes ).'</div>';
$tabscode .= '<div class="clear"></div>';
$tabscode .= '</div>';
}
return wpautop(do_shortcode($tabscode));
}

add_shortcode( 'tab', 'mtab' );
function mtab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d',
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}

/*
* jQuery Tools - Accordion Tabs shortcode
*/
add_shortcode( 'accordiontabs', 'maccordiontabs' );
function maccordiontabs( $atts, $content ){
$GLOBALS['tabs']="";
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	$tabscode ='<div class="accordion-tabs">';
	foreach( $GLOBALS['tabs'] as $tab ){
		$tabscode .= '<h5>'.$tab['title'].'</h5>';
		$tabscode .= '<div class="pane">'.wpautop($tab['content']).'</div>';
	}
}
$tabscode .= '</div>';
$tabscode .= '<div class="clear"></div>';
return do_shortcode($tabscode);
}

add_shortcode( 'accordiontab', 'maccordiontab' );
function maccordiontab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d',
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}
?>
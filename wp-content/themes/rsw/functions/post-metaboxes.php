<?php
//$prefix = 'fables_';

/*
$post_meta_box = array(
	'id' => 'my-post-meta-box',
	'title' => 'Custom meta box',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Text box',
			'desc' => 'Enter something here',
			'id' => $prefix . 'text',
			'type' => 'text',
			'std' => 'Default value 1'
		),
		array(
			'name' => 'Textarea',
			'desc' => 'Enter big text here',
			'id' => $prefix . 'textarea',
			'type' => 'textarea',
			'std' => 'Default value 2'
		),
		array(
			'name' => 'Select box',
			'id' => $prefix . 'select',
			'type' => 'select',
			'options' => array('Option 1', 'Option 2', 'Option 3')
		),
		array(
			'name' => 'Select box category',
			'id' => $prefix . 'select',
			'desc' => 'Enter big text here',
			'type' => 'select',
			'options' => get_select_target_options('portfolio_category')
		),
		array(
			'name' => 'Radio',
			'id' => $prefix . 'radio',
			'desc' => 'Enter big text here',
			'type' => 'radio',
			'options' => array(
				array('name' => 'Name 1', 'value' => 'Value 1'),
				array('name' => 'Name 2', 'value' => 'Value 2')
			)
		)
	)
);
*/
global $video_meta_box,$link_meta_box,$image_meta_box,$quote_meta_box,$gallery_meta_box,$audio_meta_box,$common_meta_box;

$sidebar_options=array('Default Sidebar');
for ($sidebar_count=1; $sidebar_count <=10; $sidebar_count++ ) {

	if ( of_get_option('theme_sidebar'.$sidebar_count) <> "" ) {
		$active_sidebar = of_get_option('theme_sidebar'.$sidebar_count);
		array_push($sidebar_options, $active_sidebar);
	}
}

// Pull all the Featured into an array
$bg_slideshow_pages = get_posts('post_type=mtheme_featured&orderby=title&numberposts=-1&order=ASC');

if ($bg_slideshow_pages) {
	$options_bgslideshow['none'] = "Not Selected";
	foreach($bg_slideshow_pages as $key => $list) {
		$custom = get_post_custom($list->ID);
		if ( isset($custom["fullscreen_type"][0]) ) { 
			$slideshow_type=$custom["fullscreen_type"][0]; 
		} else {
		$slideshow_type="";
		}
		if ($slideshow_type<>"Fullscreen-Video") {
			$options_bgslideshow[$list->ID] = $list->post_title;
		}
	}
}
if (! $options_bgslideshow ) $options_bgslideshow[0]="Featured pages not found.";

$common_meta_box = array(
	'id' => 'common-meta-box',
	'title' => 'General Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Background Slideshow / Image from',
			'id' => MTHEME . '_meta_background_choice',
			'type' => 'select',
			'desc' => '<strong>Background Slideshow:</strong> Generate slideshow from theme options set Featured Slideshow</br>
			<strong>Image Attachments:</strong> Generate slideshow from this page/post image attachements</br>
			<strong>Theme options set image:</strong> Display image set from theme options</br>
			<strong>Use featured image:</strong> Display image using current page/post featured image</br>
			<strong>Use custom background:</strong> Display image using a url</br>
			',
			'options' => array('Background Slideshow','Image Attachments Slideshow','Theme options set image', 'Use featured image', 'Use custom background', 'none')
		),
		array(
			'name' => 'Custom background image URL',
			'id' => MTHEME . '_meta_background_url',
			'type' => 'text',
			'desc' => 'Please provide full url of background. eg. <code>http://www.domain.com/path/image.jpg</code>'
		),
		array(
			'name' => 'Background slideshow from a Fullscreen Slideshow post',
			'id' => MTHEME . '_slideshow_bgfeaturedpost',
			'type' => 'selectpost',
			'desc' => '<strong>Note :</strong>If selected, your choice of fullscreen slideshow post is used to create the  page background slideshow',
			'options' => $options_bgslideshow
		),
		array(
			'name' => 'Choice of Sidebar',
			'id' => MTHEME . '_sidebar_choice',
			'type' => 'select',
			'desc' => 'For Sidebar Active Pages and Posts',
			'options' => $sidebar_options
		)
	)
);

$video_meta_box = array(
	'id' => 'video-meta-box',
	'title' => ' Video Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'break',
			'sectiontitle' => 'HTML5 Video'
		),
		array(
			'name' => 'Video Title',
			'id' => MTHEME . '_video_title',
			'type' => 'text',
			'desc' => 'Title for Video'
		),
		array(
			'name' => 'Video height (in pixels)',
			'id' => MTHEME . '_video_height',
			'type' => 'text',
			'desc' => 'Please provide height in pixels for the video'
		),
		array(
			'name' => 'M4V File URL',
			'id' => MTHEME . '_video_m4v_file',
			'type' => 'text',
			'desc' => 'Enter M4V File URL ( Required )'
		),
		array(
			'name' => 'OGV File URL',
			'id' => MTHEME . '_video_ogv_file',
			'type' => 'text',
			'desc' => 'Enter OGV File URL'
		),
		array(
			'name' => 'Poster Image',
			'id' => MTHEME . '_video_poster_file',
			'type' => 'text',
			'desc' => 'Poster Image'
		),
		array(
			'type' => 'break',
			'sectiontitle' => 'Video Hosts'
		),
		array(
			'name' => 'Youtube Video ID',
			'id' => MTHEME . '_video_youtube_id',
			'type' => 'text',
			'desc' => 'Youtube video ID'
		),
		array(
			'name' => 'Vimeo Video ID',
			'id' => MTHEME . '_video_vimeo_id',
			'type' => 'text',
			'desc' => 'Vimeo video ID'
		),
		array(
			'name' => 'Daily Motion Video ID',
			'id' => MTHEME . '_video_dailymotion_id',
			'type' => 'text',
			'desc' => 'Daily Motion video ID'
		),
		array(
			'name' => 'Google Video ID',
			'id' => MTHEME . '_video_google_id',
			'type' => 'text',
			'desc' => 'Google video ID'
		),
		array(
			'name' => 'Video Embed Code',
			'id' => MTHEME . '_video_embed_code',
			'type' => 'textarea',
			'desc' => 'Video Embed code. Ensure width does not exceed 650px'
		)
	)
);

$gallery_meta_box = array(
	'id' => 'gallery-meta-box',
	'title' => 'Gallery Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'No Options'
		)
	)
);

$audio_meta_box = array(
	'id' => 'audio-meta-box',
	'title' => 'Audio Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'MP3 file',
			'id' => MTHEME . '_meta_audio_mp3',
			'type' => 'text',
			'desc' => 'Please provide full url. eg. <code>http://www.domain.com/path/audiofile.mp3</code>'
		),
		array(
			'name' => 'M4A file',
			'id' => MTHEME . '_meta_audio_m4a',
			'type' => 'text',
			'desc' => 'Please provide full url. eg. <code>http://www.domain.com/path/audiofile.m4a</code>'
		),
		array(
			'name' => 'OGA file',
			'id' => MTHEME . '_meta_audio_ogg',
			'type' => 'text',
			'desc' => 'Please provide full url. eg. <code>http://www.domain.com/path/audiofile.ogg</code>'
		)
	)
);

$link_meta_box = array(
	'id' => 'link-meta-box',
	'title' => 'Link Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Link URL',
			'id' => MTHEME . '_meta_link',
			'type' => 'text',
			'desc' => 'Please provide full url. eg. <code>http://www.domain.com/path/</code>'
		)
	)
);

$image_meta_box = array(
	'id' => 'image-meta-box',
	'title' => 'Image Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Enable Lightbox',
			'id' => MTHEME . '_meta_lightbox',
			'type' => 'select',
			'options' => array('Enable Lightbox', 'Disable Lighbox')
		)
	)
);

$quote_meta_box = array(
	'id' => 'quote-meta-box',
	'title' => 'Quote Metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Quote',
			'id' => MTHEME . '_meta_quote',
			'type' => 'textarea',
			'desc' => 'Enter quote here'
		),
		array(
			'name' => 'Author',
			'id' => MTHEME . '_meta_quote_author',
			'type' => 'text',
			'desc' => 'Author'
		)
	)
);

add_action('admin_init', 'mtheme_add_boxes');

// Add meta box
function mtheme_add_boxes() {
	global $video_meta_box,$link_meta_box,$image_meta_box,$quote_meta_box,$gallery_meta_box,$audio_meta_box,$common_meta_box;
	add_meta_box($common_meta_box['id'], $common_meta_box['title'], 'common_show_box', $common_meta_box['page'], $common_meta_box['context'], $common_meta_box['priority']);
	add_meta_box($video_meta_box['id'], $video_meta_box['title'], 'video_show_box', $video_meta_box['page'], $video_meta_box['context'], $video_meta_box['priority']);
	add_meta_box($link_meta_box['id'], $link_meta_box['title'], 'link_show_box', $link_meta_box['page'], $link_meta_box['context'], $link_meta_box['priority']);
	add_meta_box($image_meta_box['id'], $image_meta_box['title'], 'image_show_box', $image_meta_box['page'], $image_meta_box['context'], $image_meta_box['priority']);
	add_meta_box($quote_meta_box['id'], $quote_meta_box['title'], 'quote_show_box', $quote_meta_box['page'], $quote_meta_box['context'], $quote_meta_box['priority']);
	add_meta_box($gallery_meta_box['id'], $gallery_meta_box['title'], 'gallery_show_box', $gallery_meta_box['page'], $gallery_meta_box['context'], $gallery_meta_box['priority']);
	add_meta_box($audio_meta_box['id'], $audio_meta_box['title'], 'audio_show_box', $gallery_meta_box['page'], $audio_meta_box['context'], $audio_meta_box['priority']);
}

// Callback function to show fields in meta box
function video_show_box() {
	global $video_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($video_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label class="mtheme_metabox_fieldname" for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'break':
				echo '<h2>'.$field['sectiontitle'].'</h2>';
				//echo '<hr style="height:1px; border:1px solid #eee;"/>';
				break;
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="mtheme_metabox_description">', $field['desc'] , '</div>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:300px">', $meta ? $meta : $field['std'], '</textarea>',
					'<br /><div class="mtheme_metabox_description">', $field['desc'], '</div>';
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select><br /><div class="mtheme_metabox_description">', $field['desc'], '</div>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				echo '<br /><div class="mtheme_metabox_description">', $field['desc'], '</div>';
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /><br /><div class="description">', $field['desc'], '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

function gallery_show_box() {
	global $gallery_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($gallery_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

function audio_show_box() {
	global $audio_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($audio_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

function common_show_box() {
	global $common_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($common_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select><br /><div class="mtheme_metabox_description">', $field['desc'], '</div>';
				break;
			case 'selectpost':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option => $list) {
					echo '<option value=', $option , $meta == $option ? ' selected="selected"' : '', '>', $list, '</option>';
				}
				echo '</select><br /><div class="mtheme_metabox_description">', $field['desc'], '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

function link_show_box() {
	global $link_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($link_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

function image_show_box() {
	global $image_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($image_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:300px">', $meta ? $meta : $field['std'], '</textarea>',
					'<br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select><br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				echo '<br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /><br /><div class="description">', $field['desc'], '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

function quote_show_box() {
	global $quote_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mtheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($quote_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:300px">', $meta ? $meta : $field['std'], '</textarea>',
					'<br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select><br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				echo '<br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /><br /><div class="description">', $field['desc'], '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'mtheme_save_data');

// Save data from meta box
function mtheme_save_data($post_id) {
	global $video_meta_box,$link_meta_box,$image_meta_box,$quote_meta_box,$gallery_meta_box,$audio_meta_box,$common_meta_box;
	
	// verify nonce
	if ( isset($_POST['mtheme_meta_box_nonce']) ) {
		if (!wp_verify_nonce($_POST['mtheme_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ( isset($_POST['post_type']) ) {
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}
	
	
	foreach ($common_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
	
	foreach ($gallery_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
	foreach ($audio_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}

	foreach ($video_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
	foreach ($link_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
	foreach ($image_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
	foreach ($quote_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
}

?>
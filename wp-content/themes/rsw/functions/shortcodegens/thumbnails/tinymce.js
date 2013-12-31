function insertTypeShortcode() {
	
	var shortcodeText;
	var thumbnail_width = document.getElementById('thumbnail_width').value;
	var thumbnail_height = document.getElementById('thumbnail_height').value;
	
	
	shortcodeText = '<br />[thumbnails pageid="" width="' + thumbnail_width + '" height="' + thumbnail_height + '"]<br />';	
		
	if ( thumbnail_width == 0 ){
			tinyMCEPopup.close();
		}	
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}

jQuery(document).ready( function($) {
	jQuery(".ranger-bar :text").rangeinput();
	
	jQuery( "#home-list" ).sortable();
	jQuery( "#home-list" ).disableSelection();
	
	jQuery('.controls .checkbox:checkbox').each(function(){
		jQuery(this).iphoneStyle();
	});
	
	
	var homeList = jQuery('#home-list');
	jQuery('#loading-animation').hide();
 
	homeList.sortable({
		update: function(event, ui) {
			jQuery('#loading-animation').show(); // Show the animate loading gif while waiting
 			//alert(homeList.sortable('toArray').toString());
			opts = {
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action: 'home_sort', // Tell WordPress how to handle this ajax request
					order: homeList.sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
				},
				success: function(response) {
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				},
				error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
					//alert('There was an error saving the updates');
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				}
			};
			jQuery.ajax(opts);
		}
	});	
});
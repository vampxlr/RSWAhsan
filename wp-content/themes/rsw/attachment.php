<?php
/*
* Attachment Page
*/
?>
 
<?php get_header(); ?>

<div class="fullpage-contents-wrap">
	<?php
		get_template_part( 'loop', 'attachment' );
	?>
</div>
<?php get_footer(); ?>
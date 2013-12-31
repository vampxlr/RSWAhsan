<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>
<?php
$count=0;
$portfolio_style= get_post_meta($post->ID, MTHEME . '_portfolio_style', true);
$portfolio_category= get_post_meta($post->ID, MTHEME . '_portfolio_category', true);
$portfolio_perpage= get_post_meta($post->ID, MTHEME . '_portfolio_perpage', true);
$portfolio_link= get_post_meta($post->ID, MTHEME . '_portfolio_link', true);

if ($portfolio_perpage=="list all") { $portfolio_perpage="-1"; }

$portfolio_cat= get_term_by ( 'name', $portfolio_category,'types' );
$portfolio_cat_slug=$portfolio_cat -> slug;
$portfolio_cat_ID=$portfolio_cat -> term_id;

$portfolio_category=$portfolio_cat_slug;


Switch ( $portfolio_style ) {	
	case "4 Column" :
		$rows=4;
		include ( MTHEME_INCLUDES . 'portfolio/portfolio-four.php' );
	break;
	
	case "3 Column" :
		$rows=3;
		include ( MTHEME_INCLUDES . 'portfolio/portfolio-three.php' );
	break;
	
	case "2 Column" :
		$rows=2;
		include ( MTHEME_INCLUDES . 'portfolio/portfolio-two.php' );
	break;
}

?>
<?php get_footer(); ?>
<?php /* 
Template Name: Categories
*/ ?>
<?php get_header(); ?>
	<div id="content">
		<?php get_sidebar(); ?>	
	
<?php $cats= wp_tag_cloud( array( 'taxonomy' => 'pictos_categories', format => 'list' ) );
		var_dump($cats);
?>
		</div>
	
<?php get_footer(); ?>
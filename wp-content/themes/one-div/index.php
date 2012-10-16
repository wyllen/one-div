<?php get_header(); ?>
	<div id="content">
	<?php get_sidebar();
		if(have_posts()) : while(have_posts()) : the_post();
		the_content();	
		endwhile;endif;
		?>			
		</div>
<?php get_footer(); ?>
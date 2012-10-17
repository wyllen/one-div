<?php /* 
Template Name: Categories
*/ ?>
<?php get_header(); ?>
	<div id="content">
		<?php get_sidebar(); ?>	
	
<?php $args = array(
	'smallest'                  => 22, 
    'largest'                   => 22,
    'unit'                      => 'pt', 
    'number'                    => 45,  
    'format'                    => 'list',
    'orderby'                   => 'name', 
    'order'                     => 'ASC',
    'link'                      => 'view', 
    'taxonomy'                  => 'pictos_categories', 
    'echo'                      => true ); 
	
	wp_tag_cloud( $args ); ?>
	<div class="navigation">
<div class="alignleft"><?php next_posts_link('«') ?></div>
<div class="alignright"><?php previous_posts_link('»') ?></div>
	</div>

		</div>
	
<?php get_footer(); ?>

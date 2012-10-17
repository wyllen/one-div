<?php get_header(); ?>
	<div id="content">
		<?php get_sidebar(); ?>		
category		
		<?php
			if(have_posts()) : while(have_posts()) : the_post();			
?>	
		
			<div class="one_div_item">
				
				<div class="votes"><?php if(function_exists('the_ratings')) { the_ratings(); } ?></div>
				
				<div class="picto">
					<div class="picto_wrapper">						
						<?php
							$html= get_post_meta($post->ID,'_html_code',true);		
							$html= htmlspecialchars_decode($html)	;		
							$html_copy=$html;
							$html = preg_replace('/([class|id])=["|\']([a-zA-Z0-9_]*)["|\']/','${1}="${2}'.$post->ID.'"', $html);
						echo $html;  ?>
						<style type="text/css">	
						<?php $css= get_post_meta($post->ID,'_css_code',true); 
								$css= str_replace("&#039;", "'", $css);
								$css= str_replace("&quot;", "\"", $css);
								$css_copy=$css;
							   $css = preg_replace('/([#.])([_a-zA-Z0-9]*)([^"em";]*[{|::])/','$1${2}'.$post->ID.'${3}', $css);
								echo $css;
								?>
						</style>
						<textarea name="code_css" id="code_css_<?php echo $post->ID; ?>" style="display:none"><?php echo $css_copy; ?></textarea>
						<textarea name="code_html" id="code_html_<?php echo $post->ID; ?>" style="display:none"><?php echo  $html_copy; ?></textarea>
					</div>
				</div>
				<a href="" class="button_code html" id="button_html_<?php echo $post->ID; ?>" title="<?php echo $post->ID; ?>">HTML</a>
				<a href="" class="button_code css"  id="button_css_<?php echo $post->ID; ?>" title="<?php echo $post->ID; ?>">CSS</a>
				<a href="<?php bloginfo('template_url'); ?>/codes/<?php echo $post->ID ?>/<?php echo $post->ID ?>.zip" class="button_code zip">ZIP</a>
			
				</div>
			<?php
			endwhile;endif;
			?>
			
			
			
			<div class="clear"></div>
			<script type="text/javascript">
					$(document).ready(function(){
						$('a.button_code.html').zclip({
			path:'<?php bloginfo('template_url'); ?>/js/ZeroClipboard.swf',
			copy:function(){
				return $('#code_html_'+$(this).attr("title")).val();
			}
					});
				
						$('a.button_code.css').zclip({
						path:'<?php bloginfo('template_url'); ?>/js/ZeroClipboard.swf',
						copy:function(){
						return $('#code_css'+$(this).attr("title")).val();
						}
					});
					// The link with ID "copy-description" will copy
					// the text of the paragraph with ID "description"
				
					});
				</script>	

		</div>
<?php get_footer(); ?>
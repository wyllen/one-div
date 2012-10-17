<footer id="footer">
<?php wp_footer(); ?>
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
						return $('#code_css_'+$(this).attr("title")).val();
						}
					});
					// The link with ID "copy-description" will copy
					// the text of the paragraph with ID "description"
		
		
		
		
	
					});
				</script>	
</footer>
</body>
</html>
<?php get_header();

if ( is_user_logged_in() ) {
if(isset($_POST['submit'])){
 
	$err = array();
	$err['status'] = true;
	$output = "";
 
	/*
	*	Controle de la validité du formulaire
	*/
	
	if(empty($_POST['title'])){
		$err['status'] = false;
		$err['msg'][] = 'Title is empty!';
	}
	if(empty($_POST['htmlcode'])){
		$err['status'] = false;
		$err['msg'][] = 'HTML code is empty!';
	}
	if(empty($_POST['csscode'])){
		$err['status'] = false;
		$err['msg'][] = 'CSS code is empty!';
	}
	
 
 
	/*
	*	Enregistrement de l'article
	*/
	if($err['status']){
 
		/*
		*	Préparation des données a enregistrer
		*/
		$insert = array(
			'post_status'	=> 'draft',
			'post_type'	=> 'pictos',
			'post_title'	=> htmlentities($_POST['title']),
			'post_author'	=>  get_current_user_id()
		);
 
		/*
		*	Enregistrement et récupération de l'ID de l'article inséré
		*	renvois 0 (false) en cas d'erreur
		*/
		$post_id = wp_insert_post($insert);
 
 
		/*
		*	Enregistrement des meta données
		*/
		if($post_id != 0){
 
			/*
			*	Ajout des tags
			*/
			if(!empty($_POST['keywords'])){
 
				$keywords = explode(',',$_POST['keywords']);
 
				foreach($keywords as $k=>$v){
					$tag = trim(strip_tags($v));
					wp_insert_term(
						$tag,
						'post_tag',
						array(
							'slug' => sanitize_title($tag)
						)
					);
				}
 
			}
			$user_meta_values = array(
				'mail'		=> $_POST['mail']
			);
			add_post_meta($post_id,'_html_code',$_POST['htmlcode']);
			add_post_meta($post_id,'_css_code',$_POST['csscode']);
			$output='Your picto has been submit';
		}
 
	}
	/*
	*	Si le formulaire contient une (ou plusieurs) erreur
	*/
	else{
		foreach($err['msg'] as $k=>$v)
			$output .= $v . '<br />';
	}
}
 ?>
	<div id="content">
	<?php get_sidebar();?>			
		<form method="post" id="submitpicto" action="<?php echo site_url().'/submit'; ?>">
		<p><?php echo isset($output) ? $output : '' ; ?></p>
			<p><label for="title">Title</label></p><p><input type="text" name="title" id="title" value="" /></p>
	<p><label for="htmlcode">HTML code</label></p><p><input type="text" name="htmlcode" id="htmlcode" value="" /></p>
	<p id="innertextcss"><label for="csscode">CSS code</label></p><p><textarea name="csscode" id="csscode" rows="10" cols="15"></textarea></p>
	<p><label for="keywords">Tags</label></p><p><input type="text" name="keywords" id="keywords" value="" placeholder="separated by a coma"/></p>
	<p><input type="submit" name="submit" value="submit" id="submitpictobutton" /></p>
	
</form>
<div class="preview">
<div id="preview-picto"></div>
<style type="text/css" id="preview-picto-style"></style>
</div>
<div class="clear"></div>
<script type="text/javascript">
$("#htmlcode").keyup(function(){
$("#preview-picto").html($("#htmlcode").val());
});

$("html").keyup(function(){
$("#preview-picto-style").html($(".CodeMirror-lines")[0].innerText);
});
</script>
<script src="<?php bloginfo('template_url'); ?>/js/codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/codemirror/lib/codemirror.css" type="text/css" media="screen" />
<script src="<?php bloginfo('template_url'); ?>/js/codemirror/css.js"></script>
 <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("csscode"), {});
    </script>
		</div>
<?php  }else{ ?>
<div id="content">
	<?php get_sidebar();?>			
		<div class="login_ajax_content"><p>Login to submit</p>	<?php login_with_ajax() ?></div>
		</div>
<?php } ?>
<?php get_footer(); ?>
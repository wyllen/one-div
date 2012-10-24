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
		$err['msg'][] = 'Le champ "Titre" ne peut être vide.';
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
		<form method="post" action="<?php echo site_url().'/submit'; ?>">
			<p><label for="title">Titre</label><input type="text" name="title" id="title" value="" /></p>
	<p><label for="htmlcode">HTML code</label><textarea name="htmlcode" id="htmlcode" rows="10" cols="15"></textarea></p>
	<p><label for="csscode">CSS code</label><textarea name="csscode" id="csscode" rows="10" cols="15"></textarea></p>
	<p><label for="keywords">Tags</label><input type="text" name="keywords" id="keywords" value="" />&nbsp;( séparez les mots clés par des virgules )</p>
	<p><input type="submit" name="submit" value="enregistrer" /></p>
</form>
<p><?php echo isset($output) ? $output : '' ; ?></p>
		</div>
<?php  }else{ ?>
<div id="content">
	<?php get_sidebar();?>			
		<div class="login_ajax_content"><p>Login to submit</p>	<?php login_with_ajax() ?></div>
		</div>
<?php } ?>
<?php get_footer(); ?>
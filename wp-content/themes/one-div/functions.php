<?php
	date_default_timezone_set("Europe/Paris");

//custom post type pour les pictos
	register_post_type('pictos', array(
		'label'             => 'Pictos',
		'add_new_item'      =>'Ajouter un picto',
		'edit_item'         =>'Modifier un picto',
		'new_item'          =>'Ajouter un picto',
		'view_item'         =>'Voir le picto',
		'singular_label'    => 'pictos',  
		'public'            => true,
		'show_ui'           => true,
		'capability_type'   => 'post',
		'hierarchical'      => false,
		'has_archive'       => true,
		'rewrite'           => array('slug' => 'pictos'),
		'supports'          => array('title', 'editor','custom-fields', 'author', 'excerpt', 'thumbnail'),
		'show_in_nav_menus' => true
	)	
	);
	register_taxonomy( "pictos_categories", array( "pictos" ), array("hierarchical" => true, "label" => "Pictos catégories", "singular_label" => "Pictos catégories", "rewrite" => true, "slug" => 'pictos_categories' ) );
	
function creerFichier($fichierChemin, $fichierNom, $fichierExtension, $fichierContenu, $droit=""){
$fichierCheminComplet = $fichierChemin."/".$fichierNom;
if($fichierExtension!=""){
$fichierCheminComplet = $fichierCheminComplet.".".$fichierExtension;
}
 
// création du fichier sur le serveur
$leFichier = fopen($fichierCheminComplet, "wb");
fwrite($leFichier,$fichierContenu);
fclose($leFichier);
 
// la permission
if($droit==""){
$droit="0777";
}
 
// on vérifie que le fichier a bien été créé
$t_infoCreation['fichierCreer'] = false;
if(file_exists($fichierCheminComplet)==true){
$t_infoCreation['fichierCreer'] = true;
}
 
// on applique les permission au fichier créé
$retour = chmod($fichierCheminComplet,intval($droit,8));
$t_infoCreation['permissionAppliquer'] = $retour;
 
return $t_infoCreation;
}

 function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }	

function create_zip($files = array(),$destination = '',$overwrite = true) {
  //if the zip file already exists and overwrite is false, return false
  if(file_exists($destination) && !$overwrite) { return false; }
  //vars
  $valid_files = array();
  //if files were passed in...
  if(is_array($files)) {
    //cycle through each file
    foreach($files as $file) {
      //make sure the file exists
      if(file_exists($file)) {
        $valid_files[] = $file;
      }
    }
  }
  //if we have good files...
  if(count($valid_files)) {
    //create the archive
    $zip = new ZipArchive();
    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
      return false;
    }
    //add the files
    foreach($valid_files as $file) {
      $zip->addFile($file,$file);
    }
    //debug
    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
    
    //close the zip -- done!
    $zip->close();
    
    //check to make sure the file exists
    return file_exists($destination);
  }
  else
  {
    return false;
  }
} 
	

	

	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// AJOUT METAS BOX
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		add_action("admin_init", "admin_init");
	function admin_init(){ //initialisation des champs spécifiques
		add_meta_box("html", "HTML", "html", "pictos", "normal", "high");
		add_meta_box("css", "CSS", "css", "pictos", "normal", "high");
	}
	
	function html($post){
	$val = get_post_meta($post->ID,'_html_code',true);
    echo '<label for="html_code">Code HTML : </label>';
    echo '<textarea  name="html_code" id="html_code" cols="90" rows="2">'.$val.'</textarea>';
}

function css($post){
	$val = get_post_meta($post->ID,'_css_code',true);
    echo '<label for="css_code">Code CSS : </label>';
    echo '<textarea name="css_code" id="css_code" cols="90" rows="20">'.$val.'</textarea>';
}

add_action('save_post','save_metaboxes');
function save_metaboxes($post_ID){
	
	$newDir = realpath(__DIR__ . '/codes') . '/' .$post_ID;	
	 if(isset($_POST['html_code'])){
        update_post_meta($post_ID,'_html_code', esc_html($_POST['html_code']));		
		if(!file_exists($newDir)){
			mkdir($newDir);
		}	
		creerFichier($newDir,'html_code','html',$_POST['html_code'],0777);	
			$html_file=$newDir.'/html_code.html';
    }
	
	if(isset($_POST['css_code'])){
        update_post_meta($post_ID,'_css_code', esc_html($_POST['css_code']));
		if(!file_exists($newdir)){
			mkdir($newdir,0777);
		}
		creerFichier($newDir,'css_code','css',$_POST['css_code'],0777);
		$css_file=$newDir.'/css_code.css';
    }
	
	if(isset($_POST['html_code'])&& isset($_POST['css_code'])){
		$zip = new ZipArchive();
		$filename = $newDir."/".$post_ID.".zip";

	if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
		die("Impossible d'ouvrir <$filename>\n");
	}else{
	//die('ok'.$filename);
	  $zip->addFile($html_file, 'index.html');
	    $zip->addFile($css_file, 'style.css');
		$zip->close();
	}
		
	
	}
	
}

    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="title">',
        'after_title' => '</div>',
    ));

register_nav_menu( 'sidebar-menu', 'Sidebar' );

add_action('before_delete_post','delete_folder');
function delete_folder($post_ID){
$newDir = realpath(__DIR__ . '/codes') . '/' .$post_ID;
	rrmdir ($newDir);
}


add_filter('rewrite_rules_array', 'add_rewrite_rules');
function add_rewrite_rules($aRules){   
       $aNewRules = array('^popular$' => 'index.php?post_type=pictos&popular=1');
       $aRules = $aNewRules +  $aRules;
       return $aRules;
}
add_filter('query_vars', 'addnew_query_vars', 10, 1 );
function addnew_query_vars($vars){   
   $vars[] = 'popular';
   return $vars;
}

function order_popular( $query ) {
    if ( $query->is_post_type_archive('pictos') && $query->is_main_query() && $query->query_vars['popular'] ) {

         $query->set( 'meta_key' , 'ratings_score' );
		 $query->set( 'orderby' , 'meta_value_num' );
		  $query->set( 'order' , 'DESC' );
		
    }
}
add_action( 'pre_get_posts', 'order_popular' );

function deregister_jquery_base(){
  wp_deregister_script( 'jquery' );
 wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js');
 wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts','deregister_jquery_base');
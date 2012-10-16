<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="title" content="One div - The single element HTML/CSS icon database">
	<meta name="description" content="One div - The single element HTML/CSS icon database">
	<meta name="keywords" content="single,element, HTML, CSS, icon, pictos, database">
	<title>One div - The single element HTML/CSS icon database</title>	
		<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/16x16.ico" /></head>
<!--	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script> -->
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.zclip.min.js"></script> 
	
<body>
		<header id="header">
		<div id="logo">
			<a href="<?php echo home_url( '/' ); ?>" id="logo"><span class="pink chevron1"><</span><span class="baseline"><h1>The single element HTML/CSS icon database</h1></span><span class="pink chevron2">></span>ne div</a> <br />
			
		</div>
		<nav id="header_menu">
		<?php wp_nav_menu( array('menu' => 'Menu' )); ?>
		</nav>
		<div class="clear"></div>
		</header>
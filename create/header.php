<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_enqueue_script('jquery');?>
		<?php wp_enqueue_script('voter', get_bloginfo('template_url').'/js/voter.js', array('jquery'));?>
		<?php if (is_page('Contact')):?>
			<?php
				if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
					wpcf7_enqueue_scripts();
					//wpcf7_enqueue_styles();
				}
			?>
		
		<?php endif;?>
		<?php mf_customised_pages();?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
	<div id="site-wrapper">	
		<?php 
		$args = array(
		        'theme_location'=> 'main-navigation',
		        'container_id' 	=> 'navigation',
		        'fallback_cb'	=> 'wp_page_menu'
		        );
		    wp_nav_menu($args);
		 ?> 
	<div id="header">	
		<h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><span class="hidden-text"><?php bloginfo('name'); ?></span></a></h1>
	</div>
	<div id="content-wrapper">
	
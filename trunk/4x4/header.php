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
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<script src="<?php echo get_bloginfo('template_url'); ?>/scripts/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php bloginfo('template_url'); ?>/scripts/4x4_ui.js" type="text/javascript"></script>
		
		
		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>
	<div id="header">
		<h1><a href="<?php echo get_option('home'); ?>/"><img src="<?php echo  get_bloginfo('template_url'); ?>/style/images/4x4_logo.png" width="179" height="98" alt="<?php bloginfo('name'); ?>" /></a></h1>
		
		<ul id="nav">
			<?php //get_sidebar();
			$project_query = new WP_Query('post_type=project&orderby=menu_order');

				if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post(); ?>
			<a href="#project-<?php the_ID(); ?>"><li><?php the_title(); ?></li></a>
			
			<?php endwhile; endif; ?>
		</ul>
	<div id="prem">
	<h3>premiere</h3>
	<p>19<sup>th</sup> July<br />Wyvern Theatre</p>
	<a class="small-ital" href="http://maps.google.com/maps/ms?ie=UTF8&msa=0&msid=116672839499654081499.0004898bdeae87b14e74a&ll=51.558743,-1.781802&spn=0.009659,0.01929&z=16" target='_blank'>click for map</a>
	</div>	
	
	</div>	
		
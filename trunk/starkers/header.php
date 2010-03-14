<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<title>
			<?php if (is_home()) { echo bloginfo('name');
			} elseif (is_404()) {
			echo '404 Not Found';
			} elseif (is_category()) {
			echo 'Category:'; wp_title('');
			} elseif (is_search()) {
			echo 'Search Results';
			} elseif ( is_day() || is_month() || is_year() ) {
			echo 'Archives:'; wp_title('');
			} else {
			echo wp_title('');
			}
			?>
		</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo bloginfo('template_directory'); ?>/style/js/loopedslider.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo bloginfo('template_directory'); ?>/style/js/functions.js" type="text/javascript" charset="utf-8"></script>

	    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
		<meta name="description" content="<?php bloginfo('description') ?>" />
		<?php if(is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	    <?php }?>
	
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php wp_head(); ?>

	</head>

	<body>
		<div id="wrap">
	
		<div id="header">
			<div id="header_wrap">
			<h1 id="title"><a href="<?php echo get_option('home'); ?>/"><img src="<?php echo bloginfo('template_directory'); ?>/style/images/title.png" width="364" height="138" alt="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>" /></a></h1>
			
		
		<div id="nav_wrap">
			<div id="nav_wrap_top">
				<ul class="nav_element">
				<li>He specialises in </li>
				<li>He also shoots </li>
				<li>and </li>
				<li>amongst </li>
			</ul>
				<ul class="nav_element">
					
					<?php wp_list_categories('title_li=&orderby=slug&include=7,8,5,6'); ?>
				</ul>
				<ul id="nav_out" class="nav_element nav_out">
					<li>&nbsp;</li>
					<li>&nbsp;</li>
					<li>&nbsp;</li>
					<li id="menu_things">things</li>
				</ul>
			
		
			
			</div>
	
	
		
			<div id="nav_wrap_bottom">
				
				<img src="<?php echo bloginfo('template_directory'); ?>/style//images/header_brdr.png" alt="" />
				<br />	
					
				<ul class="nav_element">
				<li>He is available for </li>
				<li>He has all his own </li>
			</ul>
				<ul class="nav_element">
					<?php wp_list_pages('title_li=&include=35,18'); ?>
					
				</ul>
				<ul  class="nav_element  nav_out2">
					
					<li>&nbsp;</li>
					<li>which you can hire</li>
				</ul>
			</div><!--End nav-top-wrap-->
		</div><!--End nav-wrap-->
		</div><!--end header_wrap-->
		</div><!--end header-->
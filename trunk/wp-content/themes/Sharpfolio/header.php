<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> &middot; <?php bloginfo('description'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/reset.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" charset="utf-8" />
<!--<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/white.css" type="text/css" media="screen" charset="utf-8" />-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/legacy.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>

<div id="wrapper">

		<div id="header" class="clear">
			<div style="height:40px;"></div>
			<h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></h1>
			<div style="height:20px;"></div>
			<div style="font-family:Arial, Helvetica, sans-serif; font-size:1.5em; color:#666; text-align:left; margin-left:10px;"><i><?php bloginfo('description'); ?></i></div>
			
			<div style="height:40px;"></div>
			
			<ul id="navigation">
				<?php
wp_list_categories('exclude=4,7&title_li='); ?>

				<?php wp_list_pages('&title_li='); ?>
			</ul>
			
		</div>
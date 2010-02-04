<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title>
	<?php if ( is_home() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>
	<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Search Results',woothemes); ?><?php } ?>
	<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Author Archives',woothemes); ?><?php } ?>
	<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
	<?php if ( is_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>
	<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Archive',woothemes); ?>&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>
	<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Archive',woothemes); ?>&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>
	<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Tag Archive',woothemes); ?>&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>
	</title>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<link rel="stylesheet" type="text/css"  href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery-1.3.2.min.js"></script>
<?php wp_head(); ?>

<!--[if lte IE 6]>
<script defer type="text/javascript" src="<?php bloginfo('template_directory'); ?>/images/pngfix.js"></script>
<![endif]-->

<?php include(TEMPLATEPATH . '/includes/stylesheet.php'); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery.lavalamp.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/tabs.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/superfish.js"></script>    
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery.bgiframe.min.js"></script>     

<script type="text/javascript">
jQuery(document).ready(function($){
    $(".nav2")
    .superfish({
        animation : { opacity:"show",height:"show"}
    })
    .find(">li:has(ul)") 
        .mouseover(function(){
            $("ul", this).bgIframe({opacity:false});
        })
        .find("a")
            .focus(function(){
                $("ul", $(".nav>li:has(ul)")).bgIframe({opacity:false});

            });

    $(".cats-list")
    .superfish({
        animation : { opacity:"show",height:"show"}
    })
    .find(">li:has(ul)") 
        .mouseover(function(){
            $("ul", this).bgIframe({opacity:false});
        })
        .find("a")
            .focus(function(){
                $("ul", $(".nav>li:has(ul)")).bgIframe({opacity:false});

            });

        $("#lavaLamp, #2, #3").lavaLamp({
            fx: "backout", 
            speed: 700,
            click: function(event, menuItem) {
                return true;
            }
        });
    });
</script>        
 
</head>

<body>

<?php
	$featuredcat = get_option('woo_featured_category'); // ID of the Featured Category
	$GLOBALS[ex_feat] = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name='$featuredcat'");

	$vidcat = get_option('woo_video_category'); // ID of the Video Category
	$GLOBALS[ex_vid] = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name='$vidcat'");		
?>

<div id="page">
	
	<div id="nav"> <!-- START TOP NAVIGATION BAR -->
	
		<div id="nav-left">
	
			<ul id="lavaLamp">
				<li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
				<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>		
			</ul>
		
		</div><!--/nav-left -->

		<div id="nav-right">		
		
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				
				<div id="search">
					<input type="text" value="<?php _e('Enter your search keywords here...',woothemes); ?>" onclick="this.value='';" name="s" id="s" />
					<input name="" type="image" src="<?php bloginfo('stylesheet_directory'); ?>/styles/<?php echo "$style_path"; ?>/ico-go.gif" value="<?php _e('Go',woothemes); ?>" class="btn"  />
				</div><!--/search -->
				
			</form>
		
		</div><!--/nav-right -->
		
	</div><!--/nav-->
	
	<div id="header"><!-- START LOGO LEVEL WITH RSS FEED -->
		
		<h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php if ( get_option('woo_logo') <> "" ) {  echo get_option('woo_logo'); } else { ?><?php bloginfo('stylesheet_directory'); ?>/images/logo.gif<?php } ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a></h1>
		
		<div id="rss">
			
			<a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ico-rss.gif" alt="" /></a>
			
			<ul>
				<li class="hl"><a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('SUBSCRIBE TO THE RSS FEED',woothemes); ?></a></li>
				<li><a href="<?php echo get_option('woo_feedburner_id'); ?>" target="_blank"><?php _e('SUBSCRIBE TO THE FEED VIA E-MAIL',woothemes); ?></a></li>
			</ul>
			
		</div><!--/rss-->
		
	</div><!--/header -->
	
	<div id="suckerfish"><!-- START CATEGORY NAVIGATION (SUCKERFISH CSS) -->
		
			<ul class="nav2">
				<?php wp_list_categories('title_li=') ?>	
			</ul>
					
	</div><!--/nav2-->
	
	<div id="columns"><!-- START MAIN CONTENT COLUMNS -->
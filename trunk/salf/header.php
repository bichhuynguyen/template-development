<?php

	$url = get_post_meta(ID_ouside_loop(), 'mf_redirect_url');	
	if($url){
		header('Location: '.$url[0]);
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
xmlns:og="http://opengraphprotocol.org/schema/"
xmlns:fb="http://www.facebook.com/2008/fbml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />	
		<title>
			<?php bloginfo('name');
			?>
		</title>
		<?php // Hide Facebook---?>
		<meta property="fb:admins" content="706887311"/>
		<meta property="fb:app_id" content="130496703654288" />
		
		<?php if(is_home()) {?>
		<meta property="og:type" content="blog" />
		<meta property="og:title" content="DSC South Asian Literature Festival" /><?php
		} else {
		?>
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php the_title_attribute(); ?>" /><?php
		}
		?>
		<meta property="og:site_name" content="DSC South Asian Literature Festival"/>
		
		
		<?php if(is_single()):?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<meta property="og:image" content="<?php
		
		 get_attached_images();
		?>">
		<meta property="og:description"
		          content="<?php the_excerpt();?>"/>
		
		
		
		
		<?php 
		endwhile; 
		endif;
		wp_reset_query();
		?>
	
		<?php else:?>
		<meta property="og:image" content="<?php echo bloginfo('template_url'); ?>/style/images/mini_logo.jpg">	
		<?php endif; ?>
		<?php if (is_home())
		echo '<meta property="og:url" content="'.bloginfo('siteurl').'" />';
		else echo '<meta property="og:url" content="'.get_permalink().'" />';
		?>
		<?php /* Hide Facebook---*/?>
		
	    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
		<meta http-equiv="Content-Style-Type" content="text/css"/>
		<meta name="description" content="<?php bloginfo('description') ?>" />
		
		<meta name="description" content="The DSC South Asian Literature Festival is the UK’s first major literature festival dedicated to the rich and varied cultures of the South Asian Subcontinent, from India and Pakistan through to Bangladesh, Sri Lanka and Nepal. It is about showcasing a rich storytelling heritage in all its forms – imagery, film, music, dance and art through the central prism of words.">
		<meta name="keywords" content="DSC, South Asia, Asia, London, Amphora Arts, Amphora, South Asian Literature, London Literature Festival, Asian Literature, Assamese, Asomiya, Bengali, Bodo, Burmese, Dari, Dhivehi, Dogri, Dzongkha, English, Gujarati, Hindi, Kannada, Kashmiri, Konkani, Maithili, Malayalam, Marathi, Manipuri, Nepali, Oriya, Pashto, Persian, Punjabi, Sanskrit, Santhali, Sindhi, Sinhala, Siraiki, Tamil, Telugu, Tibetan, Urdu, London, Asian Books, Books, Language, Arts, Celebration, Indian Subcontinent, Bangladesh, Bhutan, India, Maldives, Nepal, Pakistan, Sri Lanka,Kings Place,Somerset House,Courtauld,Asia House,British Library,British Museum,Free Word Centre,Southbank Centre,Purcell Room,Shakespeares Globe,Rich Mix,Foyles,Waterstones,Blackwell,Aamer Hussein,Ali Sethi,Amit Choudhury,Amitava Kumar,Boria Majumdar,Chetan Bhagat,Daisy Hassan,Daljit Nagra,Daniyal Mueenuddin,Fatima Bhutto,Gautam Malkani,Geoff Dyer,Hanif Kureishi,Kamila Shamsee,Kishwar Desai,Mark Ramprakash,Meera Syal,Meghnad Desai,Mihir Bose,Moni Mohsin,Nayantara Sahgal,Nikesh Shukla,Piers Moore Ede,Rana Dasgupta,Romesh Gundasekara,Seema Anand,Sharmishta Gooptu,Shazia Omar,Siddharth Bose,Sir Mark Tully,Vayu Naidu,Vikram Seth,William Dalrymple,Booksellers Association,Booktrust,DIPNET,Livity,Live East,London Book Fair,German Book Office,Publishers Association ,Reading Agency,Society of Young Publishers,Spinebreakers,Independent Publishers Guild,Arts Council,British Council,Nehru Centre,Open University,Local Education Authorities,MLA,Museums Libraries Archives,GLA,Greater London Authority,Apples &amp; Snakes,Vayu Naidu,Company,Wasafiri,Asian Media and Marketing Group,FMcM,Fiona McMorrough,Surina Narula,Manhad Narula,DSC Prize for South Asian Literature,DSC Prize">
	    
	
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		

		<?php wp_head(); ?>
		<script src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_url'); ?>/scripts/salf_ui.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_url'); ?>/scripts/date.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_url'); ?>/scripts/datePicker.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_url'); ?>/scripts/voter.js" type="text/javascript"></script>
		
		
		
		<script language="javascript" src="<?php bloginfo('template_url'); ?>/scripts/tweet/jquery.tweet.js" type="text/javascript"></script>  
		<script type='text/javascript'>
		    $(document).ready(function(){
		        $(".dsc_tweet").tweet({
		            username: "SthAsianLitFest",
					
		            join_text: "auto",
		            avatar_size: 32,
		            count: 4,
		            auto_join_text_default: "",
		            auto_join_text_ed: "",
		            auto_join_text_ing: "",
		            auto_join_text_reply: "",
		            auto_join_text_url: "",
		            loading_text: "loading tweets..."
		        });
				$(".query_tweet").tweet({
		            query: "#salf",
					
		            join_text: "auto",
		            avatar_size: 32,
		            count: 4,
		            auto_join_text_default: "",
		            auto_join_text_ed: "",
		            auto_join_text_ing: "",
		            auto_join_text_reply: "",
		            auto_join_text_url: "",
		            loading_text: ""
		        }).bind("empty", function() { $(this).append("No matching tweets found"); });
				;
		    });
		</script>
	</head>

<body <?php body_class();?>>
	
		<script type="text/javascript">
		var templateDir = "<?php bloginfo('template_directory') ?>";
		</script>
		<noscript><h2 style="position: fixed; top: 30px; z-index: 3;font-size: 14px; width: 100%; text-align: center; color: #A91611; background: #F8F700; border-bottom: 3px solid #9D1111; height: 24px">This site works best with Javascript turned on. Certain things may look different with it turned off.</h2></noscript>
		<div class="top-message">
			<a href="http://www.bookmarketing.co.uk/surveys/dscsalf10.htm" target="_blank">Take part in our survey about reading habits, for a chance to win fantastic prizes</a><a class='hide' href="#" style="font-size: 18px;">&uarr;</a> 
		</div>
		<div id="header">
		<h1 style="float: left;">
			<a href="<?php echo get_option('home'); ?>/" >
				<img src="<?php echo bloginfo('template_url');?>/style/images/header_salf_main_logo.png" alt="<?php bloginfo('name'); ?>" />
			</a>
		</h1>
		<h2 style="float: right;">
			<a href="http://www.dsclimited.com/" target="_blank" >
				<img src="<?php echo bloginfo('template_url');?>/style/images/header_dsc_main_logo.png" alt="DSC - Principle Sponsor" />
			</a>
		</h2>
			
				
			
			
			
		</div>
		
			
		<div id="content-wrapper" class="wrapper">
			
			<div id="nav">
				 
				<?php 
				$args = array(
					'theme_location' => 'primary',
					'fallback_cb'=>'',
					'menu_id'=>'pages'
					);
				wp_nav_menu($args); ?>
				
				<a class="twitter" href="http://twitter.com/SthAsianLitFest" target="_blank"><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png" width="16" height="16" alt="Twitter" /></a>
				
				<div class="facebook-connect">
				<a href=# target="_blank" class="facebook"><img src="<?php echo bloginfo('template_url')?>/style/images/social/facebook.png" width="16" height="16" alt="Facebook" /></a>
				<div class="fb-iframe">
					<fb:fan name='southasianlitfest' 
					width='500' logobar="false"/>
				</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
			<!--Ajax Loader-->
			<div id="ajax_loader" style="display: none;">
				<img src="<?php echo bloginfo('template_url')?>/style/images/ajax-loader.gif" width="32" height="32" alt="Ajax Loader" />
			</div>
<div id="main-content-area"><!--USED FOR AJAX LOADING-->
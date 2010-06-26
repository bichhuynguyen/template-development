<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<title>
			<?php bloginfo('name');
			?>
		</title>

	    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
		<meta name="description" content="<?php bloginfo('description') ?>" />
		
		<meta name="description" content="The DSC South Asian Literature Festival is the UK’s first major literature festival dedicated to the rich and varied cultures of the South Asian Subcontinent, from India and Pakistan through to Bangladesh, Sri Lanka and Nepal. It is about showcasing a rich storytelling heritage in all its forms – imagery, film, music, dance and art through the central prism of words.">
		<meta name="keywords" content="DSC, South Asia, Asia, London, Amphora Arts, Amphora, South Asian Literature, London Literature Festival, Asian Literature, Assamese, Asomiya, Bengali, Bodo, Burmese, Dari, Dhivehi, Dogri, Dzongkha, English, Gujarati, Hindi, Kannada, Kashmiri, Konkani, Maithili, Malayalam, Marathi, Manipuri, Nepali, Oriya, Pashto, Persian, Punjabi, Sanskrit, Santhali, Sindhi, Sinhala, Siraiki, Tamil, Telugu, Tibetan, Urdu, London, Asian Books, Books, Language, Arts, Celebration, Indian Subcontinent, Bangladesh, Bhutan, India, Maldives, Nepal, Pakistan, Sri Lanka,Kings Place,Somerset House,Courtauld,Asia House,British Library,British Museum,Free Word Centre,Southbank Centre,Purcell Room,Shakespeares Globe,Rich Mix,Foyles,Waterstones,Blackwell,Aamer Hussein,Ali Sethi,Amit Choudhury,Amitava Kumar,Boria Majumdar,Chetan Bhagat,Daisy Hassan,Daljit Nagra,Daniyal Mueenuddin,Fatima Bhutto,Gautam Malkani,Geoff Dyer,Hanif Kureishi,Kamila Shamsee,Kishwar Desai,Mark Ramprakash,Meera Syal,Meghnad Desai,Mihir Bose,Moni Mohsin,Nayantara Sahgal,Nikesh Shukla,Piers Moore Ede,Rana Dasgupta,Romesh Gundasekara,Seema Anand,Sharmishta Gooptu,Shazia Omar,Siddharth Bose,Sir Mark Tully,Vayu Naidu,Vikram Seth,William Dalrymple,Booksellers Association,Booktrust,DIPNET,Livity,Live East,London Book Fair,German Book Office,Publishers Association ,Reading Agency,Society of Young Publishers,Spinebreakers,Independent Publishers Guild,Arts Council,British Council,Nehru Centre,Open University,Local Education Authorities,MLA,Museums Libraries Archives,GLA,Greater London Authority,Apples &amp; Snakes,Vayu Naidu,Company,Wasafiri,Asian Media and Marketing Group,FMcM,Fiona McMorrough,Surina Narula,Manhad Narula,DSC Prize for South Asian Literature,DSC Prize">
	    
	
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		

		<?php wp_head(); ?>
		<script src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_url'); ?>/scripts/salf_ui.js" type="text/javascript"></script>
		<script language="javascript" src="<?php bloginfo('template_url'); ?>/scripts/tweet/jquery.tweet.js" type="text/javascript"></script>  
		<script type='text/javascript'>
		    $(document).ready(function(){
		        $(".dsc_tweet").tweet({
		            username: "dsc_SALF",
					
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
		
		<div id="header">
		<h1><a href="<?php echo get_option('home'); ?>/"><span><?php bloginfo('name'); ?></span></a></h1>
		<p><?php bloginfo('description'); ?></p>
			
				
			
			
			
		</div>
		
			
		<div id="content-wrapper" class="wrapper">
			
			<div id="nav">
				<ul id="pages">
					<?php if(is_front_page()):?>
					<li class="page_item"><a href="#home" title="Home" id="home_btn">HOME</a></li>
					<li class="page_item"><a href="#about" title="About" id="about_btn">ABOUT</a></li>
					<li class="page_item"><a href="#venues" title="Venues" id="venues_btn">VENUES</a></li>
					<li class="page_item"><a href="#events" title="Venues" id="events_btn">EVENTS</a></li>
					<li class="page_item"><a href="#partners" title="Partners" id="partners_btn">PARTNERS</a></li>
					<li class="page_item"><a href="#enquiries" title="Venues" id="enquiries_btn">ENQUIRIES</a></li>
					<?php else:?>
					<li class="page_item"><a href="<?php bloginfo('home'); ?>?sel=home" title="Home" id="home_btn">HOME</a></li>
					<li class="page_item"><a href="<?php bloginfo('home'); ?>?sel=about" title="About" id="about_btn">ABOUT</a></li>
					<li class="page_item"><a href="<?php bloginfo('home'); ?>?sel=venues" title="Venues" id="venues_btn">VENUES</a></li>
					<li class="page_item"><a href="<?php bloginfo('home'); ?>?sel=events" title="Venues" id="events_btn">EVENTS</a></li>
					<li class="page_item"><a href="<?php bloginfo('home'); ?>?sel=partners" title="Partners" id="partners_btn">PARTNERS</a></li>
					<li class="page_item"><a href="<?php bloginfo('home'); ?>?sel=enquiries" title="Venues" id="enquiries_btn">ENQUIRIES</a></li>
					<?php endif;?>
				</ul>	
				
				<?php get_sidebar(); ?>
			</div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<title>
			<?php bloginfo('name');
			?>
		</title>

	    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
		<meta name="description" content="<?php bloginfo('description') ?>" />
		<?php if(is_search()) { ?>
		<meta name="description" content="The DSC South Asian Literature Festival is the UK’s first major literature festival dedicated to the rich and varied cultures of the South Asian Subcontinent, from India and Pakistan through to Bangladesh, Sri Lanka and Nepal. It is about showcasing a rich storytelling heritage in all its forms – imagery, film, music, dance and art through the central prism of words.">
		<meta name="keywords" content="DSC, South Asia, Asia, London, Amphora Arts, Amphora, South Asian Literature, London Literature Festival, Asian Literature, Assamese, Asomiya, Bengali, Bodo, Burmese, Dari, Dhivehi, Dogri, Dzongkha, English, Gujarati, Hindi, Kannada, Kashmiri, Konkani, Maithili, Malayalam, Marathi, Manipuri, Nepali, Oriya, Pashto, Persian, Punjabi, Sanskrit, Santhali, Sindhi, Sinhala, Siraiki, Tamil, Telugu, Tibetan, Urdu, London, Asian Books, Books, Language, Arts, Celebration, Indian Subcontinent, Bangladesh, Bhutan, India, Maldives, Nepal, Pakistan, Sri Lanka">
	    <?php }?>
	
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php wp_head(); ?>

	</head>

<body <?php body_class();?>>
	
		<div id="header">
		<h1><a href="<?php echo get_option('home'); ?>/"><span><?php bloginfo('name'); ?></span></a></h1>
		<p><?php bloginfo('description'); ?></p>
			
				
			
			
			
		</div>
		
			
		<div id="content-wrapper">
			<div id="nav">
				<ul id="pages">

					<li class="page_item page-item-2 current_page_item"><a href="#post-2" title="About">ABOUT</a></li>
					<li class="page_item page-item-7"><a href="#partners" title="Partners">PARTNERS</a></li>
					<li class="page_item page-item-6"><a href="#venues" title="Venues">VENUES</a></li>
					<li class="page_item page-item-6"><a href="#enquiries" title="Venues">ENQUIRIES</a></li>

				</ul>	

				<?php get_sidebar(); ?>
			</div>
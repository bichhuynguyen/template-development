<?php
/*
Template Name: Holding Page
*/
?>
<?php get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><img src="<?php echo bloginfo('template_url'); ?>/style/images/new/about_blurb.png" width="235" height="86" alt="Britain's first major festival celebrating South Asian literature"></h2>
		<?php// the_title(); ?>
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			<?//php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		<?php endwhile; endif; ?>
	<?php// edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		<div id="partners" class="post">		
		<h2><img class="text" src="<?php echo bloginfo('template_url'); ?>/style/images/partners-blurb.png" width="237" height="144" alt="the list of partners continues to grow"></h2>
		
		<img class="logos" src="<?php echo bloginfo('template_url'); ?>/style/images/partners-logo.jpg" width="512" height="354" alt="Partners Logo">
		
		<ul id="partner-links">
			<li><a href="http://www.foyles.co.uk/">Foyles</a></li>
			<li><a href="http://www.ipg.uk.com/">iipg</a></li>
			<li><a href="http://www.britishcouncil.org">British Council</a></li>
			<li><a href="http://www.applesandsnakes.org/">Apples &amp; Snakes</a></li>
			<li><a href="http://www.open.ac.uk/">The Open University</a></li>
			<li><a href="http://www.amg.biz/">AMG</a></li>
			<li><a href="http://www.nehrucentre.org.uk/">The Nehru Centre</a></li>
			<li><a href="http://www.readingagency.org.uk/">The Reading Agency</li>
			<li><a href="http://www.freewordonline.com/">Free Word</a></li>
			<li><a href="http://www.publishers.org.uk/en/home/">The Publishers Association</a></li>
			<li><a href="http://www.wasafiri.org/">Wasafari</a></li>
			<li><a href="http://www.bl.uk/">British Library</a></li>
			<li><a href="http://www.booktrust.org.uk/Home">Booktrust</a></li>
			<li><a href="http://www.vayunaiducompany.org.uk/">Vaya Naidu Company</a></li>
			<li><a href="http://www.spinebreakers.co.uk/Pages/Home.aspx">Spine Breakers</a></li>
			<li><a href="http://www.richmix.org.uk/">Richmix</a></li>
			<li><a href="http://www.dipnet.org.uk/">DIPNET</a></li>
			<li><a href="http://www.kingsplace.co.uk/">Kings Place</a></li>
			<li><a href="http://www.artscouncil.org.uk/">Arts Council England</a></li>
			<li><a href="http://www.livity.co.uk/">Livity</a></li>
			<li><a href="http://www.booksellers.org.uk/">The Booksellers Association</a></li>
		</ul>
		
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		<div id="venues" class="post">		
					
					
		<h2><img src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_text.png" width="237" height="144" alt="Events taking place across London"></h2>
		<div id="venue_images">
		<img class="venue_image" src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_free_world_centre.jpg" width="166" height="130" alt="Venues Free World Centre">
		<img class="venue_image" src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_kings_place.jpg" width="166" height="130" alt="Venues Kings Place">
		<img class="venue_image" src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_london_british_library.jpg" width="166" height="130" alt="Venues London British Library">
		<img class="venue_image" src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_rich_mix.jpg" width="166" height="130" alt="Venues Rich Mix">
		<img class="venue_image" src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_schools.jpg" width="166" height="130" alt="Venues Schools">
		<img class="venue_image" src="<?php echo bloginfo('template_url'); ?>/style/images/new/images/venues_libraries.jpg" width="166" height="130" alt="Venues Libraries">
	
		
		
		</div>
					
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
		
		
		
		<div id="enquiries" class="post">
			<img src="<?php echo bloginfo('template_url'); ?>/style/images/contact-blurb.png" width="237" height="144" alt="Contact Blurb">
				<?php echo do_shortcode('[contact-form 1 "Contact form 1"]') ?> 
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		<div id="events" class="post">
			<?php
			query_posts( array( 'post_type' => 'event') );
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<h3><?php the_title();?>	</h3>
			<p style="float: right"><?php the_content();?></p>
			<?php endwhile; else:?>
			 
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>
		
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
<?php get_footer(); ?>
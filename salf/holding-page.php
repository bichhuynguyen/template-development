<?php
/*
Template Name: Holding Page
*/
?>
<?php get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="home">
			<h2><img src="<?php echo bloginfo('template_url'); ?>/style/images/home-page-header-para.png" alt="Britain's first major festival celebrating South Asian literature" ></img></h2>
		<?php// the_title(); ?>
			<?php //the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			<?//php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php endwhile; endif; ?>
			
			<div class="news">
				<a class="news-top" href="<?php bloginfo('rss_url'); ?>"><img  src="<?php echo bloginfo('template_url'); ?>/style/images/news-top.png"  alt="News Top"></a><span style="opacity: 0;"class="subscribe-hint">Get RSS Feed&nbsp;<img style="float: right;"src="<?php echo bloginfo('template_url'); ?>/style/images/social/feed.png" width="16" height="16" alt="Feed"></span>
			<div id="news-feed">
			<?php
			$teacher_query = new WP_Query('post_type=post');
			if ($teacher_query->have_posts()) : while ($teacher_query->have_posts()) : $teacher_query->the_post(); ?>



				
					
						
					
					
					

					<div class="new-entry">
						<a href="<?php the_permalink();?>"><h2><?php the_date('j-n-y');?>     <?php the_title(); ?></h2></a>
						<?php mf_post_thumbnail('med-cropped');?>
						<?php the_excerpt(); ?>
						<script type="text/javascript">
						function getTinyUrl($url) {   
						     $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);  
						     return $tinyurl;  
						}
						var twtTitle  = "Just reading '<?php the_title(); ?>'";

						var tinyUrl = "<?php 

							echo getTinyUrl(get_permalink(get_the_ID()));?>";

						var twtLink =  'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + tinyUrl + " #salf");
						document.write('<a class="twitter" href="'+twtLink+'" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /'+'><'+'/a>');
						</script>
						<noscript><a class="twitter" href="http://twitter.com/home?status=<?php echo getTinyUrl(get_permalink(get_the_ID()));?>" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /></a></noscript>

						<span class="facebook-connect">
						<a href=# target="_blank" class="facebook"><img src="<?php echo bloginfo('template_url')?>/style/images/social/facebook.png" width="16" height="16" alt="Facebook" /></a>
						<iframe class="facebook" src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="width:450px; height:60px"></iframe class="facebook">
						</span>
					</div>
					
					
					
					




					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
			</div><!--End news-feed-->
			
			<div class="dsc_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-from.png" width="150" height="25" alt="TWEETS FROM US"></H2></div>
			<div class="query_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-about.png" width="150" height="25" alt="TWEETS ABOUT US"></H2></div>
				
			</div><!--End news-feed-->	   	
			
			
			
		
		
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
	<?php// edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		<div id="partners" class="post">		
		<h2><img class="text" src="<?php echo bloginfo('template_url'); ?>/style/images/partners-blurb.png" alt="the list of partners continues to grow" ></img></h2>
		
		<img class="logos" src="<?php echo bloginfo('template_url'); ?>/style/images/partners-logo.png" alt="Partners Logo" ></img>
		
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
					
					
		<h2><img src="<?php echo bloginfo('template_url'); ?>/style/images/venues_blurb.png"  alt="Events taking place across London" ></img></h2>
		<div id="venue_images">
			<?php
			query_posts( array( 'post_type' => 'Venues') );
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<div class="venue-box">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('venue-images');
			} 
			?>
			<p><?php the_title();?></p>
			
			</div>
			<?php endwhile; else:?>
			 
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>
	
		
		
		</div>
					
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
		
		
		
		<div id="enquiries" class="post">
			<img src="<?php echo bloginfo('template_url'); ?>/style/images/contact-blurb.png" alt="Contact Blurb" ></img>
				<?php echo do_shortcode('[contact-form 1 "Contact form 1"]') ?> 
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
		<?php if(function_exists('add_custom_background')):?>
			
		<div id="events" class="post">
			
			<img src="<?php echo bloginfo('template_url'); ?>/style/images/Events-title.png" alt="Events Title">
			<div id="event-type-boxes">
			<?php
			query_posts( array( 'post_type' => 'Events') );
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<div class="event-type-box">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} 
			?>
			<h3><?php the_title();?>	</h3>
			<p style="float: right"><?php the_content();?></p>
			</div>
			<?php endwhile; else:?>
			 
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>
			</div>
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		<?php endif;?>
		
		
		<?php if(function_exists('add_custom_background')):?>
			
			
		<div id="about" class="post">
			<?php
			$about_query = new WP_Query('post_type=Partners&pages=about&orderby=menu_order');
			
			if ( $about_query->have_posts() ) : while ( $about_query->have_posts() ) : $about_query->the_post();?>
			<div class="partner-box">
			<h2>
			<?php
			if ( has_post_thumbnail() ) {
					the_post_thumbnail('partner-titles');
				} else {
					the_title();
				}
			?>
			</h2>
		<div class='partner-content'>
			<?php the_content();?>
			<?php
			/*People Loop
			--------------*/
			
			$taxonomies=get_the_term_list($post->ID,'Partners','','','');
		
			$taxonomies = explode('>',$taxonomies);
			
			$taxonomies = $taxonomies[1];
			
		
			$people = new WP_Query('post_type=People&partners='.$taxonomies.'&orderby=menu_order');?>			
			<?php if ($people->have_posts()) : while ($people->have_posts()) : $people->the_post(); ?>
			<div class="people-bio-content">
			
			
			<h3><?php the_title();?></h3>
			
			
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
				} 
			?>
			<?php the_content();?>
			</div>
			<?php endwhile; else:?>
			<?php endif;?>
			<?php
			/*--------------
			People Loop End*/?>
					</div><!--partner-content end-->
					<img style="
						display: block;
						margin: 0 auto;
					" src="<?php echo bloginfo('template_url'); ?>/style/images/partner-border.png" width="900" height="1" />
			</div><!--partner-box end-->
			
			<?php endwhile; else:?>
			 
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>
	
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		<?php endif;?>
		<div id="volunteer" class="post">
			<img src="<?php echo bloginfo('template_url');?>/style/images/volunteer.png" alt="Volunteer" />
			<div class="intro-copy">
				<p>We are looking for volunteers with the right passion for literature and events to join our team in the busy period from now through to the Festival, which begins mid-October. Relevant experience and a degree are important, but we welcome applications of interest from anyone who believes they have the skills, energy and time to successfully carry out specific roles.</p>
				<p>In return you get the chance to work with a brilliant team of people, meet some fantastic authors and gain some great experience working with some of the best arts venues, people and organisations in the business.</p>  
				<p>If you have tons of initiative, are highly organised with good people skills and love working in a busy environment then get in touch by emailing <a href="mailto:volunteer@southasianlitfest.com">volunteer@southasianlitfest.com</a>, referencing which roles you would like to apply for.</p>
				
			</div>
				<img style="
					display: block;
					margin: 0 auto;
				" src="<?php echo bloginfo('template_url'); ?>/style/images/partner-border.png" width="900" height="1" />
			<div id="volunteer-options">
			<?php
			$volunteer_query = new WP_Query('post_type=Volunteer&orderby=menu_order');
			
			if ( $volunteer_query->have_posts() ) : while ( $volunteer_query->have_posts() ) : $volunteer_query->the_post();?>
				<div class="volunteer-content">
					<h2>
						<?php the_title(); ?>
					</h2>
						
						<?php the_content(); ?>
						<a href="mailto:volunteer@southasianlitfest.com?subject=Volunteer:<?php urlencode(the_title());?>">Contact Us</a>
				</div>
				
			<?php endwhile; else:?>
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>	
			</div>	
			</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
		
<?php get_footer(); ?>
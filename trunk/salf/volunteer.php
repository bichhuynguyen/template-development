<?php
ob_start();

/*
Template Name: Volunteer Page
*/
?>
<?php get_header(); ?>

		
	
		<div id="volunteer" class="post">
			<img src="<?php echo bloginfo('template_url');?>/style/images/volunteer.png" alt="Volunteer" />
			<div class="intro-copy">
				<p>We are looking for volunteers with the right passion for literature and events to join our team in the busy period from now through to the Festival, which begins mid-October. Relevant experience and a degree are important, but we welcome applications of interest from anyone who believes they have the skills, energy and time to successfully carry out specific roles.</p>
				<p>We’ll also be posting up roles that will only be required during the main Festival period, if you want to help but don’t have too much time to commit. </p>
				<p>In return you get the chance to work with a brilliant team of people, meet some fantastic authors and gain some great experience working with some of the best arts venues, people and organisations in the business.</p>  
				<p>If you have tons of initiative, are highly organised with good people skills and love working in a busy environment then get in touch by emailing <a href="mailto:volunteer@southasianlitfest.com">volunteer@southasianlitfest.com</a>, referencing which roles you would like to apply for.</p>
				
			</div>
			
			
			<ul id="volunteer-jump-menu">
				<li><h3>Opportunities Available</h3></li>
				<?php $volunteer_menu_query = new WP_Query('post_type=Volunteer&orderby=menu_order&posts_per_page=-1');
				if ( $volunteer_menu_query->have_posts() ) : while ( $volunteer_menu_query->have_posts() ) : $volunteer_menu_query->the_post();?>
				
				<li><a href="#oppurtunity-<?php the_ID();?>"><?php the_title(); ?></a></li>
				<?php endwhile; else:?>
				<?php endif;
				//Reset Query
				wp_reset_query();
				?>
			</ul>
				<img style="
					display: block;
					margin: 0 auto;
				" src="<?php echo bloginfo('template_url'); ?>/style/images/partner-border.png" width="900" height="1" />
			<div id="volunteer-options">
			<?php
			$volunteer_query = new WP_Query('post_type=Volunteer&orderby=menu_order&posts_per_page=-1');
			
			if ( $volunteer_query->have_posts() ) : while ( $volunteer_query->have_posts() ) : $volunteer_query->the_post();?>
				<div class="volunteer-content" id="oppurtunity-<?php the_ID();?>">
					<h2>
						<?php the_title(); ?>
					</h2>
						<a href="mailto:volunteer@southasianlitfest.com?subject=Volunteer:<?php urlencode(the_title());?>">Contact Us</a>
						<div class="volunteer-text">
						<?php the_content(); ?>
						
						</div>
						
				</div>
				
			<?php endwhile; else:?>
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>	
			</div>	
		</div>
		
		
		
<?php get_footer(); ?>
<?php
ob_start();

/*
Template Name: Team Page
*/
?>
<?php get_header(); ?>

		
		<div id="speakers" class="post speakers">
			
			<img src="<?php echo bloginfo('template_url'); ?>/style/images/team_title.png" alt="Events Title">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="clear"><?php the_content(); ?></div>
			<?php endwhile; endif; ?>
			<div id="event-type-boxes">
			<?php
			query_posts( array( 'post_type' => 'People','partners'=>'festival', 'orderby' => 'menu_order', 'order'=>'asc','nopaging'=>true) );
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();?>
					
						<div class="archive-link new-entry">
							<?php
							$job_title = " - ".get_post_meta(get_the_ID(),'mf_job_title', true);
							
							?>
							<h2>     <?php the_title(); ?><?php echo $job_title;?></h2>
								
							<?php mf_post_thumbnail('small-cropped');?>
							<?php the_excerpt(); ?>
							<?php
							$name = get_the_title();
							$name = explode(" ", $name);
							$first_name = $name[0];
							$email = get_post_meta(get_the_ID(),'mf_email', true);
							if ($email):
							?>
							<a href="mailto:<?php echo get_post_meta(get_the_ID(),'mf_email', true);?>" title="Contact <?php echo $first_name; ?>">Contact <?php echo $first_name; ?></a>
							<?php endif; ?>

						</div>

					


			
			<?php endwhile;?>
				<div class="custom-pagination">

				<div class="alignleft"><?php //previous_posts_link('&laquo; Previous') ?></div>

				<div class="alignright"><?php //next_posts_link('More &raquo;') ?></div>
				
			<?php else:?>
			 
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>
			</div>
		</div>
		
		
<?php get_footer(); ?>
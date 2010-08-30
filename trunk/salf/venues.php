<?php
ob_start();

/*
Template Name: Venues Page
*/
?>
<?php get_header(); ?>

		
		<div id="venues" class="post">		
					
					
		<h2><img src="<?php echo bloginfo('template_url'); ?>/style/images/venues_blurb.png"  alt="Events taking place across London" ></img></h2>
		<div id="venue_images">
			<?php
			query_posts( array( 'post_type' => 'Venues') );
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			
			<div class="venue-box">
				<a class='venue' href="<? the_permalink();?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('venue-images');
			} 
			?>
			<p><?php the_title();?></p>
			</a>
			</div>
			
			<?php endwhile; else:?>
			 
			<?php endif;
			//Reset Query
			wp_reset_query();
			?>
	
		
		
		</div>
					
		</div>
		
<?php get_footer(); ?>
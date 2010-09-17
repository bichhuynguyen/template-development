<?php
ob_start();

/*
Template Name: Events Page
*/
?>
<?php get_header(); ?>

		
		<div id="events" class="post">
			
			<img src="<?php echo bloginfo('template_url'); ?>/style/images/Events-title.png" alt="Events Title">
			<div id="event-type-boxes">
			<?php
			query_posts( array( 'post_type' => 'Events', 'orderby' => 'title', 'order'=>'asc') );
			
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
		
		
<?php get_footer(); ?>
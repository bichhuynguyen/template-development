<?php
ob_start();

/*
Template Name: About Page
*/
?>
<?php get_header(); ?>

		
	

		
			
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
		
		
		
		
		
<?php get_footer(); ?>
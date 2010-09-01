<?php
/*
Template Name: News Page
*/
?>
<?php get_header(); ?>

		
		<div class="post archive-page">
			<div id="browse-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/Browse.png"  alt="Browse" />
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			</div>
			<div id="news-archive">
				<div class="archive-type category">
				<h3>Browse by Category</h3>
				<ul>
				<?php $args = array(
					'title_li'	=> ''
					/*
				    'type'            => 'monthly',
				    
				    'format'          => 'html', 
				    
				    'show_post_count' => false,
				    'echo'            => 1 */); 
					wp_list_categories( $args );?>
				</ul>
				</div>
				<div class="archive-type date">
				<h3>Browse by Date</h3>
				<ul>
				<?php $args = array(
				    'type'            => 'monthly',
				    
				    'format'          => 'html', 
				    
				    'show_post_count' => false,
				    'echo'            => 1 ); 
					wp_get_archives( $args );?>
				</ul>
				</div>
				<div class="archive-type category">
				<h3>Browse by Author</h3>
				<ul>
				<?php $args = array(
					'exclude_admin'	=>	false
					/*
				    'type'            => 'monthly',
				    
				    'format'          => 'html', 
				    
				    'show_post_count' => false,
				    'echo'            => 1 */); 
					wp_list_authors( $args );?>
				</ul>
				</div>
				
				
			</div>
			
			<div class="news archive-header">
				
			<div id="news-feed">
			<?php
			$news_query = new WP_Query('post_type=post');
			if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); ?>



				
					
						
					
					
					
				<a href="<?php the_permalink();?>">
					<div class="archive-link new-entry">
						<h2>     <?php the_title(); ?></h2><div class="post-details"><?php the_time('l, F jS, Y') ?></div>
						<?php mf_post_thumbnail('small-cropped');?>
						<?php the_excerpt(); ?>
						
						
					</div>
					
				</a>	
					
					




					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
					
				
			</div><!--End news-feed-->
			
				
				
			</div><!--End post-->	   	
			<div style="float: left;"class="tag-cloud">
			
				<?php $args = array(
				    'smallest'  => 8, 
				    'largest'   => 22,
				    'unit'      => 'pt', 
				    'number'    => 45,  
				    'format'    => 'flat',
				    //'separator' => '\n',
				    'orderby'   => 'name', 
				    'order'     => 'ASC',
				    //'exclude'   => , 
				    //'include'   => , 
				    'link'      => 'view', 
				    'taxonomy'  => 'post_tag', 
				    'echo'      => true ); ?>
				<?php wp_tag_cloud($args); ?> 
			</div>
			
			
		
		
		
	
		
	

		
		
		
		
		
		
	
		
		
<?php get_footer(); ?>
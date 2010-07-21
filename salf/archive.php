<?php
/*
Template Name: News
*/
?>
<?php get_header(); ?>

		
		<div class="post" id="home">
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2>Archive for <?php the_time('F, Y'); ?></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2>Archive for <?php the_time('Y'); ?></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2>Author Archive</h2>
			<?php } ?>
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
				<h3>Browse by Category</h3>
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
			
			<div class="news">
				<a class="news-top" href="<?php bloginfo('rss_url'); ?>"><img  src="<?php echo bloginfo('template_url'); ?>/style/images/news-top.png"  alt="News Top"></a><span style="opacity: 0;"class="subscribe-hint">Get RSS Feed&nbsp;<img style="float: right;"src="<?php echo bloginfo('template_url'); ?>/style/images/social/feed.png" width="16" height="16" alt="Feed"></span>
			<div id="news-feed">
			<?php
			
			if (have_posts()) : while (have_posts()) : the_post(); ?>



				
					
						
					
					
					

					<a href="<?php the_permalink();?>">
						<div class="new-entry">
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
				
			</div><!--End post-->	   	
			
			
			
		
		
		</div>
	
		
	

		
		
		
		
		
		
	
		
		
<?php get_footer(); ?>
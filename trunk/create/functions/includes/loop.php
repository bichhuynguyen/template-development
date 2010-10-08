
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
	<div class='post_details'>
		<h2><?php the_title(); ?></h2>
		<?php
		$date_display = get_post_meta(get_the_ID(), 'mf_date_display', true);//checks to see if date should be displayed based on meta box
		if ($date_display !== 'on'):?>
		<span class='date'><?php the_date('j F, Y');?></span>
		<?php endif?>
	</div>
	<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
	<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	
	<br />
	
	<?php if(is_single()):?>
		<?php previous_post_link('&laquo; %link&#124;') ?><?php next_post_link('&#124;%link &raquo;') ?>
		
	<?php endif;?>
	
	
	
</div>
<?php comments_template(); ?>
<?php endwhile; endif; ?>
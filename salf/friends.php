<?php
/*
Template Name: Freinds Page
*/
?>
<?php get_header(); ?>

		
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<div id="friends-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/friends_title.png"  alt="Browse" />
			<!--><h2><?php the_title(); ?></h2>-->
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php mf_post_thumbnail('large-cropped');?>
				<h2><?php the_title(); ?></h2>
				<div class="paypal">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="MHMJ4ZGY4V3TS">
					<table>
					<tr><td><input type="hidden" name="on0" value="membership">Become a Festival Friend</td></tr><tr><td><select name="os0">
						<option value="Single">Single £25.00</option>
						<option value="Joint">Joint £40.00</option>
						<option value="Gold">Gold £200.00</option>
					</select> </td></tr>
					</table>
					<input type="hidden" name="currency_code" value="GBP">
					<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
					</form>


				</div>
				<div class='the_content'>
					<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
				</div>
			<?//php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<?php endwhile; endif; ?>
	
	<?php// edit_post_link('Edit this entry.', '<p>', '</p>');?>



<?php get_footer(); ?>
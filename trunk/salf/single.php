<?php get_header(); ?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			
			<?php mf_post_thumbnail('large-uncropped');?>
			<h2><?php the_title(); ?></h2>
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

				<?php /*<p>
				This entry was posted
			 This is commented, because it requires a little adjusting sometimes.
					You'll need to download this plugin, and follow the instructions:
					http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
					/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago';  ?>
				on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
				and is filed under <?php the_category(', ') ?>.
				You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.

				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
					// Both Comments and Pings are open ?>
					You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

				<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
					// Only Pings are Open ?>
					Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
					// Comments are open, Pings are not ?>
					You can skip to the end and leave a response. Pinging is currently not allowed.

				<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
					// Neither Comments, nor Pings are open ?>
					Both comments and pings are currently closed.

				<?php } edit_post_link('Edit this entry','','.'); 
			</p>
				<ul>
					<li><?php next_post_link('&laquo; Older Entries') ?></li>
					<li><?php previous_post_link('Newer Entries &raquo;') ?></li>
				</ul>
			
			*/
			
			?>
				<script type="text/javascript">
				function getTinyUrl($url) {   
				     $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);  
				     return $tinyurl;  
				}
				var twtTitle  = "Just reading '<?php the_title(); ?>'";
			 
				var tinyUrl = "<?php 
					
					echo getTinyUrl(get_permalink(get_the_ID()));?>";
				
				var twtLink =  'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + tinyUrl + " #salf");
				document.write('<a href="'+twtLink+'" target="_blank"'+'><img src="tweetthis.gif"  border="0" alt="Tweet This!" /'+'><'+'/a>');
				</script>
				
				

				<iframe class="facebook" src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:60px"></iframe class="facebook">

				
		</div>


		
	
	
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>

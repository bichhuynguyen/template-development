<?php?>
<script src="<?php bloginfo('template_url'); ?>/scripts/voter.js" type="text/javascript"></script>
<div id="votes">
				<?php 	
				$ip=$_SERVER['REMOTE_ADDR'];
				$id = get_the_ID();
				$thumbs = get_post_meta($id,'thumbsup');
				?>
				
				<?php if(!in_array($ip, $thumbs)):?>
				
					<form class='voter up' method='post' action="<?php bloginfo('template_url'); ?>/form_scripts/voter.php">
						
						<input type='hidden' name="ip" value="<?php echo $ip; ?>">
						<input type='hidden' name="curl" value="<?php echo curPageURL(); ?>">
						<input type='hidden' name="post_id" value="<?php echo $id; ?>">
						<input class="thumbs up" type="submit" value="Vote">
					</form>
				<?php else:?>
					<form class='voter down' method='post' action="<?php bloginfo('template_url'); ?>/form_scripts/voter.php?remove=true">
						<input type='hidden' name="ip" value="<?php echo $ip; ?>">
						<input type='hidden' name="curl" value="<?php echo curPageURL(); ?>">
						<input type='hidden' name="post_id" value="<?php echo $id; ?>">
						<input class="thumbs down" type="submit" value="Undo Vote">
					</form>
				<?php endif;?>
				<p id="vote_count"><span class="number"><?php echo count($thumbs);?></span> Votes</p>
				</div><!--VOTES END-->
				<div id="comment_block">
				<?php comments_template( '', true ); ?>
				</div>
<?php?>
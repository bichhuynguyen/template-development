<?php?>

<div class="votes">
				<?php 	
				$ip=$_SERVER['REMOTE_ADDR'];
				$id = get_the_ID();
				$thumbs = get_post_meta($id,'thumbsup');
				?>
				
				<?php if(!in_array($ip, $thumbs)):?>
				
					<form class='voter up' method='post' action="<?php bloginfo('template_url'); ?>/form_scripts/voter.php">
						
						<input type='hidden' name="ip" value="<?php echo $ip; ?>" />
						<input type='hidden' name="curl" value="<?php echo curPageURL(); ?>" />
						<input type='hidden' name="post_id" value="<?php echo $id; ?>" />
						<input class="chimp thumbs up" type="submit" value="I Like This" />
					</form>
				<?php else:?>
					<form class='voter down' method='post' action="<?php bloginfo('template_url'); ?>/form_scripts/voter.php?remove=true" />
						<input type='hidden' name="ip" value="<?php echo $ip; ?>" />
						<input type='hidden' name="curl" value="<?php echo curPageURL(); ?>" />
						<input type='hidden' name="post_id" value="<?php echo $id; ?>" />
						<input class="chimp thumbs down" type="submit" value="Undo Vote" />
					</form>
				<?php endif;?>
				
				<p class="vote_count"><span class="voter_loader" style="display: none;" >
					<img src="<?php echo bloginfo('template_url')?>/style/images/voter-loader.gif" width="12" height="12" alt="Ajax Loader">
				</span>
				<span class="number">
				<?php echo count($thumbs);?></span> 
				<?php if (count($thumbs) != 1) : ?>
					<span class="vote_grammer">people like</span>
				<?php else: ?>
					<span class="vote_grammer">person likes</span>
				<?php endif; ?> this book.
				<span class="bethefirst">
				<?php if (count($thumbs)==0) echo "Be the first!"; ?>
				</span></p>
				</div><!--VOTES END-->
			
				
<?php?>
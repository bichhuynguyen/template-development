<?php get_header(); ?>

<?php include (TEMPLATEPATH . "/left.php"); ?>

<div id="content">

<?php query_posts('showposts=1'); ?>

	<?php if (have_posts()) :?>

		<?php $postCount=0; ?>

		<?php while (have_posts()) : the_post();?>

			<?php $postCount++;?>

	<div class="entry entry-<?php echo $postCount ;?>">
		<div class="entrytitle">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 
			<br /><h4><?php the_time('F jS, Y') ?> | <?php the_category(', ') ?> | <?php comments_popup_link('Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></h4>
		</div>

		<div class="entrybody">
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>


		<div class="entrymeta">

		</div>

	</div>

	<div class="commentsblock">

		<?php comments_template(); ?>
	
<!-- Begin: AdBrite -->
<script type="text/javascript">
   var AdBrite_Title_Color = '666666';
   var AdBrite_Text_Color = '999999';
   var AdBrite_Background_Color = 'FFFFFF';
   var AdBrite_Border_Color = 'FFFFFF';
</script>
<span style="white-space:nowrap;"><script src="http://ads.adbrite.com/mb/text_group.php?sid=293573&zs=3436385f3630" type="text/javascript"></script><!--
--><a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=293573&afsid=1"><img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-banner.gif" style="background-color:#FFFFFF" alt="Your Ad Here" width="11" height="60" border="0" /></a></span>
<!-- End: AdBrite -->
<br>	<br>	
	</div>
	
		<?php endwhile; ?>
		
	<?php else : ?>
	
		<h2>Not Found</h2>

		<div class="entrybody">Sorry, but you are looking for something that isn't here.</div>


	<?php endif; ?>

	<?php get_footer(); ?>

	</div>

<?php get_sidebar(); ?>

</div>
</body>
</html>









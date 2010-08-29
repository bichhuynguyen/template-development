<?php
ob_start();

/*
Template Name: Enquires Page
*/
?>
<?php get_header(); ?>

		
	<div id="enquiries" class="post enquiries">
			<img src="<?php echo bloginfo('template_url'); ?>/style/images/contact-blurb.png" alt="Contact Blurb" ></img>
				<?php echo do_shortcode('[contact-form 1 "Contact form 1"]') ?> 
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
		
			
		
		
		
<?php get_footer(); ?>
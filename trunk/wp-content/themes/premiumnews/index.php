<?php get_header(); ?>

		<div class="col1">

			<?php include(TEMPLATEPATH . '/includes/featured.php'); ?>

			<?php
				if(get_option('woo_show_video') == "true"){ include(TEMPLATEPATH . '/includes/video.php'); }
			?>

			<?php
				$layout = get_option('woo_layout');
				if ($layout == "false")
					include('layouts/default.php');
				else
					include('layouts/blog.php');
			?>

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
<?php
/*
Template Name: Multimedia Page
*/
$vimeo = new VimeoObject();
$films = $vimeo->title_thumb_desc();
ob_start();
get_header(); ?>
<?get_sidebar();?>
<?php mf_loop();?>
<?php echo $films['list']; ?>
<?php get_footer(); ?>
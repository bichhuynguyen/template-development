<?php
if (empty($pop_posts) || $pop_posts < 1) $pop_posts = 5;
$popularposts = "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY comment_count DESC LIMIT 0,".$pop_posts;
$posts = $wpdb->get_results($popularposts);
if($posts){
foreach($posts as $post){
$post_title = stripslashes($post->post_title);
$guid = get_permalink($post->ID);
$popular .= '<li><a href="'.$guid.'" title="'.$post_title.'">'.$post_title.'</a></li>';
}
}echo $popular;
?>
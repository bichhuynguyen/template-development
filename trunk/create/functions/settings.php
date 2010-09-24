<?php
ob_start();
add_action('admin_init','vimeo_setup');

function vimeo_setup(){
add_settings_field('vimeo_id','Vimeo ID','display_vimeo','general');
}

function display_vimeo(){
 
 echo '<input  type="text" name="vimeo_id" id="vimeo_id" value="'.attribute_escape(get_option('vimeo_id')).'" class="regular-text code" /> size="30" style="width:85%" />';
 echo '<p><small> Enter your Vimeo ID here.</small></p>';
}
?>
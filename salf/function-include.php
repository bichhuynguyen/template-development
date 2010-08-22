<?php



//removed array elements that do not have extension .php
function only_php_files($scan_dir_list = false){
     if(!$scan_dir_list || !is_array($scan_dir_list)) return false;//if element not given, or not array, return out of function.
     foreach($scan_dir_list as $key=>$value){
          if(!strpos($value,'.php')){
              
               unset($scan_dir_list[$key]);
          }
     }
     return $scan_dir_list;
}
//runs the functions to create function folder, select it,
//scan it, filter only PHP docs then include them in functions

add_action('wp_head',fetch_php_docs_from_functions_folder(),1);
function fetch_php_docs_from_functions_folder(){
    
     //get function directory
     $functions_dir = get_function_directory_extension();
     //scan directory, and strip non-php docs
     $all_php_docs = only_php_files(scandir($functions_dir));

     //include php docs
     if (is_array($all_php_docs)){
          foreach($all_php_docs as $include){
               include($functions_dir.'/'.$include);
          }
     }
    
}



?>

<?php
class optionObject{
	var $args = array(
			'option_group'		=> "extra_options",		//Group Slug for settings whitelist	
			'option_prefix'		=> "extra_",			//name prefix set
			'page_title'		=> "Extra Settings",	//Page Title
			'menu_page_title' 	=> "Extra Settings",	//Settings Page Name for sidemenu
			'user_level' 		=> 'manage_options',	//set minimum user access level
			'menu_slug' 		=> "extra_settings",	//ID for top level menu
			'options'			=> array(
								array("title"=>"Extra 1","slug"=>"extra1","help"=>"A little extra something"))
								
						/*
						* Multi Dimensional Array, requires title, slug and help (all strings) for each
						* required option 	
						*/
			);//End of Args Defintion
	
	
	
	
	
	
	
	

	
	function __construct($args = false){
		fb::log("constructed");
		if($args && is_array($args)){
			foreach ($args as $k=>$v){
				$this->args[$k]= $args[$k];
			}
		}
		
		
		register_setting( $this->args['option_group'], $this->args['option_prefix'], array(&$this, 'validate') );
		//add_action('admin_init', array(&$this, 'add_page'));
		add_options_page($this->args['menu_page_title'], $this->args['page_title'], $this->args['user_level'], $this->args['menu_slug'], array(&$this, 'do_page'));

	
	}
	
	function init(){

	    register_setting( $this->args['option_group'], $this->args['option_prefix'], array(&$this, 'validate') );
		
	}

	function add_page() {
		
	    add_options_page($this->args['menu_page_title'], $this->args['page_title'], $this->args['user_level'], $this->args['menu_slug'], array(&$this, 'do_page'));

	}

	function option_rows($options = false){
		/* $options =
		* Multi Dimensional Array, requires title, slug and help (all strings) for each
		* required option 	
		*/
		
		if(!$options) $options = $this->args['options'];
		
		
		foreach ($options as $option):?>
			<tr valign="top"><th scope="row"><?php echo $option['title']; ?></th>

                <td><input type="text" name=<?php echo $this->args['option_name'].'['.$option['slug'].']'?> value="<?php echo $options['text']; ?>" /><p><?php echo $option[$option['slug']]; ?></p></td>

            </tr>	
		<?php endforeach;
	}

	function do_page() {
		fb::log("Do Page launched");

	    ?>

	    <div class="wrap">

	        <h2><?php echo $this->args['page_title'];?></h2>

	        <form method="post" action="options.php">

	            <?php settings_fields($this->args['option_group']); ?>

	            <?php $options = get_option($this->args['option_name']); ?>

	            <table class="form-table">

	            <?php $this->option_rows(); ?>
					
	            </table>

	            <p class="submit">

	            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

	            </p>

	        </form>

	    </div>

	    <?php    

	}

	function validate($input) {



	    // Say our option must be safe text with no HTML tags
	foreach ($input as $k => $v){
    		$input[$k] =  wp_filter_nohtml_kses($input[$k]);
	}

    return $input;

	}
	
}




function test_options(){
	
	//$options->user_level = "read";
	$args['page_title'] = "Test Options";
	$args['menu_page_title'] = "Test Settings";
	$args['menu_slug'] = "test_settings";
	$args['options'] = array(
								array("title"=>"Test 1","slug"=>"test1","help"=>"Help with Test 1"),
								array("title"=>"Test 2","slug"=>"test2","help"=>"Help with Test 2")
	);
	$options = new optionObject($args);
	
	
	
	
}
add_action('admin_menu', 'test_options' );






?>
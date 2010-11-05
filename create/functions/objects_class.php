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
		
		if($args && is_array($args)){
			foreach ($args as $k=>$v){
				$this->args[$k]= $args[$k];
			}
		}
		
		
		register_setting( $this->args['option_group'], $this->args['option_prefix'], array(&$this, 'validate') );
		//add_action('admin_init', array(&$this, 'add_page'));
		$this->add_page();

	
	}
	
	function init(){

	    register_setting( $this->args['option_group'], $this->args['option_prefix'], array(&$this, 'validate') );
		
	}

	function add_page() {
		
	    add_options_page($this->args['menu_page_title'], $this->args['page_title'], $this->args['user_level'], $this->args['menu_slug'], array(&$this, 'do_page'));

	}

	function option_rows($db){
		
		/* $options =
		* Multi Dimensional Array, requires title, slug and help (all strings) for each
		* required option 	
		*/
		
		
		
		
		foreach ($this->args['options'] as $option):
		$name = $this->args['option_prefix']."[".$option['slug']."]";
		
		?>
			
			<tr valign="top"><th scope="row"><?php echo $option['title']; ?></th>

                <td><input type="text" name="<?php echo $name;?>" value="<?php echo $db[$option['slug']]; ?>" /><p><?php echo $option['help']; ?></p></td>

            </tr>	
		<?php endforeach;
	}

	function do_page() {
		?>

	    <div class="wrap">

	        <h2><?php echo $this->args['page_title'];?></h2>

	        <form method="post" action="options.php">

	            <?php settings_fields($this->args['option_group']); ?>

	            <?php $db = get_option($this->args['option_prefix']);//get results from DB ?>

	            <table class="form-table">

	            <?php $this->option_rows($db); ?>
					
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
	$args = array(
			'option_group'		=> "test_options",		//Group Slug for settings whitelist	
			'option_prefix'		=> "test_",			//name prefix set
			'page_title'		=> "Test Settings",	//Page Title
			'menu_page_title' 	=> "Test Settings",	//Settings Page Name for sidemenu
			'user_level' 		=> 'manage_options',	//set minimum user access level
			'menu_slug' 		=> "test_settings",	//ID for top level menu
			'options'			=> array(
								array("title"=>"Test 1","slug"=>"test1","help"=>"A little test."),
								array("title"=>"Test 2","slug"=>"test2","help"=>"Help with Test 2")
								)
								
						/*
						* Multi Dimensional Array, requires title, slug and help (all strings) for each
						* required option 	
						*/
			);//End of Args Defintion
	
	$options = new optionObject($args);
	
	
	
	
}
add_action('admin_menu', 'test_options' );






?>
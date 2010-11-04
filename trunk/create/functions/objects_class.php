<?php
class optionObject{
	var $option_group ="extra_options";//Group Slug for settings whitelist
	var $option_prefix = "extra_";//name prefix set
	var $page_title = "Extra Settings";//Page Title
	var $menu_page_title = "Extra Settings";//Settings Page Name for sidemenu
	var $user_level = 'manage_options';//set minimum user access level
	var $menu_slug = "extra_settings";//ID for top level menu
	var $options = array(
						array("title"=>"Extra 1","slug"=>"extra1","help"=>"A little extra something")
						);
						/*
						* Multi Dimensional Array, requires title, slug and help (all strings) for each
						* required option 	
						*/
		
	
	function __construct($option_group = false, $option_prefix = false){
		fb::log("constructed");
		if(!$option_group) $option_group = $this->option_group;
		$this->option_group =$option_group;
		if(!$option_prefix) $option_prefix = $this->option_prefix;
		$this->option_prefix =$option_prefix;
		
		
		register_setting( $this->option_group, $this->option_prefix, array(&$this, 'validate') );
		
	}
	
	function init(){

	    register_setting( $this->option_group, $this->option_prefix, array(&$this, 'validate') );
		
	}

	function add_page() {
		fb::log('added page');
	    add_options_page($this->menu_page_title, $this->page_title, $this->user_level, $this->menu_slug, array(&$this, 'do_page'));

	}

	function option_rows($options = false){
		/* $options =
		* Multi Dimensional Array, requires title, slug and help (all strings) for each
		* required option 	
		*/
		
		if(!$options) $options = $this->options;
		
		
		foreach ($options as $option):?>
			<tr valign="top"><th scope="row"><?php echo $option['title']; ?></th>

                <td><input type="text" name=<?php echo $this->option_name.'['.$option['slug'].']'?> value="<?php echo $options['text']; ?>" /><p><?php echo $option[$option['slug']]; ?></p></td>

            </tr>	
		<?php endforeach;
	}

	function do_page() {

	    ?>

	    <div class="wrap">

	        <h2><?php echo $this->page_title;?></h2>

	        <form method="post" action="options.php">

	            <?php settings_fields($this->option_group); ?>

	            <?php $options = get_option($this->option_name); ?>

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
	$options = new optionObject("test_options","test_");
	$options->user_level = "read";
	$options->page_title = "Test Settings";
	$options->menu_page_title = $options->page_title;
	$options->menu_slug = "test_settings";
	$options->options = array(
								array("title"=>"Test 1","slug"=>"test1","help"=>"Help with Test 1"),
								array("title"=>"Test 2","slug"=>"test2","help"=>"Help with Test 2")
	);
	
	$options->init();
	fb::log($options->option_group);
	
	add_action('admin_menu', array(&$options, 'add_page'));
}
add_action('admin_init', 'test_options' );






?>
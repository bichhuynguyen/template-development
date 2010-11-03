<?php
ob_start();

class MetaBox{
	var $prefix;//Database Prefix - To avoid conflict
	var $id;//
	var $title;//Box Title
	var $page;//Section to attach metbox to (page, post or custom) (array for multiple)
	var $context = 'normal';//Optionional. normal, or side
	var $priority = 'high';//Optional
	var $fields = array();	/*	Array of arrays or multiple fields. 
							*	Fields Excepted args
							*
							*	array(
			        		*		'name' => 'Default',
							*		'desc' => "<p>this is a default metabox</p>",
			        		*		'id' => $this->prefix . 'date',
			        		*		'type' => 'text')
							*/

	    	

	
	

	function __construct(){
		add_action('save_post', array(&$this, 'save'));
	}
	
	function add(){
			
			if (!is_array($this->page)){
				add_meta_box($this->id, $this->title, array(&$this, 'show'), $this->page, $this->context, $this->priority);
			} else {
				foreach ($this->page as $page){
					add_meta_box($this->id, $this->title, array(&$this, 'show'), $page, $this->context, $this->priority);
				}
			}
			//return get_defined_functions();
		
	}
	
	function show(){
		global $post;
		
	    
		
	    

		

	    echo '<table class="form-table">';

	    foreach ($this->fields as $title => $field) {
			
			
	        // get current post meta data
	        $meta = get_post_meta($post->ID, $field['id'], true);
			
	        echo '<tr>',
	                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
	                '<td>';
				
	        switch ($field['type']) {

					
						case 'select2':

			                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
			                foreach ($field['options'] as $ID => $option) {
			                    echo '<option value="'. $ID .'" ', $meta == $ID ? ' selected="selected"' : '', '>', $option, '</option>';
			                }
			                echo '</select>';

			                break;
							case 'date':
					            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" />', '
					', $field['desc'];
					            break;
						case 'text':
				            echo '<input  type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:15%" />', '
				', $field['desc'];
				            break;
							
							case 'wide-text':
					            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:95%" />', '
					', $field['desc'];
					            break;
								case 'checkbox':
					                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					                break;
							 case 'radio':
					                foreach ($field['options'] as $option) {
					                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
					                }
					                break;
						
	        }			
	        echo     '<td>',
	            '</tr>';
	    }

	    echo '</table>';
	
	}
	
	function save($post_id) {
		
		////fb::log('Save Fired');
		
		

		
	    

	    // check autosave
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			////fb::log('AutoSave Failed');
	        return $post_id;
	    }

	    // check permissions
	    if ('page' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post_id)) {
				////fb::log('User Check Failed');
	            return $post_id;
	        }
	    } elseif (!current_user_can('edit_post', $post_id)) {
			////fb::log('User Check Failed');
	        return $post_id;
	    }

	    foreach ($this->fields as $field) {
			////fb::log($_POST);
	        $old = get_post_meta($post_id, $field['id'], true);
	        $new = $_POST[$field['id']];
			////fb::log($old,'old = ');
			////fb::log($new,'new = ');

			//var_dump($field['id']);
	        //var_dump($new);
	        if ($new && $new != $old) {
				////fb::log('Post Meta updated');
	            update_post_meta($post_id, $field['id'], $new);
	        } elseif ('' == $new && $old) {
				////fb::log('Post Meta deleted');
	            delete_post_meta($post_id, $field['id'], $old);
	        }
	    }
	}
	
	function connect_to_post_type($type){
		global $wpdb;
		$meta_array = array();
		$query = "SELECT post_title, ID FROM $wpdb->posts WHERE post_type='$type' AND post_status ='publish'";


		$meta_query= $wpdb->get_results($query);

			foreach ($meta_query as $object){
				$i = get_object_vars($object);
				$meta_array[$i['ID']]=$i['post_title'];

			}
			if (count($meta_array)<1) $meta_array[0]='No '.$type.' Found!';//*/


			return $meta_array;
	}
	
}




function create_new_meta_boxes(){
	$redirect_metabox = new MetaBox();
	$redirect_metabox->id="redirect";//
	$redirect_metabox->title = "Redirect this page?";//Box Title
	$redirect_metabox->page = 'page';//Section to attach metbox to (page, post or custom)
	$redirect_metabox->context = 'side';
	$redirect_metabox->priority = 'high';
	$redirect_metabox->prefix = 'mf_';
	$redirect_metabox->fields = array(
	        
	   		array(
           		'name' => 'URL',
           		'id' => $redirect_metabox->prefix . 'redirect_url',
           		'type' => 'wide-text',
				'desc' => "<p>Enter the URL you would like this page to redirect to</p>"
				
        	)	
	);
	
	
							
	$books_metabox = new MetaBox();
	
	$books_metabox->id="book_details";//
	$books_metabox->title = "Book Details";//Box Title
	$books_metabox->page = array('Books');//Section to attach metbox to (page, post or custom)
	$books_metabox->context = 'side';
	$books_metabox->priority = 'high';
	$books_metabox->prefix = 'mf_';
	$books_metabox->fields = array(
	        
	   		array(
           		'name' => 'Author',
           		'id' => $books_metabox->prefix . 'author',
           		'type' => 'wide-text'
        	),     
			array(
	            'name' => 'Publisher',
	            'id' => $books_metabox->prefix . 'publisher',
	            'type' => 'wide-text'
	            ),
			array(
	            'name' => 'ISBN',
	            'id' => $books_metabox->prefix . 'ISBN',
	            'type' => 'wide-text'	            
	            )        
					);
	
	//fb::log($books_metabox->connect_to_post_type('Events'));												
	

	
	$team_metabox = new MetaBox();
	
	$team_metabox->id="team_details";//
	$team_metabox->title = "Team Details";//Box Title
	$team_metabox->page = array('People');//Section to attach metbox to (page, post or custom)
	$team_metabox->context = 'side';
	$team_metabox->priority = 'high';
	$team_metabox->prefix = 'mf_';
	$team_metabox->fields = array(
	        
	   		array(
           		'name' => 'Job Title',
           		'id' => $team_metabox->prefix . 'job_title',
           		'type' => 'wide-text'
        	),     
			array(
	            'name' => 'eMail',
	            'id' => $team_metabox->prefix . 'email',
	            'type' => 'wide-text'
	            )
	        
								);
	
	$program_metabox = new MetaBox();

	$program_metabox->id="program_meta";//
	$program_metabox->title = "Program Meta";//Box Title
	$program_metabox->page = array('Program');//Section to attach metbox to (page, post or custom)
	$program_metabox->context = 'side';
	$program_metabox->priority = 'high';
	$program_metabox->prefix = 'mf_SALF_meta_';
	$program_metabox->fields = array(
						   		array(
								        'name' => 'Date',
										'desc' => "<p>Enter in the format DD/MM/YYY</p>",
								        'id' => $program_metabox->prefix . 'date',
								        'type' => 'date'		        
								    ),
								array(
								        'name' => 'Time',
										'desc' => "<p>Enter in the format 00:00</p>",
								        'id' => $program_metabox->prefix . 'time',
								        'type' => 'wide-text'		        
								    ),
								array(
								        'name' => 'Price',
								        'id' => $program_metabox->prefix . 'price',
								        'type' => 'text'		        
								    ), 
								array(
							            'name' => 'Venue',
							            'id' => $program_metabox->prefix . 'venue',
							            'type' => 'select2',
							            'options' => $program_metabox->connect_to_post_type('Venues')
							        ), 
								array(
								        'name' => 'Event Type',
								        'id' => $program_metabox->prefix . 'type',
								        'type' => 'select2',
								        'options' => $program_metabox->connect_to_post_type('Events')
								    ),

								array(
								        'name' => 'EventBrite',
										'desc' => '<p>Enter Eventbrite Link</p>',
								        'id' => $program_metabox->prefix . 'eventbrite',
								        'type' => 'wide-text'		        
								    ),

								array(
								        'name' => 'Concession',
										'desc' => '<p>Enter Concession Link</p>',
								        'id' => $program_metabox->prefix . 'concession',
								        'type' => 'wide-text'		        
								    )

														);
$google_metabox = new MetaBox();

$google_metabox->id="program_maps";//
$google_metabox->title = "Address and Map";//Box Title
$google_metabox->page = array('Venues');//Section to attach metbox to (page, post or custom)
$google_metabox->context = 'normal';
$google_metabox->priority = 'high';
$google_metabox->prefix = 'mf_SALF_maps_meta_';
$google_metabox->fields = array(
					   		array(
								'name' => 'Google Map',
								'id' => $google_metabox->prefix.'map',
								'type' => 'wide-text',
								'desc' => '<p>Enter Google Maps Share URL</p>'
								),
							array(
								'name' => 'Address 1',
								'id' => $google_metabox->prefix.'address1',
								'type' => 'text'
								),
							array(
								'name' => 'Address 2',
								'id' => $google_metabox->prefix.'address2',
								'type' => 'text'
								),
							array(
								'name' => 'Address 3',
								'id' => $google_metabox->prefix.'address3',
								'type' => 'text'
								),
							array(
								'name' => 'Address 4',
								'id' => $google_metabox->prefix.'address4',
								'type' => 'text'
								),
							array(
								'name' => 'Post Code',
								'id' => $google_metabox->prefix.'postcode',
								'type' => 'text'
								)
);

																														
	
	
	
	add_action('admin_menu', $google_metabox->add());
	add_action('admin_menu', $program_metabox->add());
	add_action('admin_menu', $books_metabox->add());
	add_action('admin_menu', $team_metabox->add());
	add_action('admin_menu', $redirect_metabox->add());
	
	
}


add_action('admin_menu','create_new_meta_boxes');


 





?>
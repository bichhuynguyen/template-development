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
						case 'text':
				            echo '<input  type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:15%" />', '
				', $field['desc'];
				            break;
							case 'date':
					            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" />', '
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
		
		//fb::log('Save Fired');
		
		

		
	    

	    // check autosave
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			//fb::log('AutoSave Failed');
	        return $post_id;
	    }

	    // check permissions
	    if ('page' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post_id)) {
				//fb::log('User Check Failed');
	            return $post_id;
	        }
	    } elseif (!current_user_can('edit_post', $post_id)) {
			//fb::log('User Check Failed');
	        return $post_id;
	    }

	    foreach ($this->fields as $field) {
			//fb::log($_POST);
	        $old = get_post_meta($post_id, $field['id'], true);
	        $new = $_POST[$field['id']];
			//fb::log($old,'old = ');
			//fb::log($new,'new = ');

			//var_dump($field['id']);
	        //var_dump($new);
	        if ($new && $new != $old) {
				//fb::log('Post Meta updated');
	            update_post_meta($post_id, $field['id'], $new);
	        } elseif ('' == $new && $old) {
				//fb::log('Post Meta deleted');
	            delete_post_meta($post_id, $field['id'], $old);
	        }
	    }
	}
	
	
	
}




function create_new_meta_boxes(){
	
	
	
	
							
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
	
													
	
	add_action('admin_menu', $books_metabox->add());
	
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
	
													
	
	add_action('admin_menu', $team_metabox->add());
	
	
}


add_action('admin_menu','create_new_meta_boxes');


 





?>
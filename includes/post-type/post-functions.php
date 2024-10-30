<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('init', 'boatdealerPosts');
function boatdealerPosts () {
	register_post_type( 'boats', 
		array( 
			'labels' => array(
				'name' =>  __('Boats','boatdealer'),
				'all_items' => 'All Boats',
				'singular_name' => 'Boats',
				'add_new_item' => 'Add Boats',
				'edit_item' => __('Edit Boats','boatdealer'),
				'search_items' => __('Search Boats','boatdealer'),
				'view_item' => 'View Boats',
				'not_found' => 'No Boats Found',
				'not_found_in_trash' => 'No Boats Found in Trash'
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'has_archive' => true,
			'show_in_menu' => false,
			'supports' => array (
				'title',
				'page-attributes',
				'editor',
				'thumbnail',
			),
			'taxonomies' => array( 'makes',
                'locations',
			),
			'exclude_from_search' => false,
			'_builtin' => false,
			'hierarchical' => false,
			'rewrite' => array("slug" => "product"),
		)
	);
};
add_action('init', 'boatdealer_taxonomies');
function boatdealer_taxonomies() { 
    register_taxonomy('model', 'boats', array(
        'labels' => array(
            // 'name' => _x('model', 'taxonomy general name', 'boatdealer'),
            'name' => 'Model',
            'singular_name' => __('Model','boatdealer'),
            'search_items' => __('SearchModels','boatdealer'),
            'popular_items' => __('Popular Models','boatdealer'),
            'all_items' => __('All Models','boatdealer'),
            'parent_item' => __('Parent Model', 'boatdealer'),
            'parent_item_colon' => __('Parent Model:', 'boatdealer'),
            'edit_item' => __('Edit Model', 'boatdealer'),
            'update_item' => __('Update Model', 'boatdealer'),
            'add_new_item' => __('Add New Model', 'boatdealer'),
            'new_item_name' => __('New Model', 'boatdealer'),
            'separate_items_with_commas' => __('Separate Model with commas', 'boatdealer'),
            'add_or_remove_items' => __('Add or Remove Model', 'boatdealer'),
            'choose_from_most_used' => __('Choose from the most used Model', 'boatdealer'),
            'menu_name' => 'Model',
            ),
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'Model'),
        'public' => true));
register_taxonomy( 'team', 'boats', array(
			'labels' => array(
				'name' => __('team','boatdealer'),
				'singular_name' => 'team',
				'search_items' => __('Search team','boatdealer'),
				'popular_items' => 'Popular team',
				'all_items' => __('All Team','boatdealer'),
				'parent_item' => __( 'Parent team', 'boatdealer' ),
  				'parent_item_colon' => __( 'Parent team:', 'boatdealer' ),
				'edit_item' => __( 'Edit team member', 'boatdealer' ), 
				'update_item' => __( 'Update team', 'boatdealer' ),
				'add_new_item' => __( 'Add New team member', 'boatdealer' ),
				'new_item_name' => __( 'New team' , 'boatdealer'),
				'separate_items_with_commas' => __( 'Separate team with commas', 'boatdealer' ),
				'add_or_remove_items' => __( 'Add or Remove team' , 'boatdealer'),
				'choose_from_most_used' => __( 'Choose from the most used makers', 'boatdealer' ),
				'menu_name' => 'team',
			),
			'hierarchical' => true,
			'show_ui' => true, // Hide from menu
			'query_var' => true,
			'rewrite' => array( 'slug' => 'team' ),
			'public' => true,
		)
	);
    register_taxonomy('features', 'boats', array(
        'labels' => array(
            // 'name' => _x('features', 'taxonomy general name', 'boatdealer'),
            'name' => 'features',
            'singular_name' => __('Features','boatdealer'),
            'search_items' =>  __('Search Features','boatdealer'),
            'popular_items' => __('Popular Features','boatdealer'),
            'all_items' => __('All Features','boatdealer'),
            'parent_item' => __('Parent Item Features', 'boatdealer'),
            'parent_item_colon' => __('Parent Features', 'boatdealer'),
            'edit_item' => __('Edit Features', 'boatdealer'),
            'update_item' => __('Update Features', 'boatdealer'),
            'add_new_item' => __('Add New Features', 'boatdealer'),
            'new_item_name' => __('New Features', 'boatdealer'),
            'separate_items_with_commas' => __('Separate Features with commas', 'boatdealer'),
            'add_or_remove_items' => __('Add or Remove Features', 'boatdealer'),
            'choose_from_most_used' => __('Choose from the most used Features', 'boatdealer'),
            'menu_name' => 'Features',
            ),
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'Features'),
        'public' => true));
}
function boatdealer_custom_listing_save_data($post_id) {
    global $meta_box,  $post;
    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce(sanitize_text_field($_POST['listing_meta_box_nonce']), basename(__FILE__))) {
            return $post_id;
        }
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ( isset($_POST['post_type']))
     { 
        if ('page' == sanitize_text_field($_POST['post_type'])) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }
}
// Begin 2018
/////////////////////////
/* Add new Fields to team  Taxonomy */
function boatdealer_add_team_fields() {
	?>
   	<div class="form-field">
		<label for="term_meta[myorder]"><?php esc_attr_e( 'Order:', 'boatdealer' ); ?></label></th>
		<input type="text" name="term_meta[myorder]" id="term_meta[myorder]" value="" >
        <p><?php esc_attr_e( 'Order to display. For example: 1 (first), 2 (second) and so on ...', 'boatdealer' ); ?></p>
    </div>    
	<div class="form-field">
		<label for="series_image"><?php esc_attr_e( 'Profile Image:', 'boatdealer' ); ?></label>
        <div class="image-preview"><img class="image-preview" style="max-width: 150px;"></div>
		<br /><br />
        <input type="text" name="term_meta[image]" id="term_meta[image]" class="term_meta_image" value="">
    	<br />
            <p><?php esc_attr_e( 'Just click the Button to Select Upload Image', 'boatdealer' ); ?></p>
        <input class="upload_image_button button" name="_add_series_image" id="_add_series_image" type="button" value="Select/Upload Image" />
		<input class="remove_image_button button" name="_remove_series_image" id="_remove_series_image" type="button" value="Remove Image" />
        <br /><br />
    </div>
  	<div class="form-field">
		<label for="term_meta[function]"><?php esc_attr_e( 'Position:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[function]" id="term_meta[function]" value="" >
        <p><?php esc_attr_e( 'For example: Sales Manager, Agent, and so on ...', 'boatdealer' ); ?></p>
    </div> 
 	<div class="form-field">
		<label for="term_meta[phone]"><?php esc_attr_e( 'Phone:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[phone]" id="term_meta[phone]" class="term_meta[phone]" value="">
    </div>   
 	<div class="form-field">
		<label for="term_meta[email]"><?php esc_attr_e( 'Email address:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[email]" id="term_meta[email]" class="term_meta[email]" value="">
    </div>      
 	<div class="form-field">
		<label for="term_meta[skype]"><?php esc_attr_e( 'Skype:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[skype]" id="term_meta[skype]" class="term_meta[skype]" value="">
    </div>     
 	<div class="form-field">
		<label for="term_meta[facebook]"><?php esc_attr_e( 'Facebook URL:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[facebook]" id="term_meta[facebook]" class="term_meta[facebook]" value="">
    </div> 
  	<div class="form-field">
		<label for="term_meta[twitter]"><?php esc_attr_e( 'Twitter URL:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[twitter]" id="term_meta[twitter]" class="term_meta[twitter]" value="">
    </div>
    <div class="form-field">
		<label for="term_meta[linkedin]"><?php esc_attr_e( 'Linkedin URL:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[linkedin]" id="term_meta[linkedin]" class="term_meta[linkedin]" value="">
    </div>
    <div class="form-field">
		<label for="term_meta[youtube]"><?php esc_attr_e( 'Youtube URL:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[youtube]" id="term_meta[youtube]" class="term_meta[youtube]" value="">
    </div>  
    <div class="form-field"
		<label for="term_meta[instagram]"><?php esc_attr_e( 'Instagram URL:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[instagram]" id="term_meta[instagram]" class="term_meta[instazgram]" value="">
    </div>  
    <div class="form-field">
		<label for="term_meta[vimeo]"><?php esc_attr_e( 'Vimeo URL:', 'boatdealer' ); ?></label>
		<input type="text" name="term_meta[vimeo]" id="term_meta[vimeo]" class="term_meta[vimeo]" value="">
    </div>         
<script>
			jQuery(document).ready(function() {
				jQuery('#_add_series_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.term_meta_image').val(attachment.url);
                        jQuery('.image-preview').attr('style','display:block');  
                        jQuery('.image-preview').attr('style','width:150px'); 
                        jQuery('.image-preview').attr('src',attachment.url);  
					}
					wp.media.editor.open(this);
					return false;
				});
 				jQuery('#_remove_series_image').click(function() {
						jQuery('.term_meta_image').val('');
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				});
                 jQuery('#submit').click(function() {
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				}); 
			});
</script>            
<?php
}
add_action( 'team_add_form_fields', 'boatdealer_add_team_fields', 10, 2 );
function boatdealer_edit_team_fields($term) {
 $termMeta = get_option( 'team_' . $term->term_id );
	?>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[myorder]"><?php esc_attr_e( 'Order:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[myorder]" id="term_meta[myorder]" value="<?php if(!empty($termMeta['myorder'])){ esc_attr($termMeta['myorder']); } ?>" >
        <br /><i><?php esc_attr_e( 'Order to display. For example: 1 (first), 2 (second) and so on ...', 'boatdealer' ); ?></i>
        </td>
   	</tr>   
      <tr class="form-field">    
      <th scope="row" valign="top">      
		<label for="term_meta[image]"><?php esc_attr_e( 'Profile Image:', 'boatdealer' ); ?></label>
        <td>
        <div class="image-preview">
        <img class="image-preview" style="max-width: 150px;">
          <?php
           if(!empty($termMeta['image']))
            {
              $image_url = esc_url($termMeta['image']); 
              echo '<img class = "profile_old" src="'. esc_url($image_url).'" width="150px" />';
            }
          ?>      
        </div>
		<br /><br />
        <input type="text" name="term_meta[image]" id="term_meta[image]" class="term_meta_image" value="<?php if(!empty($termMeta['image'])){ esc_attr($termMeta['image']); } ?>">
    	<br /><br />
        <input class="upload_image_button button" name="_add_series_image" id="_add_series_image" type="button" value="Select/Upload Image" />
		<input class="remove_image_button button" name="_remove_series_image" id="_remove_series_image" type="button" value="Remove Image" />
        <br /><i><?php esc_attr_e( 'Just click the Button to Select Upload Image', 'boatdealer' ); ?></i>
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[function]"><?php esc_attr_e( 'Position:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[function]" id="term_meta[function]" value="<?php if(!empty($termMeta['function'])){ esc_attr($termMeta['function']); } ?>" >
        <br /><i><?php esc_attr_e( 'For example: Sales Manager, Agent, and so on ...', 'boatdealer' ); ?></i>
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[phone]"><?php esc_attr_e( 'Phone:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[phone]" id="term_meta[phone]" value="<?php if(!empty($termMeta['phone'])){ esc_attr($termMeta['phone']); } ?>" >
        </td>
   	</tr>  
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[email]"><?php esc_attr_e( 'Email address:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[email]" id="term_meta[email]" value="<?php if(!empty($termMeta['email'])){ esc_attr($termMeta['email']); } ?>" >
        </td>
   	</tr>     
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[skype]"><?php esc_attr_e( 'Skype:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[skype]" id="term_meta[skype]" value="<?php if(!empty($termMeta['skype'])){ esc_attr($termMeta['skype']); } ?>" >
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[facebook]"><?php esc_attr_e( 'Facebook URL:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[facebook]" id="term_meta[facebook]" value="<?php if(!empty($termMeta['facebook'])){ esc_attr($termMeta['facebook']); } ?>" >
        </td>
   	</tr> 
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[twitter]"><?php esc_attr_e( 'Twitter URL:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[twitter]" id="term_meta[twitter]" value="<?php if(!empty($termMeta['twitter'])){ esc_attr($termMeta['twitter']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[linkedin]"><?php esc_attr_e( 'Linkedin URL:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[linkedin]" id="term_meta[linkedin]" value="<?php if(!empty($termMeta['linkedin'])){ esc_attr($termMeta['linkedin']); } ?>" >
        </td>
   	</tr>   
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[youtube]"><?php esc_attr_e( 'Youtube URL:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[youtube]" id="term_meta[youtube]" value="<?php if(!empty($termMeta['youtube'])){ esc_attr($termMeta['youtube']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[instagram]"><?php esc_attr_e( 'Instagram URL:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[instagram]" id="term_meta[instagram]" value="<?php if(!empty($termMeta['instagram'])){ esc_attr($termMeta['instagram']); } ?>" >
        </td>
   	</tr>
    <tr class="form-field">
    <th scope="row" valign="top">
		<label for="term_meta[vimeo]"><?php esc_attr_e( 'Vimeo URL:', 'boatdealer' ); ?></label></th>
		<td>
        <input type="text" name="term_meta[vimeo]" id="term_meta[vimeo]" value="<?php if(!empty($termMeta['vimeo'])){ esc_attr($termMeta['vimeo']); } ?>" >
        </td>
   	</tr>   
<script>
			jQuery(document).ready(function() {
				jQuery('#_add_series_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.term_meta_image').val(attachment.url);
                        jQuery('.image-preview').attr('src',attachment.url);  
                        jQuery('.profile_old').attr('style','display:none');  
                        jQuery('.image-preview').attr('style','display:block');  
                        jQuery('.image-preview').attr('style','width:150px'); 
                        jQuery('.image-preview').attr('src',attachment.url);  
                    }
					wp.media.editor.open(this);
					return false;
				});
 				jQuery('#_remove_series_image').click(function() {
						jQuery('.term_meta_image').val('');
                        jQuery('.image-preview').attr('style','display:none');  
                        jQuery('.profile_old').attr('style','display:none');  
					return false;
				}); 
			});
</script>  
<?php 
}
add_action( 'team_edit_form_fields', 'boatdealer_edit_team_fields', 10, 2 );
/**
 * Save the taxonomy custom meta
 */
function boatdealer_save_team_fields($termId)
{
    if ( !empty( $_POST['term_meta'] ) )
    {
        $term_meta = get_option( 'team_' . $termId );
        foreach ( sanitize_text_field($_POST['term_meta']) as $key => $val )
        {
            $term_meta[$key] = sanitize_text_field($val);
        }
        update_option( 'team_' . $termId, $term_meta );
    }
}
/**
* Save the category data
*/
add_action( 'edited_team', 'boatdealer_save_team_fields');
add_action( 'create_team', 'boatdealer_save_team_fields');
//End 2018
/////////////////////////
add_action('save_post', 'boatdealer_custom_listing_save_data');
add_image_size('featured_preview', 55, 55, true);
 // GET FEATURED IMAGE
function boatdealer_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}
// ADD NEW COLUMN
// add_action('admin_head', 'boatdealer_my_admin_custom_styles');
/*
function boatdealer_my_admin_custom_styles() {
    $output_css = '<style type="text/css">
        .featured_image { width:150px !important; overflow:hidden }
    </style>';
    echo $output_css;
}
*/

function boatdealer_my_admin_custom_styles() {
    echo '<style type="text/css">
        .featured_image { width:150px !important; overflow:hidden }
    </style>';
}
add_action('admin_head', 'boatdealer_my_admin_custom_styles');


function boatdealer_columns_head($defaults) {
    $defaults['boat-price'] = __('Price', 'boatdealer');
    $defaults['featured_image'] = __('Featured Image', 'boatdealer' );
    $defaults['boat-featured'] = __('Featured', 'boatdealer' );
    $defaults['boat-year'] = __('Year','boatdealer' );
    return $defaults;
}

// SHOW THE FEATURED IMAGE
function boatdealer_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = boatdealer_get_featured_image($post_ID);
 		$image_id = get_post_thumbnail_id($post_ID);
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
        $thumb = boatdealer_theme_thumb($image, 150, 75, 'br'); // Crops from bottom right
        if ($post_featured_image) {
            echo '<img src="' . esc_url($thumb) . '" width="150px" height="75px" />';
        }
        else
          {
            echo '<img src="'.esc_url(BOATDEALERPLUGINURL).'assets/images/image-no-available.jpg" width="100px" />';}
    }
    elseif ($column_name == 'boat-year'){
         echo esc_attr(get_post_meta( $post_ID, 'boat-year', true )); 
    }
    elseif ($column_name == 'boat-price'){
         $price = get_post_meta( $post_ID, 'boat-price', true );
         if(! empty($price)) 
            echo  esc_html(boatdealer_currency() . $price) ; 
         else
            echo  esc_attr__('Call For Price','boatdealer');
    }
    elseif ($column_name == 'boat-featured'){
         $r = get_post_meta( $post_ID, 'boat-featured', true ); 
         if($r == 'enabled')
           {echo 'Yes';}
         else
           {echo 'No';}
    }
}
if(isset($_GET['post_type'])){
    if (sanitize_text_field($_GET['post_type']) == 'boats')
      {
        add_filter('manage_posts_columns', 'boatdealer_columns_head');
        add_action('manage_posts_custom_column', 'boatdealer_columns_content', 10, 2);
      }
  }
// Remove column count
add_filter("manage_edit-team_columns", 'boatdealer_theme_columns'); 
function boatdealer_theme_columns($theme_columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => __('Name','boatdealer'),
        'description' => __('Description','boatdealer'),
        'slug' => __('Slug','boatdealer'),
      //  'posts' => __('Posts')
        );
    return $new_columns;
}
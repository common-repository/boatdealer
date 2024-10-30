<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
namespace boatdealer\WP\Settings;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
// http://autosellerplugin.com/wp-admin/tools.php?page=md_settings1
// $mypage = new Page('Settings', array('type' => 'submenu2', 'parent_slug' =>'admin.php?page=real_estate_plugin'));
// $mypage = new Page('md_settings', array('type' => 'submenu', 'parent_slug' =>'tools.php'));
  $mypage = new Page('boatdealer_settings', array('type' => 'submenu2', 'parent_slug' =>'boat_dealer_plugin'));
 // $mypage = new Page('md_settings', array('type' => 'menu'));
$msg = 'This is a scction 1 ... ';
$settings = array();
//$settings['Mutidealer Settings']['Mutidealer Settings'] = array('info' => $msg );
$fields = array();
$settings['Boat Settings']['Boat Settings'] = array('info' => __('Choose your currency, metric system and so on.','boatdealer'));
$fields = array();
$fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'boatdealercurrency',
	'label' => __('Currency', 'boatdealer'),
	'select_options' => array(
		array('value' => 'USD', 'label' => 'US Dollars (&#36;)'),
		array('value' => 'AED', 'label' => 'United Arab Emirates Dirham (&#1583;.&#1573;'),
		array('value' => 'AOA', 'label' => 'Angolan Kwanza'),
		array('value' => 'AFN', 'label' => 'Afghan Afghani (&#1547;)'),
		array('value' => 'ARS', 'label' => 'Argentine Pesos (&#36;)'),
		array('value' => 'AUD', 'label' => 'Australian Dollars (&#36;)'),
		array('value' => 'BRL', 'label' => 'Brazilian Real (R&#36;)'),
		array('value' => 'BGN', 'label' => 'Bulgarian Lev'),
		array('value' => 'CAD', 'label' => 'Canadian Dollars (&#36;)'),
		array('value' => 'CNY', 'label' => 'Chinese Yuan (&yen;)'),
		array('value' => 'HRK', 'label' => 'Croatian Kuna'),
		array('value' => 'CZK', 'label' => 'Czech Koruna'),
		array('value' => 'DKK', 'label' => 'Danish Krone'),
		array('value' => 'EUR', 'label' => 'Euros (&euro;)'),
		array('value' => 'HKD', 'label' => 'Hong Kong Dollar (&#36;)'),
		array('value' => 'HUF', 'label' => 'Hungarian Forint'),
		array('value' => 'INR', 'label' => 'Indian Rupee (&#8377;)'),
		array('value' => 'RIAL', 'label' => 'Iranian Rial (&#65020;)'),
		array('value' => 'ILS', 'label' => 'Israeli Shekel (&#8362;)'),
		array('value' => 'JPY', 'label' => 'Japanese Yen (&yen;)'),
		array('value' => 'KRW', 'label' => 'South Korean Won (₩)'),
		array('value' => 'MYR', 'label' => 'Malaysian Ringgits'),
		array('value' => 'MXN', 'label' => 'Mexican Peso (&#36;)'),
		array('value' => 'NZD', 'label' => 'New Zealand Dollar (&#36;)'),
		array('value' => 'NOK', 'label' => 'Norwegian Krone'),
		array('value' => 'PKR', 'label' => 'Pakistani Rupee (₨)'),
		array('value' => 'PHP', 'label' => 'Philippine Pesos'),
		array('value' => 'PLN', 'label' => 'Polish Zloty'),
		array('value' => 'GBP', 'label' => 'Pound Sterling (&pound;)'),
		array('value' => 'RON', 'label' => 'Romanian Leu'),
		array('value' => 'RUB', 'label' => 'Russian Rubles'),
		array('value' => 'SAR', 'label' => 'Saudi Riyal (&#65020;)'),
		array('value' => 'CHF', 'label' => 'Swiss Franc'),
		array('value' => 'SEK', 'label' => 'Swedish Krona'),
		array('value' => 'SGD', 'label' => 'Singapore Dollar (&#36;)'),
		array('value' => 'THB', 'label' => 'Thai Baht (&#3647;)'),
		array('value' => 'TRY', 'label' => 'Turkish Lira (&#8378;)'),
		array('value' => 'TWD', 'label' => 'Taiwan New Dollars'),
		array('value' => 'VND', 'label' => 'Vietnamese Dong (&#8363;)'),
		array('value' =>' YEN', 'label' => 'Yen (&yen;)'),
		array('value' => 'ZAR', 'label' => 'South African Rand'),
		array('value' => 'Universal', 'label' => 'Universal')
	)		
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'boatdealer_measure',
	'label' => __('Miles - Km - Hours','boatdealer'),
	'select_options' => array(
		array('value'=>'Miles', 'label' => __('Miles', 'boatdealer')),
		array('value'=>'Kms', 'label' => __('Kms', 'boatdealer')),
		array('value'=>'Hours', 'label' => __('Hours', 'boatdealer'))
		)			
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'boatdealer_liter',
	'label' => __('Liters - Gallons','boatdealer'),
	'select_options' => array(
		array('value'=>'Liters', 'label' => __('Liters', 'boatdealer')),
		array('value'=>'Gallons', 'label' => __('Gallons', 'boatdealer')),
		)			
	);
    
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'boatdealer_lenght',
	'label' => __('Feet - Meters','boatdealer'),
	'select_options' => array(
		array('value'=>'Feet', 'label' => __('Feet', 'boatdealer')),
		array('value'=>'Meters', 'label' => __('Meters', 'boatdealer') ),
		)			
	);
 
	$fields[] =	array(
            	'type' 	=> 'select',
				'name' => 'boatdealer_quantity',
				'label' => __('How many boats would you like to display per page?', 'boatdealer'),
				'select_options' => array (
                		array('value'=>'3', 'label' => '3'),
	                	array('value'=>'6', 'label' => '6'),
                		array('value'=>'9', 'label' => '9'),
                        array('value'=>'12', 'label' => '12'),
                        array('value'=>'15', 'label' => '15'),
                        array('value'=>'18', 'label' => '18'),
	         	)
 	); 
/*
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Use dedicated Search Results Page','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
*/
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Remove Sidebar from Search Result Page','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_overwrite_gallery',
	'label' => __('Replace the Wordpress Gallery with Flexslider Gallery','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
  $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_thumbs_format',
	'label' => __('Use thumbnails size 2:1 or 4:3 ?','boatdealer'),
	'radio_options' => array(
		array('value'=>'1', 'label' => '2 : 1'),
		array('value'=>'2', 'label' => '4 : 3'),
		)			
	);
  $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_enable_contact_form',
	'label' => __('Enable Contact Form in Single Product Page?','boatdealer'),
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'boatdealer_recipientEmail',
	'label' => __('Fill out your contact email to receive email from your Contact Form at bottom of the individual boat page.' ,'boatdealer')
    );   

 /*
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_template_gallery',
	'label' => __('In Show Room Page, use Gallery, List View or Grid Template','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Gallery'),
		array('value'=>'list', 'label' => 'List View'),
		array('value' => 'grid', 'label' => 'Grid'),
		)			
	);
	*/  

	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'BoaDealer_image_size',
		'label' => __('In Show Room Page, Template List View or Grid, Choose the thumbnail image size (width)', 'boatdealer') . ':',
		'radio_options' => array(
			array('value' => 'populate_roles_300(  )', 'label' =>'300px'),
			array('value' => '350', 'label' =>'350px'),
			array('value' => '400', 'label' =>'400px'),
		)
	);
	
	/*
	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'boatdealer_template_single',
		'label' => __('In Single Boat Page, use Template', 'boatdealer') . ':',
		'radio_options' => array(
			array('value' => '1', 'label' =>'Model 1'),
			array('value' => '2', 'label' => 'Model 2 (with sidebar)'),
			array('value' => '3', 'label' => 'Model 3 '),
		)
	);
	*/


/*
	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'boatdealer_auto_updates',
		'label' =>esc_attr__("Enable Auto Update Plugin? (default Yes)", "boatdealer"),
		'radio_options' => array(
			array('value' => 'Yes', 'label' =>esc_attr__('Yes, enable Boat Dealer Auto Update', "boatdealer")),
			array('value' => 'No', 'label' =>esc_attr__('No (unsafe)', "boatdealer")),
		)
		);
  */


$settings['Boat Settings']['Boat Settings']['fields'] = $fields;

$settings['Search']['Search'] = array('info' => __('Customize your Search Options. Choose the fields to show on the front end search bar.','boatdealer'));
$fields = array();
 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_show_fuel',
	'label' => __('Show the Fuel type control','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_show_year',
	'label' => __('Show the Year control','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
    
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_show_price',
	'label' => __('Show the Price slider','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_show_orderby',
	'label' => __('Show the Order By Control','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
$settings['Search']['Search']['fields'] = $fields;
$settings['Widget']['Widget'] = array('info' => __('Customize your Search Widget Options. Choose the fields to show on the Search Widget.','boatdealer'));
$fields = array(); 
 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_widget_show_fuel',
	'label' => __('Show the Fuel type control','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_widget_show_year',
	'label' => __('Show the Year control','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_widget_show_price',
	'label' => __('Show the Price control','boatdealer').'?',
	'radio_options' => array(
  		array('value'=>'yes', 'label' => 'Yes '),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   

 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'boatdealer_widget_show_orderby',
	'label' => __('Show the Order By Control','boatdealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);  
$settings['Widget']['Widget']['fields'] = $fields;

  //  $settings['Boat Design']['Boat Design'] = array('info' => __('Choose colours and so on', 'boatdealer'));
    $fields = array();
    
 
    $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_search_bt_bk_color',
    	'label' => __('Search Button Background Color', 'boatdealer')
    	);
 
     $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_search_bt_color',
    	'label' => __('Search Button Color', 'boatdealer')
    	);          
    
    
    $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_background_color',
    	'label' => __('Background Color', 'boatdealer')
    	);
         
        
     $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_foreground_color',
    	'label' =>  __('Foreground Text Color', 'boatdealer')
    	);
        
     $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_foreground_label_color',
    	'label' =>  __('Label Color', 'boatdealer')
    	);
        
        
     $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_select_border_color',
    	'label' =>  __('Select Border Color', 'boatdealer')
    	);
            
        
      $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_page_background_color',
    	'label' =>  __('Boat Background Page Color', 'boatdealer')
    	);
        
       $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_boats_box_border_color',
    	'label' =>  __('Boat Box Border Color', 'boatdealer')
    	);
 
 
       $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_title_color',
    	'label' =>  __('Select Title Color', 'boatdealer')
    	);
               
     
       $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_individual_boats_page_background',
    	'label' =>  __('Single Boat Page Background Color', 'boatdealer')
    	); 
    
      
             
        
    
     $fields[] = array(
    	'type' 	=> 'color',
    	'name' 	=> 'bd_individual_page_foreground_color',
    	'label' =>  __('Single Boat Page Foreground Text Color', 'boatdealer')
    	);
        
        
        
       $fields[] = array(
    	'type' 	=> 'textarea',
    	'name' 	=> 'bd_my_css',
    	'label' =>  __('Customized CSS', 'boatdealer')
    	);
             
           
   // $settings['Boat Design']['Boat Design']['fields'] = $fields;
	
    
    
new OptionPageBuilderTabbed($mypage, $settings);
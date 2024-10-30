<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
global $wp_version;

if (version_compare($wp_version, '5.2') >= 0) {
    boatdealer_health_permalink();
} else {
    return;
}

function boatdealer_health_permalink()
{
    function boatdealer_add_permalink_test($tests)
    {
        $tests['direct']['permalink'] = array(
            'label' => __('Wrong Permalink', 'boatdealer'),
            'test' => 'boatdealer_permalink_test',
        );
        return $tests;
    }
  
   $boatdealerurl = sanitize_text_field($_SERVER['REQUEST_URI']);
	if (strpos($boatdealerurl, '/options-permalink.php') === false) {
		$permalinkopt = get_option('permalink_structure');
		if ($permalinkopt != '/%postname%/')
				add_filter('site_status_tests', 'boatdealer_add_permalink_test');
	}
  
    
    function boatdealer_permalink_test()
    {


        $result = array(
            'badge' => array(
                'label' => __('Critical', 'boatdealer'), // Performance
                'color' => 'red', // orange',
            ),
            'test2' => 'Bill_plugin',
            'status' => 'critical',
            'label' => __('Wrong Permalink Settings', 'boatdealer'),
            'description' =>  sprintf(
                '<p>%s</p>',
                __('Please, fix it to avoid 404 error page.
                     To correct, just go to 
                     Dashboard => Settings => Permalinks => Post Name (check)
                     Then, click Save Changes.','boatdealer')
            ),
        );
        return $result;
    }
}

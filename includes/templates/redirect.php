<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action("template_redirect", 'boatdealer_template_redirect');
function boatdealer_template_redirect()
{
    global $wp;
    //global $query;
    global $wp_query;
    if (isset($_GET['boatdealer_search_type'])) {
        $boatdealer_search_type = sanitize_text_field($_GET['boatdealer_search_type']);
         $boatdealer_template_gallery = trim(get_option('boatdealer_template_gallery',
            'yes'));
        if ($boatdealer_template_gallery == 'yes')
            require_once (BOATDEALERPLUGINPATH . 'includes/templates/template-showroom2.php');
        else
            require_once (BOATDEALERPLUGINPATH . 'includes/templates/template-showroom3.php');
        die();
    }
   if (is_single()) {
        $boatdealerurl = sanitize_text_field($_SERVER['REQUEST_URI']); 
        if (strpos($boatdealerurl, '/product/') === false)
            return;
        if (isset($wp->query_vars["post_type"])) {
            if ($wp->query_vars["post_type"] == "boats") {
                if (have_posts()) {
                    include (BOATDEALERPLUGINPATH . 'includes/templates/template-single.php');
                    die();
                }
            }
        }
    }
}
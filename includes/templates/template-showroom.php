<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function boatdealer_show_boats($atts)
{
  $output = '<div id="boatdealer_content">';      
  if (isset($atts['onlybar']))
      {
         $output .= boatDealer_search(1);
         $output .= '</div'; 
         return $output;
       }
  $boatdealer_pagination = 'yes';
    if (!isset($postNumber)) {
        $postNumber = get_option('boatdealer_quantity', 6);
    }
    if (empty($postNumber)) {
        $postNumber = get_option('boatdealer_quantity', 6);
    }
    $output .= boatdealer_search(1);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }
    if(! isset($paged))
       $paged = boatdealer_get_page();
    global $wp_query;
    wp_reset_query();
    $args = array(
                'post_type' => 'boats',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'ASC');
        // orderby
        if (!empty($orderby)) {
            $args['orderby'] = 'meta_value';
            $args['meta_type'] = 'NUMERIC';
            if ($orderby == 'price_high') {
                $args['meta_key'] = 'boat-price';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'price_low') {
                $args['meta_key'] = 'boat-price';
                $args['order'] = 'ASC';
            }
            if ($orderby == 'year_high') {
                $args['meta_key'] = 'boat-year';
                $args['order'] = 'DESC';
            }
            if ($orderby == 'year_low') {
                $args['meta_key'] = 'boat-year';
                $args['order'] = 'ASC';
            }
        } else {
            $args['orderby'] = 'date';
            $args[] = 'ASC';
        }
    /*    
    echo '<pre>';
    print_r($args);
    echo '</pre>';
    */    
    $wp_query = new WP_Query($args);
    $qposts = $wp_query->post_count;
    $ctd = 0;
    $boatdealer_measure = get_option('boatdealer_measure', 'M2');
    $output .= '<div class="carGallery">';
    $output .= '<div class="boatdealer_container">';
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $ctd++;
        $price = get_post_meta(get_the_ID(), 'boat-price', true);
        if ($price <> '' and $price != '0') {
            $price = number_format($price);
        } else
            $price = '';
        $image_id = get_post_thumbnail_id();
        if (empty($image_id)) {
            $image = BOATDEALERIMAGES . 'image-no-available-800x400_br.jpg';
            $image = str_replace("-", "", $image);
        } else {
            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
            $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
        }
        $boatdealer_thumbs_format = trim(get_option('boatdealer_thumbs_format', '1'));
        if ($boatdealer_thumbs_format == '2')
            $thumb = boatdealer_theme_thumb($image, 300, 225, 'br'); // Crops from bottom right
        else
            $thumb = boatdealer_theme_thumb($image, 400, 200, 'br'); // Crops from bottom right
        $hp = get_post_meta(get_the_ID(), 'boat-hp', true);
        $year = get_post_meta(get_the_ID(), 'boat-year', true);
        $fuel = get_post_meta(get_the_ID(), 'boat-fuel', true);
        $transmission = get_post_meta(get_the_ID(), 'transmission-type', true);
        $miles = get_post_meta(get_the_ID(), 'boat-miles', true);
        $output .= '<div>';
        $output .= '<a href="' . get_permalink() . '">';
        $output .= '<div class="boatdealer_gallery_2016">';
        $output .= '<img class="boatdealer_caption_img" src="' . $thumb . '" alt="' .
            get_the_title() . '" />';
        $output .= '<div class="boatdealer_caption_text">';
        $output .= ($price <> '' ? boatdealer_currency() . $price : esc_attr__('Call for Price',
            'boatdealer'));
        // $output .= ($price <> '' ? '<br />' : '');
        $output .= '<br />';
        $output .= ($hp <> '' ? $hp . ' ' . esc_attr__('HP', 'boatdealer') . '<br />' : '');
        $output .= ($year <> '' ? esc_attr__('Year', 'boatdealer') . ': ' . $year . '<br />' : '');
        $output .= ($fuel <> '' ? esc_attr__('Fuel', 'boatdealer') . ': ' . $fuel . '<br />' : '');
        $output .= ($transmission <> '' ? esc_attr__('Transmission', 'boatdealer') . ': ' . $transmission .
            '<br />' : '');
        $miles_label = get_option("boatdealer_measure", "Miles");

        $output .= ($miles <> '' ? esc_attr($miles_label) . ': ' . esc_attr($miles) .
            '<br />' : '');

        $output .= '</div>';
        $output .= '<div class="carTitle">' . get_the_title() . '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
        if ($ctd < $qposts) {
            if ($ctd % 3 == 0) {
                $output .= '</div>';
                $output .= '<div class="boatdealer_container">';
            }
        }
    endwhile;   
    $output .= '</div>'; 
    $output .= '<br/> <br/>';  
    if ($boatdealer_pagination == 'yes') {
        $output .= '<div class="boatdealer_navigation">';
        $output .= '';
        ob_start();
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => esc_attr__('Back', 'textdomain'),
            'next_text' => esc_attr__('Onward', 'textdomain'),
            ));
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= '</div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    wp_reset_query();
    if ($qposts < 1) {
        $output .= '<h4>' . esc_attr__('Not Found !','boatdealer') . '</h4>';
    }
    $output .= '</div>'; /* boatdealer_content */
    return $output;
}
add_shortcode('boat_dealer', 'boatdealer_show_boats'); ?>